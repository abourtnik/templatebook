<?php

namespace App\Http\Controllers;

use App\Order;
use App\Template;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Address;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller {

    public function __construct() {

        $this->middleware('auth');

    }

    public function index () {

            // Verify if basket exist and is not empty
            if (Session::has('Basket') && !empty(Session::get('Basket'))) {

                $templates = Template::whereIn('id' , array_keys(Session::get('Basket') ))->get();

                $total = $this->total();

                // PAYPAL
                $apiContext = new ApiContext(

                    new OAuthTokenCredential(

                        config('constants.PAYPAL_ID'),
                        config('constants.PAYPAL_SECRET')
                    )
                );

                // Liste des items achetes
                $list = new ItemList();

                foreach ($templates as $template) {

                    $item = new Item();

                    $item->setName($template->name);
                    $item->setDescription($template->description);
                    $item->setQuantity(Session::get('Basket.'.$template->id));
                    $item->setPrice($template->price);
                    $item->setCurrency('EUR');

                    $list->addItem($item);
                }

                // Detail de la commande
                $details = new Details();

                $details->setSubtotal($total);

                // Total de la commande
                $amount = new Amount();

                $amount->setTotal($total);
                $amount->setDetails($details);
                $amount->setCurrency('EUR');

                // La transaction
                $transaction = new Transaction();

                $transaction->setItemList($list);
                $transaction->setDescription('Vos achats sur ' . route('index') );
                $transaction->setAmount($amount);
                $transaction->setCustom('demo-id');

                $payement = new Payment();

                $payement->setTransactions([$transaction]);
                $payement->setIntent('sale');

                // Les urls de redirection
                $redirectsUrls = new RedirectUrls();

                $redirectsUrls->setReturnUrl(route('pay-order'));
                $redirectsUrls->setCancelUrl(route('cancel-order'));
                $payement->setRedirectUrls($redirectsUrls);

                // Le payer
                $payer = new Payer();

                $payer->setPaymentMethod('paypal');
                $payement->setPayer($payer);

                try {
                    $payement->create($apiContext);
                    $paypal_link = $payement->getApprovalLink();
                }

                catch (PayPalConnectionException $e) {

                    Log::useDailyFiles(storage_path().'/logs/paypal.log');
                    Log::debug($e->getData());

                    // Envoie d'un e-mail aux admins
                    return redirect(route('home'))->with('error', 'Oups, une erreur s\'est produite. Merci de réessayer plus tard.');

                }

                // PAYPAL
                return view('orders.index', compact('templates' , 'total' , 'paypal_link'));
            }
            else
                return redirect(route('home'))->with('error', 'Vous n\'avez aucun produit dans votre panier');
    }

    public function pay (Request $request) {

        $payment_id = $request->query('paymentId');
        $payer_id = $request->query('PayerID');

        $apiContext = new ApiContext(

            new OAuthTokenCredential(
                config('constants.PAYPAL_ID'),
                config('constants.PAYPAL_SECRET')
            )
        );

        $payement = Payment::get($payment_id , $apiContext);

        // Verifier si le le total du paiement correspond au total du panier
        if ( $payement->getTransactions()[0]->getAmount()->getTotal() == $this->total()) {

            $execution = new PaymentExecution();;
            $execution->setPayerId($payer_id);
            $execution->setTransactions($payement->getTransactions());

        }
        else {
            return redirect(route('home'))->with('error', 'Oups, une erreur s\'est produite. Merci de réessayer plus tard. Vous n\'avez pas été debité');
        }

        // Executer la paiement
        try {
            $payement->execute($execution , $apiContext);
        }
        catch (PayPalConnectionException $e) {

            Log::useDailyFiles(storage_path().'/logs/paypal.log');
            Log::debug($e->getData());

            // Envoie d'un e-mail aux admins
            return redirect(route('home'))->with('error', 'Oups, une erreur s\'est produite. Merci de réessayer plus tard. Vous n\'avez pas été debité');
        }

        // Save order
        $order = new Order();

        $order->user_id = Auth::id();
        $order->ammount = $this->total();
        $order->paypal_id = $payement->getId();
        $order->date = date('Y-m-d H:i:s');

        $order->save();

        // Save order information
        foreach (array_keys(Session::get('Basket')) as $id) {
            $order->templates()->attach($id , ['quantity' => Session::get('Basket.'.$id)] );
        }

        // Generation de la facture

        $payer = [

            'lastname' => $payement->getPayer()->getPayerInfo()->getLastName(),
            'firstname' => $payement->getPayer()->getPayerInfo()->getFirstName(),
            'address' => $payement->getPayer()->getPayerInfo()->getShippingAddress()->getLine1(),
            'zip' => $payement->getPayer()->getPayerInfo()->getShippingAddress()->getPostalCode(),
            'city' => $payement->getPayer()->getPayerInfo()->getShippingAddress()->getCity(),
            'country' => $payement->getPayer()->getPayerInfo()->getShippingAddress()->getCountryCode(),
            'email' => Auth::user()->email

        ];

        $total = $this->total();

        $pdf = PDF::loadView('factures.index', compact('order' , 'payer' , 'total'));
        $pdf->save(storage_path('app/factures/') . $order->id . '.pdf' );

        // Envoie de la facture par email
        Notification::send(Auth::user(), new \App\Notifications\Order($order));

        // Vider le panier
        Session::forget('Basket');

        $buy_order = Order::findorFail($order->id);

        return redirect('home')->with('buy_order', $buy_order);
    }

    public function cancel () {

        return redirect(route('home'))->with('error', 'Votre commande a ete annulée');

    }

    public function show ($order_id) {

        $order = Order::findOrFail($order_id);
        
        if ($order->user_id == Auth::user()->id )
            return view('orders.show', compact('order'));
        else
            abort('404');
    }
}
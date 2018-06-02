<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

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
                    $item->setUrl(url('template-show' , [$template->id]));
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
                $transaction->setDescription('Achat sur mon joli site');
                $transaction->setAmount($amount);
                $transaction->setCustom('demo-id');
                $payement = new Payment();
                $payement->setTransactions([$transaction]);
                $payement->setIntent('sale');

                // Les urls de redirection
                $redirectsUrls = new RedirectUrls();
                $redirectsUrls->setReturnUrl(url('pay-order'));
                $redirectsUrls->setCancelUrl(url('cancel-order'));
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
                    var_dump(json_decode($e->getData()));
                }

                // PAYPAL
                return view('orders.index', compact('templates' , 'total' , 'paypal_link'));
            }

            else
                return redirect(route('home'))->with('template-message', 'Vous n\'avez aucun produit dans votre panier');
    }

    public function pay () {

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('constants.PAYPAL_ID'),
                config('constants.PAYPAL_SECRET')
            )
        );

        if (Session::has('Basket') && !empty(Session::get('Basket'))) {
            $templates = Template::whereIn('id', array_keys(Session::get('Basket')))->get();
        }

        $payement = Payment::get();
        $execution = new PaymentExecution();;
        $execution->setPayerId();
        $execution->setTransactions($payement->getTransactions());

        try {
            $payement->execute($execution , $apiContext);
            // stocker les infos en base
            // Generer une facture
            // verifier si le le total du paeiement correspond au total du paiement
            $payement->getPayer()->getPayerInfo()->getCountryCode();
            $payement->getId();
            $payement->getTransactions()[0]->getCustom();
        }

        catch (PayPalConnectionException $e) {
            var_dump(json_decode($e->getData()));
        }
    }
    
    public function cancel () {
    }
}
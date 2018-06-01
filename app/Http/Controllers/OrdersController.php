<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index () {

        // Verify if basket exist and is not empty

        if (Session::has('Basket') && !empty(Session::get('Basket'))) {

            $templates = Template::whereIn('id' , array_keys(Session::get('Basket') ))->get();

            $total = $this->total();

            return view('orders.index', compact('templates' , 'total'));

            // PAYPAL

            /*
            $paypal = new Paypal();

            $params = array(

                'RETURNURL' => Router::url(array('controller' => 'pages' , 'action' => 'paypal') , true),
                'CANCELURL' => Router::url(array('controller' => 'pages' , 'action' => 'paypalError') , true),

                'PAYMENTREQUEST_0_AMT' => $this->total(),
                'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
            );

            // Product information

            foreach($products as $key => $product){
                $params["L_PAYMENTREQUEST_0_NAME$key"] = $product['Product']['name'];
                $params["L_PAYMENTREQUEST_0_DESC$key"] = $product['Product']['description'];;
                $params["L_PAYMENTREQUEST_0_AMT$key"] = $product['Product']['price'];
                $params["L_PAYMENTREQUEST_0_QTY$key"] = $this->Session->read('Basket.'.$product['Product']['id']);
            }

            $response = $paypal->request('SetExpressCheckout', $params);

            if($response){
                $paypal_link = 'https://www.' . ((!Configure::read('PAYPAL_SSL')) ? 'sandbox.' : '') . 'paypal.com/webscr?cmd=_express-checkout&useraction=commit&token=' . $response['TOKEN'];
                $this->set('paypal_link' , $paypal_link);
            }else{
                var_dump($paypal->errors);
                die('Erreur ');
            }

            */
        }

        else
            return redirect(route('home'))->with('template-message', 'Vous n\'avez aucun produit dans votre panier');
    }

}
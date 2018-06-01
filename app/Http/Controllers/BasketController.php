<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index(){

        // Products in basket

        if (Session::has('Basket'))
            $products = $this->Product->find('all', array('conditions' => array('id' => array_keys(Session::get('Basket')))));
        else
            $products = array();

        $this->set('products' , $products);
        // Total
        $this->set('total' , $this->total());
    }

    public function add($product_id) {

        $json = array('error' => true);

        if (!empty($product_id)) {

            $product = $this->Product->find('first', array('conditions' => array('id' => $product_id)));

            if ($product) {

                if ($this->Session->read('Basket.' . $product_id))
                    $this->Session->write('Basket.' . $product_id, $this->Session->read('Basket.' . $product_id) + 1);

                else
                    $this->Session->write('Basket.' . $product_id, 1);
 
                $json['error'] = false;
                $json['total'] = $this->total();
                $json['count'] = $this->count();
                $json['message'] = "L'article a bien été ajouté au panier";

            } else {

                $json['message'] = "Ce produit n'existe pas";

            }

        } else

            $json['message'] = "Vous n'avez pas selectionné de produit à ajouté";

        echo json_encode($json);

        die();
    }

    public function delete ($product_id) {

        $json = array('error' => true);

        if (!empty($product_id)) {

            $product = $this->Product->find('first', array('conditions' => array('id' => $product_id)));

            if ($product) {

                $this->Session->delete('Basket.' . $product_id);

                $json['error'] = false;

                $json['total'] = $this->total();

                $json['count'] = $this->count();

                $json['message'] = "L'article a bien été supprimé du panier";

            } else {
                $json['message'] = "Ce produit n'existe pas";
            }
        } else

            $json['message'] = "Vous n'avez pas selectionné de produit à supprimer";

        echo json_encode($json);
        die();
    }

    private function subtotal ($produit_id) {

        $product = $this->Product->find('all', array('fields' => array('id' , 'price') , 'conditions' => array('id' => $produit_id)));

        return number_format($product[0]['Product']['price'] * $this->Session->read('Basket.' . $product[0]['Product']['id']),2);
    }

    private function count () {

        return array_sum($this->Session->read('Basket'));

    }

    public function recalculate ($product_id) {

        $json = array('error' => true);

        if (!empty($product_id)) {

            $product = $this->Product->find('first', array('conditions' => array('id' => $product_id)));

            if ($product) {

                if (isset($this->request->data['quantity']) && $this->request->data['quantity'] > 1 && is_int($this->request->data['quantity'])) {}

                $this->Session->write('Basket.'.$product_id , $this->request->data['quantity']);

                $json['error'] = false;

                $json['total'] = $this->total();

                $json['subtotal'] = $this->subtotal($product_id);

                $json['count'] = $this->count();

                $json['message'] = "Le panier a bien été modifié";

            }

            else {

                $json['message'] = "Ce produit n'existe pas";

            }
        }

        else

            $json['message'] = "Vous n'avez pas selectionné de produit à modifier";

        echo json_encode($json);

        die();
    }
}
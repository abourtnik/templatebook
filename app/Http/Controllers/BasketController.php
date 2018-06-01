<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BasketController extends Controller
{
    public function index(){

        // Templates in basket

        if (Session::has('Basket'))
            $templates = Template::whereIn('id' , array_keys(Session::get('Basket') ))->get();
        else
            $templates = array();

        $total = $this->total();

        return view('basket.index', compact('templates' , 'total'));

    }

    public function add($template_id) {

        $json = array('error' => true);

        if (!empty($template_id)) {

            $template = Template::where('id' , $template_id);

            if ($template) {

                if (Session::has('Basket.'.$template_id))
                    Session::put('Basket.' . $template_id, Session::get('Basket.' . $template_id) + 1);
                else
                    Session::put('Basket.' . $template_id, 1);

                $json['error'] = false;
                //$json['total'] = $this->total();
                $json['count'] = $this->count();
                $json['message'] = "L'article a bien été ajouté au panier";
            } else {
                $json['message'] = "Ce template n'existe pas";
            }
        } else
            $json['message'] = "Vous n'avez pas selectionné de template à ajouté";

        return response()->json($json);
    }

    public function delete ($template_id) {

        $json = array('error' => true);

        if (!empty($template_id)) {

            $template = Template::where('id' , $template_id);

            if ($template) {

                Session::foget('Basket.' . $template_id);

                $json['error'] = false;
                //$json['total'] = $this->total();
                $json['count'] = $this->count();
                $json['message'] = "L'article a bien été supprimé du panier";
            } else {
                $json['message'] = "Ce template n'existe pas";
            }
        } else
            $json['message'] = "Vous n'avez pas selectionné de template à supprimer";

        echo json_encode($json);
        die();
    }


    private function subtotal ($template_id) {

        $template = $this->Product->find('all', array('fields' => array('id' , 'price') , 'conditions' => array('id' => $template_id)));
        return number_format($template[0]['Product']['price'] * $this->Session->read('Basket.' . $template[0]['Product']['id']),2);
    }

    private function count () {

        return array_sum(Session::get('Basket'));
    }

    public function recalculate ($template_id) {

        $json = array('error' => true);

        if (!empty($template_id)) {

            $template = $this->Product->find('first', array('conditions' => array('id' => $template_id)));

            if ($template) {

                if (isset($this->request->data['quantity']) && $this->request->data['quantity'] > 1 && is_int($this->request->data['quantity'])) {}
                $this->Session->write('Basket.'.$template_id , $this->request->data['quantity']);

                $json['error'] = false;
                $json['total'] = $this->total();
                $json['subtotal'] = $this->subtotal($template_id);
                $json['count'] = $this->count();
                $json['message'] = "Le panier a bien été modifié";
            }

            else {
                $json['message'] = "Ce template n'existe pas";
            }

        }

        else
            $json['message'] = "Vous n'avez pas selectionné de template à modifier";

        echo json_encode($json);
        die();


    }

}
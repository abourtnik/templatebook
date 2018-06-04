<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


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
                $json['total'] = $this->total();
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

                Session::forget('Basket.' .$template_id);

                $json['error'] = false;
                $json['total'] = $this->total();
                $json['count'] = $this->count();
                $json['message'] = "L'article a bien été supprimé du panier";
            } else {
                $json['message'] = "Ce template n'existe pas";
            }
        } else
            $json['message'] = "Vous n'avez pas selectionné de template à supprimer";

        return response()->json($json);
    }


    private function subtotal ($template_id) {

        $template = Template::select('id' , 'price')->where('id' , $template_id)->first();
        return $template->price * Session::get('Basket.' . $template_id);
    }

    private function count () {

        return array_sum(Session::get('Basket'));
    }

    public function recalculate (Request $request ,$template_id) {

        $json = array('error' => true);

        if (!empty($template_id)) {

            $template = Template::where('id' , $template_id);

            if ($template) {

                $quantity = $request->input('quantity');

                if (!is_null($quantity) && is_int($quantity) && $quantity > 1) {}
                Session::put('Basket.'.$template_id , $quantity);

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

        return response()->json($json);
    }

}
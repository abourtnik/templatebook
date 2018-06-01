<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Template;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Total du panier
    protected function total () {

        $total = 0;

        if (Session::has('Basket'))
            $templates = Template::select('id' , 'price')->whereIn('id' , array_keys(Session::get('Basket') ))->get();
        else
            $templates = array();

        foreach ($templates as $template ) {
            $total += $template->price * Session::get('Basket.' . $template->id);
        }

        return number_format($total , 2);
    }

}
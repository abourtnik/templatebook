<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FacturesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function show($id) {

        $order = Order::findOrFail($id);

        if ($order->user->id === Auth::user()->id)
            return response()->file(storage_path('app/factures/'.$id .'.pdf'));
        else
            abort('404');
    }
}
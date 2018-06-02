<?php

namespace App\Http\Controllers;

use App\Order;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct() {

        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {

        $templates = Template::where('user_id', Auth::id())->get();

        $orders = Order::where('user_id', Auth::id())->get();
        
        return view('home', compact('templates' , 'orders'));
    }
}
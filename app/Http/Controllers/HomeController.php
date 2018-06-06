<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Order;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    public function __construct() {

        $this->middleware('auth');

    }

    public function index() {

        $templates = Template::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $orders = Order::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        $comments = Comment::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        
        return view('home', compact('templates' , 'orders' , 'comments'));
    }
}
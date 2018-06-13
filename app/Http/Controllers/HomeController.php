<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Order;
use App\Template;
use App\User;
use App\Vote;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    public function __construct() {

        $this->middleware('auth');

    }

    public function index() {

        $templates = Template::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $orders = Order::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        $comments = Comment::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $votes = Vote::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        $user = User::find(Auth::id());
        $followers = $user->followers;
        $followings = $user->followings;

        return view('home', compact('templates' , 'orders' , 'comments' , 'votes' , 'user' , 'followers' , 'followings'));
    }
}
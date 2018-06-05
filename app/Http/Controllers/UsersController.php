<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class UsersController extends Controller {

    public function show ($id) {

        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
   
    }

    public function avatar () {


    }

    public function isConnected () {

        return !Auth::guest();
    }
}
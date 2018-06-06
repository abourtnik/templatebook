<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller {

    public function show ($id) {

        $user = User::findOrFail($id);

        return view('users.show', compact('user'));

    }

    public function avatar(Request $request) {

        $validator = Validator::make($request->all(), User::$rules);

        if ($validator->passes()) {

            // Store the file
            $request->file('avatar')->store('public/avatars');
            $avatar_name = $request->file('avatar')->hashName();

            $user = Auth::user();

            $user->avatar = $avatar_name;
            $user->save();

            return redirect(route('home'))->with('success', 'Votre avatar a bien été changé !!');
        }
        else {
            return redirect(route('home'))->with('error', $validator->errors());
        }
    }

    public function isConnected () {
        
        return !Auth::guest();

    }
}
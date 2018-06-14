<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller {

    public function show ($id) {

        $user = User::confirmed()->where('id' , $id)->firstOrFail();

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

    public function follow ($user_id) {

        $json = array('error' => true);

        if ($user_id != Auth::id()) {

            $user = User::confirmed()->find($user_id);

            if ($user) {

                // Verify if select user don't have current user in your followers
                $follow = $user->followers->filter(function ($follower) {
                    return $follower->id == Auth::id();
                })->first();

                // Il l'a pas deja follow
                if (!$follow) {

                    $follower = new Follower();
                    $follower->user_id = $user_id;
                    $follower->follower_id = Auth::id();

                    $follower->save();

                    $json['error'] = false;
                }

                else $json['message'] = "Already follow";
            }

            else $json['message'] = "User not exist";
        }

        else $json['message'] = "One self";

        return response()->json($json);
    }

    public function unfollow ($user_id) {

        $json = array('error' => true);

        if ($user_id != Auth::id()) {

            $user = User::confirmed()->find($user_id);

            if ($user) {
                Follower::where(array('user_id' => $user_id, 'follower_id' => Auth::id()))->delete();
                $json['error'] = false;
            }

            else $json['message'] = "User not exist";
        }

        else $json['message'] = "One self";

        return response()->json($json);
    }
}
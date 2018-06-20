<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Suggestion;

class SuggestionsController extends Controller
{

    public function add(Request $request)
    {

        $validator = Validator::make($request->all(), Suggestion::$rules);

        if ($validator->passes()) {

            // MAX 5 suggestion per user

            if (Auth::user()->suggestions->count() < 5) {

                // Save comment
                $suggestion = new Suggestion();

                $suggestion->content = $request->input('content');
                $suggestion->user_id = Auth::id();

                $suggestion->save();

                return redirect()->back()->with('success', 'Votre demande a bien été ajouté !!');
            } else
                return redirect()->back()->with('error', 'Vous ne pouvez ecrire plus de 5 demandes');
        } else {
            return redirect()->back()->with('error', 'Une erreur est survenue votre demande n\'a pas été ajouté');
        }
    }

    public function remove($id, $csrf_token = null)
    {

        if ($csrf_token === csrf_token()) {

            $suggestion = Suggestion::findOrFail($id);
            $suggestion->delete();

            return redirect()->back()->with('success', 'Votre suggestion a bien été supprimé');
        } else
            abort('404');
    }

    public function like($id) {

        $json = array('error' => true);

        $suggestion = Suggestion::find($id);

        if ($suggestion) {

            if (!userLikeSuggestion($suggestion)) {

                $like = new Like();
                $like->user_id = Auth::id();

                $suggestion->likes()->save($like);

                $json['like_count'] = Like::where(array('suggestion_id' => $suggestion->id))->count();
                $json['error'] = false;
            }

            else $json['message'] = "Already like";
        }

        else $json['message'] = "Sugestion not exist";

        return response()->json($json);
    }




    public function unlike ($id) {

        $json = array('error' => true);

        $sugestion = Suggestion::find($id);

        if ($sugestion) {

            Like::where(array('user_id' => Auth::id(), 'suggestion_id' => $id))->delete();

            $json['like_count'] = Like::where(array('suggestion_id' => $sugestion->id))->count();
            $json['error'] = false;
        }

        else $json['message'] = "Sugestion not exist";

        return response()->json($json);
    }
}
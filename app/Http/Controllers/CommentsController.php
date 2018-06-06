<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Template;

class CommentsController extends Controller {

    public function add(Request $request) {

        $validator = Validator::make($request->all(), Comment::$rules);

        if ($validator->passes()) {

            // Verify if user already comments this template

            $template = Template::findorFail($request->input('template_id'));

            if ($template->comments->filter(function ($comment) {return $comment->user_id == Auth::user()->id;})->count() == 0) {
                
                // Save comment
                $comment = new Comment();

                $comment->content = $request->input('content');
                $comment->user_id = Auth::id();
                $comment->template_id = $request->input('template_id');

                $comment->save();

                return redirect()->back()->with('success', 'Votre commentaire a bien été ajouté !!');
            }
        }

        else {
            return redirect()->back()->with('error', 'Une erreur est survenue votre commentire n\'a pas été ajouté');
        }
    }

    public function remove($id , $csrf_token = null) {

        if ($csrf_token === csrf_token() ) {

            $comment = Comment::findOrFail($id);
            $comment->delete();

            return redirect()->back()->with('success', 'Votre commentaire a bien été supprimé');
        }
        
        else
            abort('404');
    }
}
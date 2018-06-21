<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Media;
use App\Template;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TemplatesController extends Controller {

    public function __construct() {
        $this->middleware('auth' , ['except' => ['show' , 'download']]);
    }

    public function index() {
    }

    public function add(Request $request) {

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), array_merge(Template::$created_rules , Media::$rules));

            if ($validator->passes()) {
                
                // Store the source
                $request->file('source')->store('templates');
                $source_name = $request->file('source')->hashName();
                
                // Save template
                $template = new Template();
                
                $template->name = $request->input('name');
                $template->description = $request->input('description');
                $template->price = $request->input('price');
                $template->source = $source_name;
                $template->user_id = Auth::id();
                $template->category_id = $request->input('category');
                
                $template->save();

                // Upload and save medias
                for ($i = 0 ; $i <= 2 ; $i ++) {

                    if (!is_null($request->input('type.'.$i))) {

                        if ($request->input('type.'.$i) == 'image') {

                            $request->file('file.'.$i)->store('public/medias');
                            $media_name = $request->file('file.'.$i)->hashName();
                            $media = new Media(['file' => $media_name, 'type' => 'image']);
                        }

                        else
                            $media = new Media(['file' => $request->input('youtube.'.$i), 'type' => 'youtube']);

                    }

                    if (isset($media))
                        $template->medias()->save($media);
                }
                return redirect(route('home'))->with('success', 'Votre template a bien été ajouté !!');
            }

            else {

                return redirect(route('template-add'))->withInput()->withErrors($validator->errors());
            }
        }
        else {
            $categories = Category::get();
            return view('templates.add' , compact('categories'));
        }
    }
    
    public function show($id) {

        $template = Template::findorFail($id);
        $template->increment('views');
        return view('templates.show', compact('template'));
    }

    public function update($id , Request $request) {

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), array_merge(Template::$updated_rules , Media::$rules));

            if ($validator->passes()) {

                $template = Template::where('user_id' , Auth::id())->findOrFail($id);

                // Store the file
                if ($request->hasFile('source')) {
                    $request->file('source')->store('templates');
                    $source_name = $request->file('source')->hashName();
                    $template->source = $source_name;
                }
                // Update template
                $template->name = $request->input('name');
                $template->description = $request->input('description');
                $template->price = $request->input('price');
                $template->category_id = $request->input('category');
                
                $template->save();

                // Update medias
                for ($i = 0 ; $i <= 2 ; $i ++) {

                    if (!is_null($request->input('type.'.$i))) {

                        // Type image
                        if ($request->input('type.'.$i) == 'image') {

                            // Image was changed => upload new image
                            if ($request->hasFile('file.'.$i)) {

                                $request->file('file.'.$i)->store('public/medias');
                                $media_name = $request->file('file.'.$i)->hashName();

                                // Update image
                                if (isset($template->medias[$i])) {
                                    $media = $template->medias[$i];
                                    $media->file = $media_name;
                                    $media->type = 'image';
                                }

                                // New image
                                else
                                    $media = new Media(['file' => $media_name, 'type' => 'image']);
                            }
                        }

                        // Type youtube

                        else {

                            if (isset($template->medias[$i])) {
                                $media = $template->medias[$i];
                                $media->file = $request->input('youtube.' . $i);
                                $media->type = 'youtube';
                            } else
                                $media = new Media(['file' => $request->input('youtube.' . $i), 'type' => 'youtube']);
                        }
                    }

                    if (isset($media))
                        $template->medias()->save($media);
                }
                return redirect(route('home'))->with('template-message', 'Votre template a bien été modifié !!');
            }
            else {
                return redirect(route('template-update' , ['id' => $id]))->withInput()->withErrors($validator->errors());
            }
        }
        else {

            $template = Template::where('user_id' , Auth::id())->findOrFail($id);
            $categories = Category::get();

            return view('templates.update' , compact('template' , 'categories'));
        }
    }

    public function remove($id , $csrf_token = null) {

        if ($csrf_token === csrf_token() ) {
            $template = Template::where('user_id' , Auth::id())->findOrFail($id);
            $template->delete();
            return redirect(route('home'))->with('success', 'Votre template a bien été supprimé');
        }
         else
             abort('404');
    }

    public function download ($id) {

        $template = Template::findOrFail($id);
        
        if ($template->price == 0) {

            $template->increment('downloads');
            return response()->download(storage_path('app/templates/'.$template->source));
        }

        else {

            if ((Auth::check() && $template->user->id === Auth::user()->id) || (Auth::check() && userBuyTemplate($template))) {

                $template->increment('downloads');
                return response()->download(storage_path('app/templates/'.$template->source));
            }

        else
            return redirect(url('/'))->with('error', 'Vous ne pouvez pas télécharger ce template');
        }
    }

    public function vote ($id = null ,  Request $request) {
        /* Code :
            0 -> new
            1 -> delete
            2 -> change
        */
        $json = array('error' => true);
        $template = Template::findOrFail($id);
        if ( (int) $request->input('status') === 0 || (int) $request->input('status') === 1) {
            
            // Verify if user already vote for this template
            $vote = $template->votes->filter(function ($votes) {return $votes->user_id == Auth::id(); })->first();
            
            // Il a déja voté pour ce template
            if ($vote) {

                // Si le vote cliqueé est le meme alors on l'enleve
                if ($vote->status === (int) $request->input('status') ){
                    Vote::find($vote->id)->delete();
                    
                    $json['code'] = 1;
                }

                // Si le vote cliquer n'est pas le meme change le status du vote
                else {
                    $vote->status = $request->input('status');
                    $template->votes()->save($vote);

                    $json['code'] = 2;
                }
            }

            // Si il n'a jamais voté on creer un nouveau vote
            else {
                $vote = new Vote();
                $vote->status = $request->input('status');
                $vote->user_id = Auth::id();
                
                $template->votes()->save($vote);

                $json['code'] = 0;
            }
        
            $json['like_count'] = Vote::where(array('template_id' => $template->id , 'status' => 1))->count();
            $json['unlike_count'] = Vote::where(array('template_id' => $template->id , 'status' => 0))->count();
            $json['error'] = false;
        
        }
        else
            $json['message'] = "Erreur status";

        return response()->json($json);
    }
}
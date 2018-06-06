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

    private $images_extensions = ['png' , 'jpeg' , 'jpg' , 'gif'];

    private $videos_extensions = ['mp4' , 'avi'];

    public function __construct() {

        $this->middleware('auth' , ['except' => ['show']]);

    }

    public function index() {

    }

    public function add(Request $request) {

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), Template::$created_rules);

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
                for ($i = 1 ; $i <= 3 ; $i ++) {

                    if ($request->hasFile('media'.$i)) {
                        $request->file('media'.$i)->store('public/medias');
                        $media_name = $request->file('media'.$i)->hashName();
                       
                        $media = new Media(['file' => $media_name, 'type' => 'image']);
                    }
                    else if (!empty($request->input('media'.$i))) {
                        $media = new Media(['file' => $request->input('media'.$i), 'type' => 'youtube']);
                    }

                    if (isset($media))
                        $template->medias()->save($media);
                }
                return redirect(route('home'))->with('success', 'Votre template a bien été ajouté !!');
            }
            else {
                return redirect(route('template-add'))->withErrors($validator->errors());
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

            $validator = Validator::make($request->all(), Template::$updated_rules);

            if ($validator->passes()) {

                $template = Template::findorFail($id);

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
                for ($i = 1 ; $i <= 3 ; $i ++) {
                    if ($request->hasFile('media'.$i)) {

                        // Remove previous media file
                        $request->file('media'.$i)->store('public/medias');
                        $media_name = $request->file('media'.$i)->hashName();

                        if (isset($template->medias[$i-1])) {

                            $media = $template->medias[$i-1];
                            $media->file = $media_name;
                            $media->type = 'image';
                        }
                        else
                            $media = new Media(['file' => $media_name, 'type' => 'image']);
                    }
                    else if (!empty($request->input('media'.$i))) {
                        if (isset($template->medias[$i-1])) {
                            $media = $template->medias[$i-1];
                            $media->file = $request->input('media' . $i);
                            $media->type = 'youtube';
                        }
                        else
                            $media = new Media(['file' => $request->input('media'.$i), 'type' => 'youtube']);
                    }
                    if (isset($media))
                        $template->medias()->save($media);
                }
                return redirect(route('home'))->with('template-message', 'Votre template a bien été modifié !!');
            }
            else {
                return redirect(route('template-update' , ['id' => $id]))->withErrors($validator->errors());
            }
        }
        else {
            $template = Template::find($id);
            $categories = Category::get();
            return view('templates.update' , compact('template' , 'categories'));
        }
    }
    public function remove($id , $csrf_token = null) {
        if ($csrf_token === csrf_token() ) {
            $template = Template::findOrFail($id);
            $template->delete();
            return redirect(route('home'))->with('success', 'Votre template a bien été supprimé');
        }
         else
             abort('404');
    }
    public function download ($id) {

        $template = Template::findOrFail($id);

        if ($template->price == 0 || (Auth::check() && $template->user->id === Auth::user()->id) || (Auth::check() && userBuyTemplate($template))) {

            $template->increment('downloads');
            
            return response()->download(storage_path('app/templates/'.$template->source));
        }
        else {
            return redirect(route('home'))->with('error', 'Vous ne pouvez pas télécharger ce template');
        }
    }
    public function vote ($id = null ,  Request $request) {

        $json = array('error' => true);

        $template = Template::findOrFail($id);

        // Verify if user already vote for this template
        $vote = new Vote();

        $vote->status = $request->input('status');
        $vote->user_id = Auth::id();

        $template->votes()->save($vote);

        $json['error'] = false;
        $json['message'] = "Le vote a ete effectué";

        return response()->json($json);
    }
}
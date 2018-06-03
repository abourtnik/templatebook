<?php

namespace App\Http\Controllers;

use App\Category;
use App\Media;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TemplatesController extends Controller {

    public function __construct() {
        $this->middleware('auth' , ['except' => ['show']]);
    }

    public function index() {
    }

    public function add(Request $request) {

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), Template::$rules);

            if ($validator->passes()) {

                $this->validate($request, Template::$rules);

                // Store the file
                $request->file->store('templates');
                $file_name = $request->file->hashName();

                // Save template
                $template = new Template();

                $template->name = $request->input('name');
                $template->description = $request->input('description');
                $template->price = $request->input('price');
                $template->file = $file_name;
                $template->user_id = Auth::id();
                $template->category_id = $request->input('category');

                $template->save();

                // Upload and save medias
                for ($i = 1 ; $i <= 3 ; $i ++) {

                    if ($request->hasFile('media'.$i)) {
                        $request->file('media'.$i)->store('public/medias');
                        $media_name = $request->file('media'.$i)->hashName();
                        $media = new Media(['file' => $media_name, 'type' => 'image']);
                        $template->medias()->save($media);
                    }
                }

                return redirect(route('home'))->with('success', 'Template ajouté');
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

    public function store(Request $request)
    {
        //
    }

    public function show($id) {

        $template = Template::findorFail($id);
        $template->increment('views');
        return view('templates.show', compact('template'));
    }

    public function update($id , Request $request) {

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), Template::$rules);

            if ($validator->passes()) {

                $this->validate($request, Template::$rules);
                return redirect(route('home'))->with('template-message', 'Template modifi"');

            }
            else {

                return redirect(route('template-update'))->withErrors($validator->errors());
            }
        }
        else {

            $template = Template::find($id);
            return view('templates.update' , compact('template'));
        }
    }

    public function remove(Request $request, $id) {

        $template = Template::findOrFail($id);
        $template->delete();

    }
    public function download ($id) {

        $template = Template::findOrFail($id);

        if ($template->price == 0 || $template->user->id === Auth::user()->id) {

            $template->increment('downloads');
            return response()->download(storage_path('app/templates/'.$template->file));

        }
        else {

            return redirect(route('home'))->with('error', 'Vous ne pouvez pas télécharger ce template');
            
        }
    }
}
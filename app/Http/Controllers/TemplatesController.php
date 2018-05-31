<?php
namespace App\Http\Controllers;
use App\Media;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TemplatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), Template::$rules);
            if ($validator->passes()) {
                $this->validate($request, Template::$rules);
                // Store the file
                $request->file->store('templates');
                $file_name = $request->file->hashName();
                // Store the media
                $request->image->store('public/medias');
                $image_name = $request->image->hashName();
                // Save template
                $template = new Template();
                $template->name = $request->input('name');
                $template->description = $request->input('description');
                $template->price = $request->input('price');
                $template->file = $file_name;
                $template->user_id = Auth::id();
                $template->save();
                // Save media
                $media = new Media(['file' => $image_name , 'type' => 'image']);
                $template->medias()->save($media);
                return redirect(route('template-add'))->with('template-message', 'Template ajouté');
            }
            else {
                return redirect(route('template-add'))->withErrors($validator->errors());
            }
        }
        else
            return view('templates.add');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $template = Template::find($id);
        return view('templates.show', compact('template'));
    }

    public function update($id , Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), Template::$rules);
            if ($validator->passes()) {
                $this->validate($request, Template::$rules);
                return redirect(route('template-add'))->with('template-message', 'Template ajouté');
            }
            else {
                return redirect(route('template-add'))->withErrors($validator->errors());
            }
        }
        else {
            $template = Template::find($id);
            return view('templates.update' , compact('template'));
        }
    }
    
    public function remove(Request $request, $id)
    {
        if ($request->isMethod('post')) {
        }
    }
}
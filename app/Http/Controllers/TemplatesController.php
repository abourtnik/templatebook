<?php
namespace App\Http\Controllers;
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
                // Save template
                $template = new Template();
                $template->name = $request->input('name');
                $template->description = $request->input('description');
                $template->price = $request->input('price');
                $template->file = $file_name;
                $template->user_id = Auth::id();
                $template->save();
                return redirect(route('template-add'))->with('template-message', 'Template ajouté');
            }
            else {
                return redirect(route('template-add'))->withErrors($validator->errors());
            }
        }
        else
            return view('templates.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::find($id);
        return view('templates.show', compact('template'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}
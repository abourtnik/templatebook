<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Template;

class PagesController extends Controller {

    public function index() {

     $templates = Template::get();

     //dd($templates);
     return view('pages.index', compact('templates'));
    }
}
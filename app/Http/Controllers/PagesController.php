<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Template;

class PagesController extends Controller {

    public function index() {

        $templates = Template::get();
        $categories = Category::get();
        return view('pages.index', compact('templates' , 'categories'));

    }

    public function contact() {

        return view('pages.contact');

    }

    public function about() {

        return view('pages.about');

    }

    public function mentions_legales() {

        return view('pages.mentions-legales');
        
    }
}
<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Template;

class PagesController extends Controller {

    public function index() {

        $templates = Template::select('*', DB::raw('downloads + views as popularity_score'))->orderBy('popularity_score', 'desc')->limit(10)->get();
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

    public function search(Request $request) {

        $q = $request->input('q');
        $templates = Template::select('*', DB::raw('downloads + views as popularity_score'))->where('name', 'like', '%'.$q.'%')->orderBy('popularity_score', 'desc')->get();
        
        return view('pages.search' , compact('templates' , 'q'));
    }
}
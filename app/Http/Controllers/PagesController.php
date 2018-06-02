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
}
<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller {

    public function show($id) {

        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
        
    }
}
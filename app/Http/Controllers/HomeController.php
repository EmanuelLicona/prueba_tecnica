<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {   
        $categories = Category::where('state', 1)->get();

        return view('index', compact('categories'));
    }
}

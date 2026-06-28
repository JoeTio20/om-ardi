<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::where('is_active', true)->take(3)->get();
        return view('home', compact('featured'));
    }
}
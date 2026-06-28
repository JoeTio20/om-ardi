<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        $sort     = $request->get('sort', 'featured');

        $query = Product::where('is_active', true);

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        if ($sort === 'price_asc')  $query->orderBy('price', 'asc');
        elseif ($sort === 'price_desc') $query->orderBy('price', 'desc');
        elseif ($sort === 'newest') $query->latest();
        else $query->oldest();

        $products = $query->get();

        return view('product', compact('products', 'category', 'sort'));
    }
}
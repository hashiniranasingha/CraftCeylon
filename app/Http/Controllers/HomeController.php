<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->take(6)
            ->get();

        return view('welcome', compact(
            'featuredProducts',
            'categories'
        ));
    }
}

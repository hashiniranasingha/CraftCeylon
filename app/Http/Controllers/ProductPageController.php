<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        $products = Product::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            });

        // Existing Category Filter
        if ($request->filled('category')) {
            $products->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category)
                    ->where('is_active', true);
            });
        }

        // Homepage Collection Filters
        if ($request->filled('collection')) {

            switch ($request->collection) {

                // Wooden Crafts Collection
                case 'wooden':
                    $products->whereHas('category', function ($query) {
                        $query->where('slug', 'wooden-crafts')
                            ->where('is_active', true);
                    });
                    break;

                // Home Decorations Collection
                case 'home-decoration':
                    $products->whereHas('category', function ($query) {
                        $query->whereIn('slug', [
                            'wooden-crafts',
                            'batik-crafts',
                            'clay-pottery',
                        ])->where('is_active', true);
                    });
                    break;

                // Traditional Handicrafts Collection
                case 'traditional':
                    // Show all active handmade products
                    break;
            }
        }

        $products = $products
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact(
            'products',
            'categories'
        ));
    }

    public function show($slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('products.show', compact(
            'product',
            'relatedProducts'
        ));
    }
}

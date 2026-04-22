<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(string $slug): View
    {
        $product = Product::active()
            ->where('slug', $slug)
            ->with(['category', 'media'])
            ->firstOrFail();

        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['category', 'media'])
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}

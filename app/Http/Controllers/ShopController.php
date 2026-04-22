<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function __invoke(Request $request): View
    {
        $categories = Category::active()
            ->ordered()
            ->withCount(['products' => fn ($q) => $q->active()])
            ->get();

        $activeCategory = (string) $request->query('category', '');
        $sort = (string) $request->query('sort', 'featured');

        $query = Product::active()->with(['category', 'media']);

        if ($activeCategory !== '') {
            $query->whereHas('category', fn ($q) => $q->where('slug', $activeCategory));
        }

        match ($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'newest'     => $query->latest(),
            default      => $query->orderByDesc('is_featured')->orderByDesc('created_at'),
        };

        $products = $query->paginate(16)->withQueryString();

        $totalProducts = Product::active()->count();

        return view('pages.shop', compact('categories', 'products', 'activeCategory', 'sort', 'totalProducts'));
    }
}

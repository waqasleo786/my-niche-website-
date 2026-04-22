<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $categories = Category::active()
            ->ordered()
            ->withCount(['products' => fn ($q) => $q->active()])
            ->get();

        $featuredProducts = Product::featured()
            ->active()
            ->with(['category', 'media'])
            ->take(8)
            ->get();

        return view('pages.home', compact('categories', 'featuredProducts'));
    }
}

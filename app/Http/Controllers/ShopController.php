<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
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

        $activeCategoryModel = $activeCategory !== ''
            ? $categories->firstWhere('slug', $activeCategory)
            : null;

        if ($activeCategoryModel) {
            SEOMeta::setTitle($activeCategoryModel->name);
            SEOMeta::setDescription('Browse ' . $activeCategoryModel->name . ' at Shahid Brothers. Quality promotional and corporate gift items in Pakistan.');
            OpenGraph::setTitle($activeCategoryModel->name . ' — Shahid Brothers');
            OpenGraph::setDescription('Browse ' . $activeCategoryModel->name . ' at Shahid Brothers. Quality promotional and corporate gift items in Pakistan.');
        } else {
            SEOMeta::setTitle('Shop All Products');
            SEOMeta::setDescription('Browse all promotional and corporate gift items at Shahid Brothers. Keychains, pens, power banks, USBs, bottles, tumblers, clocks. Bulk orders welcome.');
            OpenGraph::setTitle('Shop All Products — Shahid Brothers');
            OpenGraph::setDescription('Browse all promotional and corporate gift items at Shahid Brothers. Bulk B2B orders welcome.');
        }
        OpenGraph::setUrl(url()->current());
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

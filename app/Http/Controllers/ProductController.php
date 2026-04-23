<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(string $slug): View
    {
        $product = Product::active()
            ->where('slug', $slug)
            ->with(['category', 'media'])
            ->firstOrFail();

        $imageUrl = $product->hasMedia('images')
            ? $product->getFirstMediaUrl('images', 'card')
            : null;

        SEOMeta::setTitle($product->name);
        SEOMeta::setDescription($product->description
            ? \Str::limit(strip_tags($product->description), 155)
            : 'Buy ' . $product->name . ' from Shahid Brothers. Quality promotional gift items in Pakistan.');
        SEOMeta::setCanonical(route('products.show', $product->slug));

        OpenGraph::setTitle($product->name . ' — Shahid Brothers');
        OpenGraph::setDescription($product->description
            ? \Str::limit(strip_tags($product->description), 155)
            : 'Buy ' . $product->name . ' from Shahid Brothers.');
        OpenGraph::setType('og:product');
        OpenGraph::setUrl(route('products.show', $product->slug));
        if ($imageUrl) {
            OpenGraph::addImage($imageUrl, ['width' => 800, 'height' => 800]);
        }

        JsonLd::setType('Product');
        JsonLd::setTitle($product->name);
        JsonLd::setDescription($product->description
            ? \Str::limit(strip_tags($product->description), 155)
            : 'Buy ' . $product->name . ' from Shahid Brothers.');
        JsonLd::addValue('sku', $product->sku ?? $product->id);
        JsonLd::addValue('brand', ['@type' => 'Brand', 'name' => 'Shahid Brothers']);
        JsonLd::addValue('offers', [
            '@type'         => 'Offer',
            'priceCurrency' => 'PKR',
            'price'         => $product->price,
            'availability'  => $product->isInStock()
                ? 'https://schema.org/InStock'
                : 'https://schema.org/OutOfStock',
            'url'           => route('products.show', $product->slug),
        ]);
        if ($imageUrl) {
            JsonLd::addImage($imageUrl);
        }

        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['category', 'media'])
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}

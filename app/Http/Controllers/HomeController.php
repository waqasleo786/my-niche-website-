<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        SEOMeta::setTitle('Promotional & Corporate Gift Items in Pakistan');
        SEOMeta::setDescription('Buy premium promotional and corporate gift items in Pakistan. Keychains, pens, power banks, USBs, bottles, tumblers, clocks. Bulk B2B orders welcome.');
        SEOMeta::setKeywords(['promotional gifts pakistan', 'corporate gift items', 'bulk gifts', 'custom gifts pakistan', 'shahid brothers']);

        OpenGraph::setTitle('Shahid Brothers — Promotional & Corporate Gift Items in Pakistan');
        OpenGraph::setDescription('Buy premium promotional and corporate gift items in Pakistan. Bulk B2B orders welcome.');
        OpenGraph::setType('website');
        OpenGraph::setUrl(url('/'));

        JsonLd::setType('Organization');
        JsonLd::setTitle('Shahid Brothers');
        JsonLd::setDescription('Premium promotional and corporate gift items in Pakistan.');
        JsonLd::addValue('url', url('/'));
        JsonLd::addValue('telephone', '+923084570786');
        JsonLd::addValue('address', [
            '@type'           => 'PostalAddress',
            'addressCountry'  => 'PK',
        ]);

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

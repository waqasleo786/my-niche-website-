<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        SEOMeta::setTitle('My Account');
        SEOMeta::setDescription('Manage your Shahid Brothers account, view orders and account details.');
        SEOMeta::setRobots('noindex,nofollow');

        try {
            $orders = $user->orders()
                ->with('items')
                ->latest()
                ->limit(5)
                ->get();
        } catch (\Throwable) {
            $orders = new Collection();
        }

        return view('dashboard', compact('user', 'orders'));
    }
}

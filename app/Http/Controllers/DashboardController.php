<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user   = $request->user();

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

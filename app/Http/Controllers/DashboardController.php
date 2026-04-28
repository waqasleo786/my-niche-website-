<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user   = $request->user();
        $orders = $user->orders()
            ->with('items')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact('user', 'orders'));
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use App\Listeners\MergeCartOnLogin;
use App\Services\CartService;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->scoped(CartService::class, fn () => new CartService());
    }

    public function boot(): void
    {
        RedirectIfAuthenticated::redirectUsing(fn () => route('dashboard'));

        Event::listen(Login::class, MergeCartOnLogin::class);

        View::composer('partials.header', function (\Illuminate\View\View $view) {
            $cartService = app(CartService::class);
            $view->with('cartItemCount', $cartService->getItemCount());
        });
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureB2bIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->is_b2b && ! $user->is_verified) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Your B2B account is pending admin approval.',
                ], 403);
            }

            return redirect()->route('dashboard')
                ->with('warning', 'Your B2B account is pending admin approval. You will be notified once approved.');
        }

        return $next($request);
    }
}

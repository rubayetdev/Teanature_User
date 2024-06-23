<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareCartCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cart = Session::get('cart', []);
        $cartCount = array_reduce($cart, function ($carry, $item) {
            return $carry + $item['quantity'];
        }, 0);

        // Share cart count with all views
        View::share('cartCount', $cartCount);
        return $next($request);
    }
}

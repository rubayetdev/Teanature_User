<?php



namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ...
    protected $middlewareGroups = [
        'web' => [
            // Other middleware
            \App\Http\Middleware\ShareCartCount::class,
        ],
    ];

    // ...
}

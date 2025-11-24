<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EditorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && in_array(auth()->user()->role, ['admin', 'editor'])) {
            return $next($request);
        }

        return redirect('/')->with('error', 'ليس لديك صلاحية للوصول إلى هذه الصفحة.');
    }
}
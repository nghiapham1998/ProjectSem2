<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckShipping
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('shipping_id')) {
            return $next($request);
        }
        $request->session()->forget('shipping_id');
        return redirect('checkout');
    }
}

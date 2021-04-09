<?php

namespace App\Http\Middleware;

use App\Events\ServingMonolith;

class DispatchServingMonolithEvent
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        ServingMonolith::dispatch($request);

        return $next($request);
    }
}

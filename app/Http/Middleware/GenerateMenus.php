<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('MainMenu', function ($menu) {
            $menu->add('Home');
            $menu->add('Services', 'services');
            $menu->add('Contact', 'contact');
            $menu->add('About', 'about');
        });

        return $next($request);
    }
}

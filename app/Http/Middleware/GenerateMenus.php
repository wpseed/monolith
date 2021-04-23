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
            $menu->add('Dashboard', ['route'  => 'dashboard'])->data('icon', 'ri-home-line');
            $menu->add('Services', 'services')->data('icon', 'ri-service-line');
            $menu->get('services')->add('First service', ['route'  => 'dashboard']);
            $menu->item('services')->add('Second service', ['route'  => 'dashboard']);
            $menu->item('services')->add('Third service', ['route'  => 'dashboard']);
            $menu->add('Contact', 'contact')->data('icon', 'ri-contacts-book-line');
            $menu->add('About', 'about')->data('icon', 'ri-service-line');
        });

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Menu;

class BuildMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Menu::make('mainMenu', function ($menu) {
            $menu->add('Start', 'home');

            $books = $menu->add('<i class="fa fa-fw fa-book"></i> Bücher', 'books');
            $books->add('<i class="fa fa-fw fa-list"></i> Liste', 'books');
            $books->add('<i class="fa fa-fw fa-plus"></i> Hinzufügen', 'books/create');

            $customers = $menu->add('<i class="fa fa-fw fa-users"></i> Kunden', 'customers');
            $customers->add('<i class="fa fa-fw fa-list"></i> Liste', 'customers');
            $customers->add('<i class="fa fa-fw fa-plus"></i> Hinzufügen', 'customers/create');
        });

        return $next($request);
    }
}

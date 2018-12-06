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

            $books = $menu->add('<i class="fa fa-fw fa-book"></i> Bücher', 'books')->active('books/*');
            $books->add('<i class="fa fa-fw fa-list"></i> Liste', 'books')->active('books/*/edit');
            $books->add('<i class="fa fa-fw fa-plus"></i> Hinzufügen', 'books/create');

            $customers = $menu->add('<i class="fa fa-fw fa-users"></i> Leser*innen', 'readers');
            $customers->add('<i class="fa fa-fw fa-list"></i> Liste', 'readers')->active('readers/*/edit');
            $customers->add('<i class="fa fa-fw fa-plus"></i> Hinzufügen', 'readers/create');

            $lendings = $menu->add('<i class="fa fa-fw fa-clock-o"></i> Ausleihen', 'lendings');
            $lendings->add('<i class="fa fa-fw fa-list"></i> Liste', 'lendings')->active('lendings/*/edit');
            $lendings->add('<i class="fa fa-fw fa-plus"></i> Hinzufügen', 'lendings/create');

            $books = $menu->add('<i class="fa fa-fw fa-cogs"></i> Stammdaten', 'tables')->active('tables/*');
            $books->add('<i class="fa fa-fw fa-user"></i> Autor*innen', 'tables/authors')->active('tables/authors/*');
            $books->add('<i class="fa fa-fw fa-map-marker"></i> Orte', 'tables/origins')->active('tables/origins/*');
            $books->add('<i class="fa fa-fw fa-location-arrow"></i> Gattungen', 'tables/categories')->active('tables/categories/*');
            $books->add('<i class="fa fa-fw fa-tag"></i> Schlagworte', 'tables/tags')->active('tables/tags/*');
        });

        return $next($request);
    }
}

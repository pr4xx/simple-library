<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use JavaScript;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fix mysql
        Schema::defaultStringLength(191);

        // Carbon options
        Carbon::setLocale('de');

        // Global javascript variables
        $url = url('/');
        if(ends_with($url, '/')) {
            $url = substr($url, 0, -1);
        }

        $asset = asset('/');
        if(ends_with($asset, '/')) {
            $asset = substr($asset, 0, -1);
        }

        JavaScript::put([
            'global' => [
                'url' => $url,
                'asset' => $asset
            ]
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        Blade::directive('publications', function () {
            $provider = "https://raw.githubusercontent.com/uxsad/.github/main/profile/README.md";
            $readme = file_get_contents($provider);
            $marker = "publications";
            preg_match("/<!-- $marker start -->\n(.*)\n<!-- $marker end -->/s", $readme, $match);
            return $match[1];
        });
    }
}

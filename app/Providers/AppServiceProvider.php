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

        Blade::directive('version', function () {
            $git_ref = base_path('.git/refs/heads/main');
            if (!file_exists($git_ref))
                return "no version";

            $hash = file_get_contents($git_ref);
            $short_hash = substr($hash, 0, 7);
            return "<a href='https://github.com/uxsad/frontend/tree/${hash}' target='_blank'>${short_hash}</a>";
        });
    }
}

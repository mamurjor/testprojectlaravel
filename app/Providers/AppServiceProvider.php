<?php

namespace App\Providers;


use App\Models\MembershipLevel;
use App\Models\Menu;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
         View::share('MembershipLevel', MembershipLevel::all());

            View::share('showMenu', Menu::all());

          if (config('app.url')) {
        URL::forceRootUrl(config('app.url')); // route()/url() সবসময় APP_URL ব্যবহার করবে
    }

    if (app()->environment('production')) {
        URL::forceScheme('https'); // প্রোডে https লিঙ্ক
    }

    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menuname;
use View;
use Illuminate\Routing\UrlGenerator;
use App\Models\Category;
use App\Models\Config;
use Session;

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
    public function boot(UrlGenerator $url)
    {
        $adm_menu = Menuname::select(
                        'name',
                        'route',
                        'icon',
                        'menu_id'
                    )
                    ->where('status', '=', 1)
                    ->where('parent_id', '=', 0)
                    ->get();
        $category = Category::select(
                        'category_name',
                        'category_id'
                    )
                    ->where('parent_id', '=', 0)
                    ->get();
        $emailweb = Config::where('id', 4)->first();
        $telpweb  = Config::where('id', 5)->first();
        $titleweb = Config::where('id', 6)->first();
            
        View::share('category', $category);

        View::share('adm_menu', $adm_menu);
        View::share('emailweb', $emailweb->value);
        View::share('telpweb', $telpweb->value);
        View::share('titleweb', $titleweb->value);
    }
}

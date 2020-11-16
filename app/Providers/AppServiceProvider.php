<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        //Tree Category list
        Blade::directive('category_tree', function($arr) {
            dd(($arr));
            $s_arr = sorted_tree_category((array)$arr);
            return render_tree_selector($s_arr, 'parent_id', 'form-control');

        });
    }
}

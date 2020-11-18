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
        Blade::directive('category', function($expresion) {
            return "<?php
            render_tree_selector( sorted_tree_category($expresion),
              'parent_id', 'form-control', '|>>>', true);
             ?>";

        });

        Blade::directive('category_parent', function($expresion) {
            return "<?php
            render_parent_category_selector( $expresion,
              'parent_id', 'form-control', true);
             ?>";

        });
    }
}

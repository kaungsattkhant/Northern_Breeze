<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Relation::morphMap([
            'sell_class'=>'App\Model\SellClassGroupValue',
            'buy_class'=>'App\Model\BuyClassGroupValue',

        ]);

        Relation::morphMap([
            'sell'=>'App\Model\SellGroupValue',
            'buy'=>'App\Model\BuyGroupValue',

        ]);
        Relation::morphMap([
            'custom_sell_class'=>'App\Model\SellCustomClassGroupValue',
            'custom_buy_class'=>'App\Model\BuyCustomClassGroupValue',
        ]);
        Schema::defaultStringLength(191);
    }
}

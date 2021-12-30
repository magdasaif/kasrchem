<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Support\Facades\Schema;

=======
>>>>>>> yasmeen

=======
use Illuminate\Support\Facades\Schema;

>>>>>>> magda
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
<<<<<<< HEAD
<<<<<<< HEAD
        Schema::defaultStringLength(191);
=======
        //
>>>>>>> yasmeen
=======
        Schema::defaultStringLength(191);
>>>>>>> magda
    }
}

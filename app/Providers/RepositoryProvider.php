<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// use App\Http\Interfaces\ProductInterface;
// use App\Http\Repositories\ProductRepository;

class RepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Http\Interfaces\ProductInterface','App\Http\Repositories\ProductRepository');
        $this->app->bind('App\Http\Interfaces\SiteInfoInterface','App\Http\Repositories\SiteInfoRepository');
        $this->app->bind('App\Http\Interfaces\PartnerInterface','App\Http\Repositories\PartnerRepository');
        $this->app->bind('App\Http\Interfaces\PageInterface','App\Http\Repositories\PageRepository');
        $this->app->bind('App\Http\Interfaces\GalleryInterface','App\Http\Repositories\GalleryRepository');



        $this->app->bind('App\Http\Interfaces\SupplierInterface','App\Http\Repositories\SupplierRepository');

        
        //  $this->app->bind(ProductInterface::class, ProductRepository::class);
    }
}

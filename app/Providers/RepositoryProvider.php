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
        $this->app->bind('App\Http\Interfaces\SliderInterface','App\Http\Repositories\SliderRepository');
        $this->app->bind('App\Http\Interfaces\ArticleInterface','App\Http\Repositories\ArticleRepository');



        $this->app->bind('App\Http\Interfaces\SupplierInterface','App\Http\Repositories\SupplierRepository');

                       //================ReleaseInterface================//
        $this->app->bind('App\Http\Interfaces\ReleaseInterface','App\Http\Repositories\ReleaseRepository' );
                        //================SocialInterface================//
        $this->app->bind('App\Http\Interfaces\SocialInterface','App\Http\Repositories\SocialRepository');
                        //================BrancheInterface================//
        $this->app->bind('App\Http\Interfaces\BrancheInterface','App\Http\Repositories\BrancheRepository');
                        //================VideoInterface================//
        $this->app->bind('App\Http\Interfaces\VideoInterface','App\Http\Repositories\VideoRepository');
                        //================SectionInterface================//
          $this->app->bind('App\Http\Interfaces\SectionInterface','App\Http\Repositories\SectionRepository');
    }
}

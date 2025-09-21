<?php

namespace App\Providers;

use App\Models\Api\Admin\Achivement;
use App\Models\Api\Admin\Blog;
use App\Models\Api\Admin\Category;
use App\Models\Api\Admin\Event;
use App\Models\Api\Admin\Feedback;
use App\Models\Api\Admin\Mediaimage;
use App\Models\Api\Admin\Ourteam;
use App\Models\Api\Admin\Ourwork;
use App\Models\Api\Admin\Product;
use App\Models\Api\Admin\Service;
use App\Models\Api\Admin\Slider;
use App\Observers\Admin\Achivement\AcvhivementObserver;
use App\Observers\Admin\Blog\BlogObserver;
use App\Observers\Admin\Category\CategoryObserver;
use App\Observers\Admin\Event\EventObserver;
use App\Observers\Admin\Feedback\FeedbackObserver;
use App\Observers\Admin\Mediaimage\MediaimageObserver;
use App\Observers\Admin\Ourteam\OurteamObserver;
use App\Observers\Admin\Ourwork\OurworkObserver;
use App\Observers\Admin\Product\ProductObserver;
use App\Observers\Admin\Service\ServiceObserver;
use App\Observers\Admin\Slider\SliderObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

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

    }

    


    
}
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\MenuRepositoryInterface::class,
            \App\Repositories\Eloquent\MenuRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\GalleryRepositoryInterface::class,
            \App\Repositories\Eloquent\GalleryRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\FacilityRepositoryInterface::class,
            \App\Repositories\Eloquent\FacilityRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\TestimonialRepositoryInterface::class,
            \App\Repositories\Eloquent\TestimonialRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ContactRepositoryInterface::class,
            \App\Repositories\Eloquent\ContactRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production') || str_starts_with((string) config('app.url'), 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}

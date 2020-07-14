<?php

namespace App\Providers;

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
        $this->app->bind(
            \App\Services\RepositoryDetailsProviderInterface::class,
            \App\Services\GithubRepositoryDetailsProvider::class
        );
        $this->app->bind(
            \App\Services\RepositoryComparatorInterface::class,
            \App\Services\SimpleRepositoryComparator::class
        );

    }
}

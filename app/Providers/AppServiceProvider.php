<?php

namespace App\Providers;

use App\Providers\DependencyInjection\DependencyInjection;
use App\Support\Utils\Paginator\Concrete\Pagination;
use App\Support\Utils\Paginator\Interface\IPagination;
use App\Support\Utils\Params\Concrete\Search;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        DependencyInjection::providers($this->app)
        ->each(function (DependencyInjection $di): void {
            $di->configure();
        });

        $this->app->bind(IPagination::class, function ($app) {
            if (is_null(request()->page) && is_null(request()->perPage)) {
                return new Pagination(null, null);
            }
            return new Pagination(request()->page, request()->perPage);
        });

        $this->app->bind(ISearch::class, function ($app) {
            return new Search(request()->search);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            $class = get_class($model);

            Log::info("Tentativa de carregamento lento [{$relation}] no modelo [{$class}].");
        });
    }
}

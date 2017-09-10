<?php

namespace Muratbsts\Reactable\Providers;

use Illuminate\Support\ServiceProvider;
use Muratbsts\Reactable\Reactable;

/**
 * Class ReactableServiceProvider
 * @package Muratbsts\Reactable\Providers
 */
class ReactableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'reactable');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../resources/views' => $this->app->resourcePath('views/vendor/reactions'),
            ], 'views');
        }

        if (! class_exists('CreateReactionsTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__.'/../../migrations/create_reactions_table.php.stub' => database_path("/migrations/{$timestamp}_create_reactions_table.php.php"),
            ], 'migrations');
        }
    }

    /**
     * Register the application services
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Reactable::class, function () {
            return new Reactable();
        });
    }
}
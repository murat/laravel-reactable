<?php

namespace Muratbsts\Reactable\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ReactableServiceProvider
 *
 * @package Muratbsts\Reactable\Providers
 */
class ReactableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services
     *
     * @return void
     */
    public function boot()
    {
        if (! class_exists('CreateReactionsTable')) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes(
                [
                __DIR__.'/../../migrations/create_reactions_table.php.stub' => database_path("/migrations/{$timestamp}_create_reactions_table.php.php"),
                ], 'migrations'
            );
        }
    }

    /**
     * Register the application services
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'Muratbsts\Reactable\Reactable', function () {
                return new \Muratbsts\Reactable\Reactable();
            }
        );
    }
}
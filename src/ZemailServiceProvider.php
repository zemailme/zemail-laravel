<?php

namespace Zemail\Laravel;

use Illuminate\Support\ServiceProvider;
use Zemail\Client;

class ZemailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/zemail.php', 'zemail');

        $this->app->singleton(Client::class, function ($app) {
            $config = $app['config']->get('zemail');

            // The PHP SDK Client constructor signature:
            // public function __construct(string $apiKey, ?string $version = '2026-04-23', array $guzzleOptions = [])
            return new Client(
                $config['api_key'] ?? '',
                $config['version'] ?? '2026-04-23',
                ['base_uri' => $config['base_uri'] ?? 'https://zemail.me/api']
            );
        });

        $this->app->alias(Client::class, 'zemail');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/zemail.php' => config_path('zemail.php'),
            ], 'zemail-config');
        }
    }
}

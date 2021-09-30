<?php

namespace Velostazione\Laravel\BeSMS;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Velostazione\BeSMS\Api as BeSMS;
use Velostazione\BeSMS\Client as BeSMSClient;

class BeSMSServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application services.
     */
    final public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/besms.php', 'besms'
        );

        $this->app->singleton(BeSMS::class, function ($app) {
            if (
                empty($app['config']['besms.username']) ||
                empty($app['config']['besms.password']) ||
                empty($app['config']['besms.id_api'])
            ) {
                throw new \InvalidArgumentException('Missing BeSMS credentials');
            }

            $client = new BeSMSClient();
            return new BeSMS(
                $client,
                $app['config']['besms.username'],
                $app['config']['besms.password'],
                $app['config']['besms.id_api'],
                $app['config']['besms.report_type'],
                $app['config']['besms.sender']
            );
        });
    }

    final public function provides(): array
    {
        return ['beSMS'];
    }
}

<?php

namespace Zemail\Laravel\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Zemail\Laravel\ZemailServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            ZemailServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Zemail' => \Zemail\Laravel\Zemail::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('zemail.api_key', 'test-api-key');
        config()->set('zemail.base_uri', 'https://zemail.me');
    }
}

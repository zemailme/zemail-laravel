<?php

namespace Zemail\Laravel\Tests\Feature;

use Zemail\Client;
use Zemail\Laravel\Tests\TestCase;
use Zemail\Laravel\Zemail;

class FacadeTest extends TestCase
{
    public function test_it_resolves_the_zemail_client_from_the_container()
    {
        $client = app(Client::class);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function test_the_facade_acts_as_a_proxy_for_the_client()
    {
        $this->assertInstanceOf(Client::class, Zemail::getFacadeRoot());
    }
}

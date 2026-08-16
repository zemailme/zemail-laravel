<?php

namespace Zemail\Laravel;

use Illuminate\Support\Facades\Facade;
use Zemail\Client;

/**
 * @method static \Zemail\Resources\AccountResource account()
 * @method static \Zemail\Resources\DomainResource domains()
 * @method static \Zemail\Resources\MailboxResource mailboxes()
 *
 * @see \Zemail\Client
 */
class Zemail extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return Client::class;
    }
}

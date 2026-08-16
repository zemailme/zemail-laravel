<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Zemail API Key
    |--------------------------------------------------------------------------
    |
    | The API Key is used to authenticate with the Zemail API. You can find
    | your API key in your Zemail dashboard under API Settings.
    |
    */
    'api_key' => env('ZEMAIL_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Zemail API Version
    |--------------------------------------------------------------------------
    |
    | The version of the API you wish to use. Zemail may release new versions
    | which require an updated header.
    |
    */
    'version' => env('ZEMAIL_VERSION', '2026-04-23'),

    /*
    |--------------------------------------------------------------------------
    | Base URI
    |--------------------------------------------------------------------------
    |
    | The base URI for the Zemail API.
    |
    */
    'base_uri' => env('ZEMAIL_BASE_URI', 'https://zemail.me/api'),
];

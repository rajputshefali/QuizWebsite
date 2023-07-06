<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '789688803816-qbagofog8r3hm8rsqj2lqnh3udm2co25.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/google/callback',
    ],

    'facebook' => [
        'client_id' => '718064636661902', 
        'client_secret' => '3102612f2bce4fd8138d9246fa7f1c5f',
        'redirect' => 'https://examplelaravel8.test/facebook/callback/'
    ],

];

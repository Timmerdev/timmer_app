<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
    'client_id' => '778584558935764',
    'client_secret' => 'e55ddf7b33fbe14056681f6efc77e763',
    'redirect' => 'http://localhost:8000/social/handle/facebook',
    ],
    'google' => [
    'client_id' => '231536603095-19ks1ef8lru2g5bk0ikugn9gcrlv3m45.apps.googleusercontent.com',
    'client_secret' => 'GZI1j0CWPnKzEZWlXv00dGnx',
    'redirect' => 'http://localhost:8000/social/handle/google',
    ],


];

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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => "1017937282316791",
        'client_secret' => "2cda239405430204bdc75665c9e6a8a6",
        'redirect' => 'http://localhost:81/facebook/callback',
    ],

    'google' => [
        'client_id' => "538401627272-lrmn5b0junojtv6p72rj9vpfudbec2oe.apps.googleusercontent.com",
        'client_secret' => "RVrTPAkTfPVou_rGISaoR3r4",
        'redirect' => 'http://localhost:81/google/callback',
    ],
];

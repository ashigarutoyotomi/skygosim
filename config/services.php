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

    'sim_api' => [
        'key' => env('SIM_API_APP_KEY'),
        'spec' => env('SIM_API_APP_SPEC'),
        'endpoint' => env('SIM_API_APP_ENDPOINT'),
        'payorder' => env('SIM_API_APP_PAYORDER_ENDPOINT'),
        'get_access_token' => env('SIM_API_APP_GET_ACCESS_TOKEN_ENDPOINT'),
        'get_data_bundle' => env('SIM_API_APP_GET_DATA_BUNDLE_ENDPOINT'),
        'get_carrier' => env('SIM_API_APP_GET_CARRIER_ENDPOINT'),
    ],
];

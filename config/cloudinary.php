<?php

/*
|--------------------------------------------------------------------------
| Cloudinary Configuration
|--------------------------------------------------------------------------
*/

return [
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),
    'cloud_url' => env('CLOUDINARY_URL'),
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key' => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
    ],
    'secure' => true,
];

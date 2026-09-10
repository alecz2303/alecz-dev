<?php

return [
    'provider' => env('CHATBOT_PROVIDER', 'local'),
    'remote' => [
        'url' => env('CHATBOT_REMOTE_URL'),
        'key' => env('CHATBOT_REMOTE_KEY'),
        'model' => env('CHATBOT_REMOTE_MODEL'),
        'timeout' => (int) env('CHATBOT_REMOTE_TIMEOUT', 8),
    ],
    'max_message_length' => 500,
];

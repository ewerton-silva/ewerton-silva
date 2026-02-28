<?php

declare(strict_types=1);

return [
    'app_name' => 'NFES',
    'env' => getenv('APP_ENV') ?: 'development',
    'base_url' => getenv('APP_BASE_URL') ?: 'http://localhost',
    'session_name' => 'nfes_session',
    'csrf_ttl' => 3600,
];

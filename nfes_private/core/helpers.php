<?php

declare(strict_types=1);

function app_config(?string $key = null)
{
    static $config;

    if ($config === null) {
        $config = require __DIR__ . '/../config/app.php';
    }

    if ($key === null) {
        return $config;
    }

    return $config[$key] ?? null;
}

function redirect(string $path): void
{
    $baseUrl = rtrim((string) app_config('base_url'), '/');
    header('Location: ' . $baseUrl . $path);
    exit;
}

function is_logged_in(): bool
{
    return isset($_SESSION['user_id']);
}

<?php

declare(strict_types=1);

final class Csrf
{
    public static function token(int $ttl): string
    {
        $now = time();

        if (!isset($_SESSION['_csrf'], $_SESSION['_csrf_time']) || ($now - (int) $_SESSION['_csrf_time']) > $ttl) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
            $_SESSION['_csrf_time'] = $now;
        }

        return (string) $_SESSION['_csrf'];
    }

    public static function validate(?string $token): bool
    {
        return isset($_SESSION['_csrf'])
            && is_string($token)
            && hash_equals($_SESSION['_csrf'], $token);
    }
}

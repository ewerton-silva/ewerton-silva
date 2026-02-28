<?php

declare(strict_types=1);

final class Security
{
    public static function applyHeaders(): void
    {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header("Content-Security-Policy: default-src 'self' https://cdn.jsdelivr.net https://code.jquery.com https://fonts.googleapis.com https://fonts.gstatic.com; img-src 'self' data:; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://code.jquery.com;");
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
    }

    public static function passwordHash(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    public static function passwordVerify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}

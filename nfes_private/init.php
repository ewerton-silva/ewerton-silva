<?php

declare(strict_types=1);

require_once __DIR__ . '/core/helpers.php';
require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/Security.php';
require_once __DIR__ . '/core/Session.php';
require_once __DIR__ . '/core/Csrf.php';

Session::start((string) app_config('session_name'));
Security::applyHeaders();

date_default_timezone_set('America/Sao_Paulo');

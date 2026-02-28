<?php

declare(strict_types=1);

require_once __DIR__ . '/../nfes_private/init.php';

if (is_logged_in()) {
    redirect('/app.php');
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['_csrf'] ?? null;

    if (!Csrf::validate(is_string($token) ? $token : null)) {
        $error = 'Token CSRF inválido. Atualize a página e tente novamente.';
    } else {
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $password = (string) ($_POST['password'] ?? '');

        if (!$email || $password === '') {
            $error = 'Informe e-mail e senha válidos.';
        } else {
            $pdo = Database::connection();
            $stmt = $pdo->prepare('SELECT id, email, senha_hash FROM users WHERE email = :email LIMIT 1');
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if (!$user || !Security::passwordVerify($password, (string) $user['senha_hash'])) {
                $error = 'Credenciais inválidas.';
            } else {
                $_SESSION['user_id'] = (int) $user['id'];
                $_SESSION['user_email'] = (string) $user['email'];
                Session::regenerate();
                redirect('/app.php');
            }
        }
    }
}

$csrfToken = Csrf::token((int) app_config('csrf_ttl'));
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NFES - Login</title>
  <link rel="manifest" href="/manifest.webmanifest">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h1 class="h4 mb-3">Entrar no NFES</h1>
            <?php if ($error): ?>
              <div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
            <form method="post" novalidate>
              <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
              <div class="mb-3">
                <label class="form-label" for="email">E-mail</label>
                <input class="form-control" id="email" name="email" type="email" required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="password">Senha</label>
                <input class="form-control" id="password" name="password" type="password" required>
              </div>
              <button class="btn btn-primary w-100" type="submit">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => navigator.serviceWorker.register('/service-worker.js'));
    }
  </script>
</body>
</html>

<?php

declare(strict_types=1);

require_once __DIR__ . '/../nfes_private/init.php';

if (!is_logged_in()) {
    redirect('/index.php');
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NFES - Painel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
  <div class="container">
    <span class="navbar-brand">NFES</span>
    <a class="btn btn-outline-danger btn-sm" href="/logout.php">Sair</a>
  </div>
</nav>
<main class="container py-4">
  <h1 class="h3">Painel inicial</h1>
  <p class="text-muted mb-4">MVP base carregado com autenticação, sessão segura e estrutura pronta para módulos.</p>

  <div class="row g-3">
    <div class="col-md-4">
      <div class="card"><div class="card-body"><h2 class="h6">Clientes</h2><p class="mb-0">Em breve</p></div></div>
    </div>
    <div class="col-md-4">
      <div class="card"><div class="card-body"><h2 class="h6">Orçamentos</h2><p class="mb-0">Em breve</p></div></div>
    </div>
    <div class="col-md-4">
      <div class="card"><div class="card-body"><h2 class="h6">Financeiro</h2><p class="mb-0">Em breve</p></div></div>
    </div>
  </div>
</main>
  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => navigator.serviceWorker.register('/service-worker.js'));
    }
  </script>
</body>
</html>

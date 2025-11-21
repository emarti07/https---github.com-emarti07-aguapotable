<?php
// Layout base reutilizable
// Uso: setear $title y $content antes de incluir este archivo
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= isset($title) ? htmlspecialchars($title).' - AguaPotable' : 'AguaPotable' ?></title>
  <link rel="icon" href="/assets/img/favicon.ico">
  <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
  <header class="site-header">
    <div class="container">
      <a href="/" style="display:flex;align-items:center;text-decoration:none;color:inherit;">
        <img src="/assets/img/logo.png" alt="Logo" class="logo">
        <span style="font-weight:600;margin-left:0.5rem;">AguaPotable</span>
      </a>
      <nav>
        <a href="/" style="margin-right:0.75rem;">Dashboard</a>
        <a href="/clients.php" style="margin-right:0.75rem;">Clientes</a>
        <a href="/invoices.php">Facturas</a>
      </nav>
    </div>
  </header>

  <main class="site-main container">
    <?php if (!empty($flash)): ?>
      <div class="flash" role="status" style="margin-bottom:1rem;padding:0.75rem;border-radius:6px;background:#fff8e1;border:1px solid #ffecb3;">
        <?= htmlspecialchars($flash) ?>
      </div>
    <?php endif; ?>

    <?= $content ?>
  </main>

  <footer class="site-footer" style="border-top:1px solid rgba(0,0,0,0.05);padding:1rem 0;margin-top:2rem;background:transparent;">
    <div class="container" style="display:flex;justify-content:space-between;align-items:center;">
      <small>© <?= date('Y') ?> Empresa de Agua Potable</small>
      <small style="color:#6b7280;">v0.1 • UI refactor branch</small>
    </div>
  </footer>

  <script src="/assets/js/app.js" defer></script>
</body>
</html>

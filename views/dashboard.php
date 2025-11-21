<?php
require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../models/ClientModel.php';
$title = 'Dashboard';
$pdo = getPDO();
$clientModel = new ClientModel($pdo);
$clientsCount = $clientModel->countAll();
ob_start();
?>
<div class="grid">
  <div class="card" style="margin-bottom:1rem;">
    <h3>Resumen</h3>
    <p>Clientes registrados: <strong><?= htmlspecialchars($clientsCount) ?></strong></p>
    <p><a class="btn btn-primary" href="/clients.php">Ver clientes</a></p>
  </div>
  <div class="card">
    <h3>Acciones rápidas</h3>
    <p><a class="btn btn-success" href="/invoices.php">Generar factura</a></p>
  </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__.'/layout.php';

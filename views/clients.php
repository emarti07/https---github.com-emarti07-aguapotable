<?php
require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../models/ClientModel.php';
$title = 'Clientes';
$pdo = getPDO();
$clientModel = new ClientModel($pdo);
$clients = $clientModel->getAll();
ob_start();
?>
<div class="card">
  <h2>Clientes</h2>
  <p><a class="btn btn-primary" href="/clients_create.php">Nuevo cliente</a></p>
  <table class="table" aria-describedby="Lista de clientes">
    <thead>
      <tr><th>Id</th><th>Nombre</th><th>Contacto</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    <?php foreach($clients as $c): ?>
      <tr>
        <td><?= htmlspecialchars($c['id']) ?></td>
        <td><?= htmlspecialchars($c['name']) ?></td>
        <td><?= htmlspecialchars($c['phone'] ?? '') ?></td>
        <td>
          <a href="/clients_edit.php?id=<?= urlencode($c['id']) ?>">Editar</a>
          | <a href="/clients_delete.php?id=<?= urlencode($c['id']) ?>" data-confirm="¿Eliminar cliente?">Eliminar</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php
$content = ob_get_clean();
include __DIR__.'/layout.php';

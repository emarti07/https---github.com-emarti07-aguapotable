<?php
require 'config.php';
$id_contribuyente = $_POST['id_contribuyente'];

$sql = "SELECT c.nombre, c.apellido, d.direccion, d.fecha_contrato, d.descripcion_domicilio, d.total_tomas, d.estatus, d.id_tipo_de_servicio, d.id_domicilio, s.descripcion, s.precio
        FROM domicilios d
        INNER JOIN contribuyentes c ON d.id_contribuyente = c.id_contribuyente
        LEFT JOIN tipos_de_servicio s ON d.id_tipo_de_servicio = s.id_tipo_de_servicio
        WHERE d.id_contribuyente = $id_contribuyente";

$resultado = $conn->query($sql);
?>

<style>
  .ficha-domicilio {
    border: 3px solid #306BA9;
    border-left: 10px solid #E16D2B;
    border-radius: 12px;
    padding: 20px 26px;
    margin-bottom: 24px;
    background-color: #fff;
    font-family: 'Bahnschrift', 'Poppins', sans-serif;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
  }

  .ficha-domicilio h3 {
    font-size: 1.5rem;
    color: #306BA9;
    font-weight: bold;
    margin-bottom: 14px;
  }

  .ficha-domicilio p {
    font-size: 1.05rem;
    color: #333;
    margin: 6px 0;
    line-height: 1.5;
  }

  .estatus-activo {
    color: #2F7E50;
    font-weight: bold;
  }

  .estatus-baja {
    color: #D10000;
    font-weight: bold;
  }

  .tomas-multiples {
    color: #D10000;
    font-weight: bold;
  }

  .grupo-botones {
    margin-top: 16px;
  }

  .btn-ficha {
    font-weight: 600;
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    margin-right: 10px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }

  .btn-editar {
    background-color: #306BA9;
    color: #fff;
  }

  .btn-editar:hover {
    background-color: #254F80;
  }

  .btn-estatus {
    background-color: #E16D2B;
    color: #fff;
  }

  .btn-estatus:hover {
    background-color: #C05820;
  }

  .tomas-totales {
    font-family: 'Bahnschrift', sans-serif;
    font-size: 1.2rem;
    font-weight: bold;
    color: #306BA9;
    margin-top: 32px;
    padding: 12px;
    border-top: 2px solid #E16D2B;
  }
</style>

<?php
$total_tomas = 0;
if ($resultado->num_rows > 0) {
  while ($row = $resultado->fetch_assoc()) {
    $estatusClass = $row['estatus'] === 'Activo' ? 'estatus-activo' : 'estatus-baja';
    $tomaClass = $row['total_tomas'] > 1 ? 'tomas-multiples' : '';
    echo '<div class="ficha-domicilio">';
    echo '<h3>🏠 Domicilio ID: ' . $row['id_domicilio'] . '</h3>';
    echo '<p><strong>📍 Dirección:</strong> ' . $row['direccion'] . '</p>';
    echo '<p><strong>🔧 Servicio:</strong> ' . $row['id_tipo_de_servicio'] . ' — ' . $row['descripcion'] . '</p>';
    echo '<p><strong>💰 Precio:</strong> $' . number_format($row['precio'] ?? 0, 2) . '</p>';
    echo '<p><strong>📆 Fecha de Contrato:</strong> ' . $row['fecha_contrato'] . '</p>';
    echo '<p><strong>🛡️ Estatus:</strong> <span class="' . $estatusClass . '">' . $row['estatus'] . '</span></p>';
    echo '<p><strong>🏘️ Descripción del domicilio:</strong> ' . (empty($row['descripcion_domicilio']) ? '__________' : $row['descripcion_domicilio']) . '</p>';
    echo '<p><strong>🔁 Total de Tomas:</strong> <span class="' . $tomaClass . '">' . $row['total_tomas'] . '</span></p>';
    echo '<div class="grupo-botones">';
    echo '<button class="btn-ficha btn-editar" data-toggle="modal" data-target="#editModal"
          data-id-domicilio="' . $row['id_domicilio'] . '" data-id-tipo-servicio="' . $row['id_tipo_de_servicio'] . '">Editar</button>';
    echo '<button class="btn-ficha btn-estatus" data-toggle="modal" data-target="#estatusModal"
          data-id-domicilio="' . $row['id_domicilio'] . '">Cambiar Estatus</button>';
    echo '</div>';
    echo '</div>';

    $total_tomas += $row['total_tomas'];
  }

  echo '<div class="tomas-totales">💧 Total de tomas registradas: ' . $total_tomas . '</div>';
} else {
  echo '<div style="font-family:\'Bahnschrift\', sans-serif; color:#E16D2B; font-weight:700; font-size:1rem; margin-top:20px;">
        ⚠️ No se encontraron tomas registradas para este contribuyente.
        </div>';
}
?>

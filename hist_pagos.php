<?php
require 'config.php';

$id_domicilio = $_GET['id_domicilio'];

$sql = "SELECT p.id_pago, p.mes_inicio, p.mes_fin, p.monto_del_pago, r.meses_pagados 
        FROM pagos p
        LEFT JOIN reportes r ON p.id_pago = r.id_pago
        WHERE p.id_domicilio = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_domicilio);
$stmt->execute();
$result = $stmt->get_result();

setlocale(LC_TIME, 'es-MX');

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID Pago</th>
                <th>Mes de Inicio</th>
                <th>Mes Fin</th>
                <th>Total de Meses Pagados</th>
                <th>Monto del Pago</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        $fecha_inicio = new DateTime($row['mes_inicio']);
        $fecha_fin = new DateTime($row['mes_fin']);
        $fecha_fin->modify('+1 day');
        $interval = $fecha_inicio->diff($fecha_fin);
        $total_meses_pagados = $row['meses_pagados'];

        $mes_inicio = strftime('%d-%B-%Y', strtotime($row['mes_inicio']));
        $mes_fin = strftime('%d-%B-%Y', strtotime($row['mes_fin']));

        echo "<tr>
                <td>{$row['id_pago']}</td>
                <td>{$mes_inicio}</td>
                <td>{$mes_fin}</td>
                <td>{$total_meses_pagados}</td>
                <td>{$row['monto_del_pago']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron pagos para este domicilio.";
}

$stmt->close();
?>

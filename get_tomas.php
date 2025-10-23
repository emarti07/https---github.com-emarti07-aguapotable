<?php
//get_tomas.php
require 'config.php';

$id_contribuyente = $_POST['id_contribuyente'];

$sql = "SELECT c.nombre, c.apellido, d.direccion, d.fecha_contrato, d.descripcion_domicilio, d.total_tomas,d.id_tipo_de_servicio, d.estatus, d.id_domicilio, s.descripcion, s.precio
FROM domicilios d
INNER JOIN contribuyentes c ON d.id_contribuyente = c.id_contribuyente
LEFT JOIN tipos_de_servicio s ON d.id_tipo_de_servicio = s.id_tipo_de_servicio
WHERE d.id_contribuyente = $id_contribuyente";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $output = '<tr>';
    $total_tomas = 0; // Variable para almacenar la suma

    while ($row = $resultado->fetch_assoc()) {
        $output .= '<td>' . $row['direccion'] . '</td>';
        $output .= '<td>' . $row['id_tipo_de_servicio'] . '</td>';
        $output .= '<td>' . $row['fecha_contrato'] . '</td>';
        $output .= '<td>' . $row['descripcion'] . '</td>';
        $output .= '<td>' . $row['precio'] . '</td>';

        if ($row['estatus'] == 'Baja') {
            $output .= '<td colspan="4" style="color: red; font-weight: bold;">El servicio está dado de baja</td>';
        } else {
            $output .= '<td style="color: ' . ($row['estatus'] == 'Activo' ? 'green' : 'red') . ';">' . $row['estatus'] . '</td>';
            $output .= '<td>' . (empty($row['descripcion_domicilio']) ? '___________' : $row['descripcion_domicilio']) . '</td>';
            $output .= '<td style="' . ($row['total_tomas'] > 1 ? 'color: red; font-weight: bold;' : '') . '">' . $row['total_tomas'] . '</td>';
            $output .= '<td><a href="cobrar_meses.php?id_domicilio=' . $row['id_domicilio'] . '">Cobrar Toma</a></td>';
        }

        $output .= '</tr>';

        $total_tomas += $row['total_tomas']; // Suma el valor de la columna
    }

    $output .= '<tr><td colspan="5" style="text-align: right;">Total de tomas: </td><td>' . $total_tomas . '</td></tr>'; // Muestra la suma

    echo $output;
} else {
    echo '<tr><td colspan="3">Sin tomas registradas</td></tr>';
}
?>

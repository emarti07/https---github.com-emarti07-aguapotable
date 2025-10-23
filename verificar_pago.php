<?php
require 'config.php';

$id_domicilio = $_POST['id_domicilio'];
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];

$sql = "SELECT COUNT(*) as count FROM pagos WHERE id_domicilio = ? AND mes_inicio = ? AND mes_fin = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $id_domicilio, $fechaInicio, $fechaFin);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    echo 'pago_existente';
} else {
    echo 'pago_no_existente';
}

$stmt->close();
?>

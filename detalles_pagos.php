<?php
// detalles_pagos.php

include 'config.php';

if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];

    $detallesQuery = "SELECT monto_del_pago, otra_columna FROM reportes WHERE DATE_FORMAT(fecha_de_emision, '%d de %M de %Y') = ?";
    
    // Puedes usar consultas preparadas para evitar la inyección de SQL
    $stmt = $conn->prepare($detallesQuery);
    $stmt->bind_param("s", $fecha);
    $stmt->execute();
    
    $detallesResult = $stmt->get_result();
    
    $labels = [];
    $data = [];
    
    while ($row = $detallesResult->fetch_assoc()) {
        // Puedes personalizar cómo deseas mostrar los detalles, por ejemplo, agregar más columnas
        $labels[] = $row['otra_columna'];
        $data[] = $row['monto_del_pago'];
    }
    
    $response = [
        'labels' => $labels,
        'data' => $data,
    ];

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Fecha no proporcionada']);
}
?>

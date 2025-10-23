<?php

// obtener_precio_del_mes.php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mes = $_POST['mes'];
    $idTipoServicio = $_POST['id_tipo_servicio'];

    // Realiza una consulta SQL para obtener el precio del mes según el tipo de servicio
    // Ajusta la consulta según tu estructura de datos
    $sql = "SELECT precio FROM tipos_de_servicio WHERE id_tipo_de_servicio = '$idTipoServicio'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $precioTipoServicio = $row['precio'];

        // Puedes agregar lógica adicional aquí si es necesario

        echo json_encode(['precio_del_mes' => $precioTipoServicio]);
    } else {
        // Puedes proporcionar un valor predeterminado o un mensaje de error
        echo json_encode(['error' => 'No se encontró el precio del mes para el tipo de servicio seleccionado.']);
    }
} else {
    // Maneja solicitudes no válidas
    echo json_encode(['error' => 'Solicitud no válida']);
}

?>

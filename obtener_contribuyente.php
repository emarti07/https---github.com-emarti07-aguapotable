<?php
// obtener_contribuyente.php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Realiza una consulta SQL para obtener los datos del contribuyente y su dirección por su ID.
    // Asegúrate de ajustar la consulta SQL según tu estructura de datos.
    $sql = "SELECT c.*, d.id_domicilio, d.direccion, d.total_tomas, t.precio, t.descripcion, d.fecha_contrato
    FROM contribuyentes c
    JOIN domicilios d ON c.id_contribuyente = d.id_contribuyente
    JOIN tipos_de_servicio t ON d.id_tipo_de_servicio = t.id_tipo_de_servicio
    WHERE c.id_contribuyente = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Include the id_domicilio values in the response
        $id_domicilios = obtenerIdDomicilios($conn, $row['id_contribuyente']);
        $row['id_domicilios'] = $id_domicilios;

        echo json_encode($row);
    }
}

// Function to obtain the id_domicilio values for a contribuyente
function obtenerIdDomicilios($conn, $id_contribuyente) {
    $id_domicilios = array();

    // Query to obtain id_domicilio values for the contribuyente
    $sql = "SELECT id_domicilio FROM domicilios WHERE id_contribuyente = $id_contribuyente";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id_domicilios[] = $row['id_domicilio'];
        }
    }

    return $id_domicilios;
}
?>


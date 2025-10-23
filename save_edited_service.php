<?php
// save_edited_service.php

// Include your database configuration file (config.php)
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $serviceId = $_POST['editServiceId'];
    $serviceName = $_POST['editServiceName'];
    $serviceDescription = $_POST['editServiceDescription'];
    $servicePrice = $_POST['editServicePrice'];

    // Prepare and execute the SQL query to update service details
    $sql = "UPDATE `tipos_de_servicio` SET 
            `nombre` = '$serviceName',
            `descripcion` = '$serviceDescription',
            `precio` = '$servicePrice'
            WHERE `id_tipo_de_servicio` = $serviceId";

    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'Invalid request';
}

// Close the database connection
$conn->close();
?>

<?php
// get_service_details.php

// Include your database configuration file (config.php)
require 'config.php';

if (isset($_GET['serviceId'])) {
    $serviceId = $_GET['serviceId'];

    // Prepare and execute the SQL query to get service details
    $sql = "SELECT * FROM `tipos_de_servicio` WHERE `id_tipo_de_servicio` = $serviceId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $serviceDetails = $result->fetch_assoc();
        echo json_encode($serviceDetails);
    } else {
        echo json_encode(['error' => 'Service not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

// Close the database connection
$conn->close();
?>

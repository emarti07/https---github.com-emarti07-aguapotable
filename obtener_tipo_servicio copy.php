<?php
// obtener_tipo_servicio.php

// Assuming you have a database connection established
$connection = mysqli_connect("localhost", "Dzonot", "1234", "aguadzonot");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$id_tipo_de_servicio = $_POST['id_tipo_de_servicio'];

// Fetch type of service from the database
$query = "SELECT * FROM tipos_de_servicio WHERE id_tipo_de_servicio = $id_tipo_de_servicio";
$result = mysqli_query($connection, $query);

if ($result) {
    $tipoServicio = mysqli_fetch_assoc($result);
    echo json_encode($tipoServicio);
} else {
    echo json_encode(['error' => 'Failed to fetch type of service']);
}
?>

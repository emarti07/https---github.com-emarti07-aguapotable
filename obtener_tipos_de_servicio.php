<?php

// obtener_tipo_de_servicio.php
require 'config.php';

$sql = "SELECT * FROM tipos_de_servicio";
$result = $conn->query($sql);

$tiposDeServicio = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tiposDeServicio[] = $row;
    }
}

echo json_encode($tiposDeServicio);

?>

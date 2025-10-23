<?php
// Conectar a la base de datos (reemplaza con tus propios detalles)
require 'config.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el id_contribuyente de la solicitud POST
$idContribuyente = isset($_POST['id_contribuyente']) ? $_POST['id_contribuyente'] : 0;

// Consulta SQL para obtener la información del contribuyente
$sql = "SELECT * FROM contribuyentes WHERE id_contribuyente = $idContribuyente";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtener los datos del contribuyente
    $contribuyente = $result->fetch_assoc();

    // Crear un array asociativo con la información del contribuyente
    $data = array(
        'id_contribuyente' => $contribuyente['id_contribuyente'],
        'nombre' => $contribuyente['nombre'],
        'apellido' => $contribuyente['apellido'],
        // Agrega más campos según sea necesario
    );

    // Devolver los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Si no se encontraron resultados
    echo "No se encontró información para el contribuyente con ID $idContribuyente";
}

// Cerrar la conexión
$conn->close();
?>

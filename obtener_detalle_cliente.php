<?php
// Conectar a la base de datos (reemplaza con tus propios detalles)
$servername = "tu_servidor";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

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

    // Crear el contenido HTML con la información del contribuyente
    $html = "<p><strong>ID Contribuyente:</strong> {$contribuyente['id_contribuyente']}</p>";
    $html .= "<p><strong>Nombre:</strong> {$contribuyente['nombre']}</p>";
    $html .= "<p><strong>Apellido:</strong> {$contribuyente['apellido']}</p>";
    // Agrega más campos según sea necesario

    // Devolver el contenido HTML como respuesta
    echo $html;
} else {
    // Si no se encontraron resultados
    echo "No se encontró información para el contribuyente con ID $idContribuyente";
}

// Cerrar la conexión
$conn->close();
?>

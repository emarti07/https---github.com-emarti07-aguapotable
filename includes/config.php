<?php
// Configuración de conexión a base de datos MySQL
$host = "localhost";
$usuario = "root";
$contrasena = ""; // ← Cambia esto si tu MySQL tiene contraseña
$base_datos = "aguadzonot";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Validar conexión
if ($conn->connect_error) {
    die("❌ Error al conectar con la base de datos: " . $conn->connect_error);
}

// Configurar charset para caracteres especiales
$conn->set_charset("utf8");
?>

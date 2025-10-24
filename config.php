<?php
// config.php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "aguadzonot";

/* Creando una nueva conexión a la base de datos */
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

/* Comprobando si hay un error de conexión */
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// ✅ Conexión exitosa. Ya podés realizar consultas SQL con $conn.
?>

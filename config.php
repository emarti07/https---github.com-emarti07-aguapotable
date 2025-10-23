<?php
// config.php

/* Creando una nueva conexión a la base de datos */
$conn = new mysqli("localhost", "root", "", "aguadzonot");

/* Comprobando si hay un error de conexión */
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// ✅ Conexión exitosa. Ya podés realizar consultas SQL con $conn.
?>

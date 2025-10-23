<?php
include "config.php";

// Datos del nuevo usuario
$usuario = "admin";
$clave_original = "123";
$clave_cifrada = password_hash($clave_original, PASSWORD_DEFAULT);
$nombre = "Administrador";
$apellido = "Principal";
$rol = "administrador";

// Verifica si ya existe
$verificar = $conn->query("SELECT * FROM usuario WHERE usuario='$usuario'");
if ($verificar->num_rows > 0) {
  echo "<h3 style='color: orange;'>⚠️ El usuario 'admin' ya existe en la base de datos.</h3>";
} else {
  $insertar = $conn->query("INSERT INTO usuario (nombre, apellido, usuario, clave, rol)
    VALUES ('$nombre', '$apellido', '$usuario', '$clave_cifrada', '$rol')");

  if ($insertar) {
    echo "<h3 style='color: green;'>✅ Usuario 'admin' creado exitosamente. Contraseña: 123</h3>";
  } else {
    echo "<h3 style='color: red;'>❌ Error al crear el usuario: " . $conn->error . "</h3>";
  }
}
?>

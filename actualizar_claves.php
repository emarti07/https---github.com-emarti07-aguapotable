<?php
include "config.php";

// Nuevo hash para rodo123
$rodo123_hash = password_hash("1234", PASSWORD_DEFAULT);
$conn->query("UPDATE usuario SET clave='$rodo123_hash' WHERE usuario='rodo123'");

// Nuevo hash para admin
$admin_hash = password_hash("123", PASSWORD_DEFAULT);
$conn->query("UPDATE usuario SET clave='$admin_hash' WHERE usuario='admin'");

echo "<h3 style='color:green;'>✅ Contraseñas actualizadas con éxito</h3>";
?>

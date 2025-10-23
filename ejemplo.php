<?php
// Conectar a la base de datos (ajusta las credenciales según tu configuración)
include('config.php');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el idioma a español
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp');
// ejemplo.php

// Verificar si el parámetro 'id' está presente en la URL
if(isset($_GET['id'])) {
    // Obtener el valor de 'id' desde la URL
    $id_contribuyente = $_GET['id'];

    // Ahora puedes usar $id_contribuyente en tu lógica de código
    echo "ID Contribuyente: " . $id_contribuyente;
} else {
    // Si no se proporciona el parámetro 'id', puedes manejarlo según tus necesidades
    echo "No se proporcionó el ID Contribuyente en la URL.";
}


// Obtener información del cliente y sus servicios (ajusta la consulta según tu estructura)
$sql_cliente = "SELECT * FROM contribuyentes WHERE id_contribuyente = $id_contribuyente";
$result_cliente = $conn->query($sql_cliente);

if ($result_cliente->num_rows > 0) {
    $cliente = $result_cliente->fetch_assoc();
    echo "<h2>Información del Cliente</h2>";
    echo "<p>Nombre: " . $cliente["nombre"] . "</p>";
    echo "<p>Dirección: " . $cliente["direccion"] . "</p>";
    echo "<p>Tomas: " . $cliente["tomas_por_domicilio"] . "</p>";
    // Muestra más detalles según sea necesario
} else {
    echo "Cliente no encontrado.";
}

// Mostrar los meses pagados
echo "<h2>Meses Pagados</h2>";
$sql_meses_pagados = "SELECT DISTINCT MONTH(mes_de_pago) as mes, YEAR(mes_de_pago) as ano FROM pagos WHERE id_contribuyente = $id_contribuyente";
$result_meses_pagados = $conn->query($sql_meses_pagados);

if ($result_meses_pagados->num_rows > 0) {
    echo "<ul>";
    while ($row_mes = $result_meses_pagados->fetch_assoc()) {
        $mes_numero = $row_mes["mes"];
        $ano_pago = $row_mes["ano"];
        $nombre_mes = strftime('%B', mktime(0, 0, 0, $mes_numero, 1, 0));
        echo "<li>Mes: $nombre_mes, Año: $ano_pago</li>";
    }
    echo "</ul>";
} else {
    echo "El cliente no ha realizado pagos.";
}

// Permitir al cliente seleccionar el mes y el año para el pago
echo "<h2>Seleccionar Mes(es) y Año del Pago</h2>";
echo "<form action='procesar_pago.php' method='post'>";
echo "<label>Mes(es):</label>";
echo "<input type='text' name='meses' required>";
echo "<label>Año:</label>";
echo "<input type='text' name='ano' value='" . date("Y") . "' readonly>"; // Obtener el año actual automáticamente
echo "<input type='hidden' name='cliente_id' value='$id_contribuyente'>";
echo "<br><br><input type='submit' value='Realizar Pago'>";
echo "</form>";

$conn->close();
?>

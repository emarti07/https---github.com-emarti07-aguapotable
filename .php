<?php
// procesar_formulario.php

// ... (configuración de la conexión a la base de datos)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idContribuyente = $_POST['id_contribuyente'];

    // Realiza la consulta SQL para obtener el nombre y apellido del contribuyente
    $sql = "SELECT nombre, apellido FROM contribuyentes WHERE id_contribuyente = :idContribuyente";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idContribuyente', $idContribuyente, PDO::PARAM_INT);
    $stmt->execute();

    // Obtén los resultados
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devuelve los resultados como JSON
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}
?>

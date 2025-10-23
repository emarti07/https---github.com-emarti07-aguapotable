<?php
// agregar_domicilio.php
include 'config.php';

// Validación del envío del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitizar entradas
    $id_contribuyente   = filter_input(INPUT_POST, 'id_contribuyente_modal', FILTER_VALIDATE_INT);
    $direccion          = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
    $descripcion        = filter_input(INPUT_POST, 'descripcion_domicilio', FILTER_SANITIZE_STRING);
    $tipo_servicio      = filter_input(INPUT_POST, 'tipoServicio', FILTER_VALIDATE_INT);
    $total_tomas        = filter_input(INPUT_POST, 'total_tomas', FILTER_VALIDATE_INT);
    $estatus            = filter_input(INPUT_POST, 'estatus', FILTER_SANITIZE_STRING);
    $fecha_original     = filter_input(INPUT_POST, 'fecha_contrato', FILTER_SANITIZE_STRING);
    $fecha_contrato     = date('Y-m-01', strtotime($fecha_original)); // Primer día del mes

    $response = [];

    // Validar campos obligatorios
    if ($id_contribuyente && $direccion && $tipo_servicio && $estatus) {
        // Construir la consulta SQL
        $sql = "INSERT INTO domicilios (
                    id_contribuyente, id_tipo_de_servicio, direccion,
                    total_tomas, descripcion_domicilio, estatus, fecha_contrato
                )
                VALUES (
                    '$id_contribuyente', '$tipo_servicio', '$direccion',
                    '$total_tomas', '$descripcion', '$estatus', '$fecha_contrato'
                )";

        if ($conn->query($sql)) {
            $response['message'] = "✅ Registro del domicilio insertado correctamente.";
            $response['type'] = "success";
        } else {
            $response['message'] = "🛑 Error al insertar: " . $conn->error;
            $response['type'] = "error";
        }
    } else {
        $response['message'] = "⚠️ Datos incompletos o inválidos. Verificá el formulario.";
        $response['type'] = "warning";
    }

    // Enviar respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

<?php
// procesar_contrato.php
include 'config.php';

// Verificamos si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos y sanitizamos los datos del contribuyente
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
    $tipo_persona = filter_input(INPUT_POST, 'tipo_persona', FILTER_SANITIZE_STRING);

    // Recibimos y sanitizamos los datos del domicilio
    $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
    $total_tomas = filter_input(INPUT_POST, 'total_tomas', FILTER_VALIDATE_INT);
    $descripcion_domicilio = filter_input(INPUT_POST, 'descripcion_domicilio', FILTER_SANITIZE_STRING);
    $estatus = filter_input(INPUT_POST, 'estatus', FILTER_SANITIZE_STRING);

    // Recibimos el tipo de servicio desde el formulario
    $tipo_servicio = filter_input(INPUT_POST, 'tipoServicio', FILTER_VALIDATE_INT);

    // Recibimos la fecha de contrato en formato "YYYY-MM"
    $fecha_contrato_input = filter_input(INPUT_POST, 'fecha_contrato', FILTER_SANITIZE_STRING);

    // Convertir la fecha al formato "YYYY-MM-DD" con el día 01
    $fecha_contrato = date('Y-m-01', strtotime($fecha_contrato_input));

    // Añade la validación y procesamiento adicional según tus necesidades

    // Verificamos si el contribuyente ya existe en la tabla "contribuyentes"
    $sql_verificar_contribuyente = "SELECT id_contribuyente FROM contribuyentes WHERE nombre = '$nombre' AND apellido = '$apellido'";

    $result_verificar_contribuyente = $conn->query($sql_verificar_contribuyente);

    $response = array();

    if ($result_verificar_contribuyente->num_rows > 0) {
        // El contribuyente ya existe
        $response['message'] = "El contribuyente ya existe en la base de datos.";
        $response['type'] = 'error';
    } else {
        // El contribuyente no existe, procedemos con la inserción en ambas tablas
        $sql_contribuyente = "INSERT INTO contribuyentes (nombre, apellido, tipo_de_persona) VALUES ('$nombre', '$apellido', '$tipo_persona')";
        if ($conn->query($sql_contribuyente) === TRUE) {

          
            $response['message_contribuyente'] = "Registro del contribuyente insertado correctamente.";
            $response['type_contribuyente'] = 'success';
        } else {
            $response['message_contribuyente'] = "Error al insertar el registro del contribuyente: " . $conn->error;
            $response['type_contribuyente'] = 'error';
        }

        // Obtener el ID del contribuyente recién insertado
        $id_contribuyente = $conn->insert_id;

        // Insertar datos en la tabla "domicilios"
        $sql_domicilio = "INSERT INTO domicilios (id_contribuyente, id_tipo_de_servicio, direccion, total_tomas, descripcion_domicilio, estatus, fecha_contrato) 
                          VALUES ('$id_contribuyente', '$tipo_servicio', '$direccion', '$total_tomas', '$descripcion_domicilio', '$estatus', '$fecha_contrato')";

        if ($conn->query($sql_domicilio) === TRUE) {
            $response['message_domicilio'] = "Registro del domicilio insertado correctamente.";
            $response['type_domicilio'] = 'success';
        } else {
            $response['message_domicilio'] = "Error al insertar el registro del domicilio: " . $conn->error;
            $response['type_domicilio'] = 'error';
        }
    }

    // Enviar la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // No cerramos la conexión a la base de datos aquí, ya que se utiliza desde config.php
}
?>

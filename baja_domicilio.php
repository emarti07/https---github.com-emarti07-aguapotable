<?php
require 'config.php';

if (isset($_POST['idDomicilioEstatus']) && !empty($_POST['idDomicilioEstatus'])) {
    $idDomicilioEstatus = $_POST['idDomicilioEstatus'];
    $estatus = mysqli_real_escape_string($conn, $_POST['estatus']);

    // Obtener el mes actual
    $mesActual = date('Y-m');

    // Inicializar variable para almacenar meses debidos
    $mesesDebidos = 0;

    // Verificar si ya se ha realizado algún pago
    $sqlPagos = "SELECT * FROM pagos WHERE id_domicilio = $idDomicilioEstatus ORDER BY mes_fin DESC LIMIT 1";
    $resultPagos = $conn->query($sqlPagos);

    if ($resultPagos->num_rows > 0) {
        // Ha realizado al menos un pago
        $ultimoPago = $resultPagos->fetch_assoc();
        $mesFinMasReciente = $ultimoPago['mes_fin'];

        // Verificar meses debidos
        if ($mesFinMasReciente < $mesActual) {
            // Calcular meses debidos
            $mesesDebidos = calcularMesesDebidos($mesFinMasReciente, $mesActual);
        }
    } else {
        // No ha realizado ningún pago, obtener fecha de contrato
        $sqlContrato = "SELECT fecha_contrato FROM domicilios WHERE id_domicilio = $idDomicilioEstatus";
        $resultContrato = $conn->query($sqlContrato);

        if ($resultContrato->num_rows > 0) {
            $fechaContrato = $resultContrato->fetch_assoc()['fecha_contrato'];

            // Calcular meses debidos
            $mesesDebidos = calcularMesesDebidos($fechaContrato, $mesActual);
        }
    }

    // Verificar si se puede realizar la actualización
    if ($mesesDebidos == 0) {
        $sqlUpdate = "UPDATE domicilios SET estatus = '$estatus' WHERE id_domicilio = $idDomicilioEstatus";
        $resultUpdate = $conn->query($sqlUpdate);

        if ($resultUpdate) {
            // Respuesta en formato JSON
            $response = [
                'success' => true,
                'message' => 'Actualización exitosa'
            ];
        } else {
            // Respuesta en formato JSON
            $response = [
                'success' => false,
                'message' => 'Error SQL: ' . $conn->error
            ];
        }
    } else {
        // Respuesta en formato JSON
        $response = [
            'success' => false,
            'message' => 'No se puede realizar la actualización. Hay meses debidos: ' . $mesesDebidos
        ];
    }
} else {
    // Respuesta en formato JSON
    $response = [
        'success' => false,
        'message' => 'Error: ID de domicilio no proporcionado'
    ];
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
exit;

function calcularMesesDebidos($fechaInicio, $fechaFin)
{
    $fechaInicio = new DateTime($fechaInicio);
    $fechaFin = new DateTime($fechaFin);
    $fechaActual = new DateTime(); // Fecha actual

    // Verificar si la fecha de inicio es posterior a la fecha actual
    if ($fechaInicio > $fechaActual) {
        return 0; // No hay meses debidos si la fecha de inicio es futura
    }

    $interval = $fechaInicio->diff($fechaFin);

    return $interval->format('%y') * 12 + $interval->format('%m');
}
?>

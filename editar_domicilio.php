<?php
require 'config.php';
//este es el bueno
// editar_domicilio.php

// Validar que se haya recibido el ID del domicilio
if (isset($_POST['idDomicilio']) && !empty($_POST['idDomicilio'])) {
    $idDomicilio = $_POST['idDomicilio'];
    $tipoServicio = mysqli_real_escape_string($conn, $_POST['tipoServicio']);

    // Obtener el mes actual
    $mesActual = date('Y-m');

    // Inicializar variable para almacenar meses debidos
    $mesesDebidos = 0;

    // Verificar si ya se ha realizado algún pago
    $sqlPagos = "SELECT * FROM pagos WHERE id_domicilio = $idDomicilio ORDER BY mes_fin DESC LIMIT 1";
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
        $sqlContrato = "SELECT fecha_contrato FROM domicilios WHERE id_domicilio = $idDomicilio";
        $resultContrato = $conn->query($sqlContrato);
        
        if ($resultContrato->num_rows > 0) {
            $fechaContrato = $resultContrato->fetch_assoc()['fecha_contrato'];
            
            // Calcular meses debidos
            $mesesDebidos = calcularMesesDebidos($fechaContrato, $mesActual);
        }
    }

    // Realizar la actualización en la base de datos
    if ($mesesDebidos == 0) {
        $sqlUpdate = "UPDATE domicilios SET id_tipo_de_servicio = '$tipoServicio' WHERE id_domicilio = $idDomicilio";
        $resultUpdate = $conn->query($sqlUpdate);

        if ($resultUpdate) {
            echo 'Actualización exitosa';
        } else {
            // Imprimir mensaje de error SQL
            echo 'Error SQL: ' . $conn->error;
        }
    } else {
        echo 'No se puede realizar el cambio de servicio. Hay meses debidos: ' . $mesesDebidos;
    }
} else {
    echo 'Error: ID de domicilio no proporcionado';
}

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

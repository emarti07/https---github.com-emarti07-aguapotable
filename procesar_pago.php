
<?php
//procesar_pago.php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $id_domicilio = $_POST['id_domicilio'];
    $mes_inicio = $_POST['mes_inicio'] . '-01'; // Agrega el primer día del mes
    $mes_fin = $_POST['mes_fin'] . '-01'; // Agrega el primer día del mes
    $totalFinal = $_POST['totalFinal'];

    // Obtener el id_contribuyente según el id_domicilio
    $sqlContribuyente = "SELECT id_contribuyente, id_tipo_de_servicio FROM domicilios WHERE id_domicilio = $id_domicilio";
    $resultadoContribuyente = $conn->query($sqlContribuyente);

    if ($resultadoContribuyente->num_rows > 0) {
        $rowContribuyente = $resultadoContribuyente->fetch_assoc();
        $id_contribuyente = $rowContribuyente['id_contribuyente'];
        $id_tipo_de_servicio = $rowContribuyente['id_tipo_de_servicio'];

        // Realiza la inserción de datos en la tabla de pagos
        $sqlInsert = "INSERT INTO pagos (id_domicilio, id_contribuyente, id_tipo_de_servicio, mes_inicio, mes_fin, monto_del_pago) 
                      VALUES ($id_domicilio, $id_contribuyente, $id_tipo_de_servicio, '$mes_inicio', '$mes_fin', $totalFinal)";

        $resultadoInsert = $conn->query($sqlInsert);

        if ($resultadoInsert) {
            // Obtiene el último ID de la inserción en la tabla pagos
            $id_pago = $conn->insert_id;

            // Calcular la cantidad de meses entre mes_inicio y mes_fin
            $sqlCalculoMeses = "SELECT DATEDIFF('$mes_fin', '$mes_inicio') / 30 AS meses_pagados";
            $resultadoCalculoMeses = $conn->query($sqlCalculoMeses);

            if ($resultadoCalculoMeses) {
                $rowCalculoMeses = $resultadoCalculoMeses->fetch_assoc();
                $meses_pagados = $rowCalculoMeses['meses_pagados'];

                // Insertar datos en la tabla reportes
                $sqlInsertReporte = "INSERT INTO reportes (id_pago, fecha_de_emision, monto_del_pago, id_domicilio, meses_pagados) 
                                    VALUES ($id_pago, NOW(), $totalFinal, $id_domicilio, $meses_pagados)";

                $resultadoInsertReporte = $conn->query($sqlInsertReporte);

                if ($resultadoInsertReporte) {
                    echo '<h1>Pago procesado y registrado correctamente en las tablas pagos y reportes.</h1>';
                    header("Location: impPdf.php");
        exit();

                  
                } else {
                    echo 'Error al registrar el reporte: ' . $conn->error;
                }
            } else {
                echo 'Error al calcular la cantidad de meses pagados: ' . $conn->error;
            }
        } else {
            echo 'Error al procesar y registrar el pago: ' . $conn->error;
        }
    } else {
        echo 'No se encontró información para el id_domicilio proporcionado.';
    }
} else {
    // Redirecciona a alguna página en caso de intentar acceder directamente a este script sin enviar datos por POST
    header("Location: tu_pagina_de_error.php");
    exit();
}
?>
 








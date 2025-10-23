

<?php
session_start();
if (empty($_SESSION["id"])){
  header("location: login.php");
}
// generar_pdf.php
require 'config.php';
require 'fpdf/fpdf.php';
require 'helpers/NumeroALetras.php';

define('MONEDA', '$');
define('MONEDA_LETRA', 'pesos');
define('MONEDA_DECIMAL', 'centavos');

// Recuperar el id_pago después de procesar el pago
$id_pago_generado_query = "SELECT id_pago FROM pagos ORDER BY id_pago DESC LIMIT 1";
$result_id_pago_generado = $conn->query($id_pago_generado_query);

if ($result_id_pago_generado->num_rows > 0) {
    $row_id_pago_generado = $result_id_pago_generado->fetch_assoc();
    $id_pago_generado = $row_id_pago_generado['id_pago'];

    // Consultar los datos del pago recién insertado
    $sqlConsultaPago = "SELECT * FROM pagos WHERE id_pago = $id_pago_generado";
    $resultadoConsultaPago = $conn->query($sqlConsultaPago);

    if ($resultadoConsultaPago->num_rows > 0) {
        $rowPago = $resultadoConsultaPago->fetch_assoc();

        // Obtener el nombre y apellido del contribuyente
        $id_contribuyente = $rowPago['id_contribuyente'];
        $sqlContribuyente = "SELECT nombre, apellido FROM contribuyentes WHERE id_contribuyente = $id_contribuyente";
        $resultadoContribuyente = $conn->query($sqlContribuyente);

        if ($resultadoContribuyente->num_rows > 0) {
            $rowContribuyente = $resultadoContribuyente->fetch_assoc();
            $nombreContribuyente = $rowContribuyente['nombre'];
            $apellidoContribuyente = $rowContribuyente['apellido'];

            // Obtener datos del domicilio
            $id_domicilio = $rowPago['id_domicilio'];
            $sqlDomicilio = "SELECT direccion, total_tomas, descripcion_domicilio FROM domicilios WHERE id_domicilio = $id_domicilio";
            $resultadoDomicilio = $conn->query($sqlDomicilio);

            if ($resultadoDomicilio->num_rows > 0) {
                $rowDomicilio = $resultadoDomicilio->fetch_assoc();
                $direccion = $rowDomicilio['direccion'];
                $total_tomas = $rowDomicilio['total_tomas'];
                $descripcion_domicilio = $rowDomicilio['descripcion_domicilio'];

                // Obtener datos del reporte
                $sqlReporte = "SELECT fecha_de_emision, meses_pagados FROM reportes WHERE id_pago = $id_pago_generado";
                $resultadoReporte = $conn->query($sqlReporte);

                if ($resultadoReporte->num_rows > 0) {
                    $rowReporte = $resultadoReporte->fetch_assoc();
                    $fecha_de_emision = $rowReporte['fecha_de_emision'];
                    $meses_pagados = $rowReporte['meses_pagados'];

                    $montoEnLetras = NumeroALetras::convertir($rowPago['monto_del_pago'], MONEDA_LETRA, MONEDA_DECIMAL);
                   // formatear fecha
// formatear fecha
function formatearFecha(string $fecha): string
{
    // Define un array asociativo con el nombre de los meses
    $meses = [
        '01' => 'enero',
        '02' => 'febrero',
        '03' => 'marzo',
        '04' => 'abril',
        '05' => 'mayo',
        '06' => 'junio',
        '07' => 'julio',
        '08' => 'agosto',
        '09' => 'septiembre',
        '10' => 'octubre',
        '11' => 'noviembre',
        '12' => 'diciembre',
    ];

    // Separa la fecha en sus componentes
    $fecha_array = explode('-', $fecha);

    // Obtiene el nombre del mes
    $nombre_mes = $meses[$fecha_array[1]];

    // Devuelve la fecha con el formato deseado
    return $fecha_array[2] . '/' . $nombre_mes . '/' . $fecha_array[0];
}

                    // Crear instancia de FPDF
                    $pdf = new FPDF('P', 'mm', array(58, 200));

                    $pdf->AddPage();
                    $pdf->SetLeftMargin(1);

// Establecer el margen derecho
$pdf->SetRightMargin(1);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Image('images/logon.png', 6, 2, 45);

$pdf->Ln(10);

                    // Agregar contenido al PDF
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Ln(); // Aumenta el espacio entre líneas
                    $pdf->MultiCell(55, 8, '----COMISARIA----', 0, 'C');

                    $pdf->MultiCell(55, 8, 'DZONOT CARRETERO 2021-2024', 0, 'C');
                    
                    $pdf->SetFont('Arial', 'B', 8);

                    $pdf->MultiCell(55, 8, 'AGUA POTABLE', 0, 'C');
                    $pdf->Ln(5); // Aumenta el espacio entre líneas

                    $pdf->Cell(40, 8, 'Folio: ' . $rowPago['id_pago']);
                    $pdf->SetFont('Arial', '', 8);

                    $pdf->Ln(); // Aumenta el espacio entre líneas
                    $pdf->Cell(40, 4, mb_convert_encoding('Fecha de Emisión:  ' . $fecha_de_emision, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
                    $pdf->Cell(40, 4, '--------------------------------------------------------', 0, 1, 'L');

                    // Agregar datos del contribuyente al PDF
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Ln(1); // Aumenta el espacio entre líneas

                    $pdf->Cell(58, 4, mb_convert_encoding('Nombre: ' . $nombreContribuyente . ' ' . $apellidoContribuyente, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

                    $pdf->Ln(); // Aumenta el espacio entre líneas

                    $pdf->Cell(58, 4, mb_convert_encoding('ID Contribuyente: ' . $rowPago['id_contribuyente'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
                    
                    $pdf->Ln(); // Nueva línea

                    // Agregar datos del domicilio al PDF
              // Ajusta el ancho de la celda y la posición Y para reducir el espacio entre líneas
$pdf->Cell(58, 4, mb_convert_encoding('Dirección:  ' . $direccion, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->Ln(); // Aumenta el espacio entre líneas

$pdf->Cell(58, 4, 'Total Tomas: ' . $total_tomas, 0, 1, 'L');
$pdf->Ln(); // Aumenta el espacio entre líneas

// Ajusta las dimensiones y el formato según tus necesidades
$pdf->MultiCell(70, 4, mb_convert_encoding('Domicilio: ' . $descripcion_domicilio, 'ISO-8859-1', 'UTF-8'), 0, 'L');

                    $pdf->Ln(); // Aumenta el espacio entre líneas
                    $pdf->Cell(70, 2, '--------------------------------------------------------', 0, 1, 'L');
                    $pdf->SetFont('Arial', '', 8);

                    // Agregar datos del reporte al PDF

                    $pdf->Ln(1); // Aumenta el espacio entre líneas
                    $pdf->Cell(40, 10, 'Monto: ' . MONEDA . $rowPago['monto_del_pago']);
                    $pdf->Ln(); // Aumenta el espacio entre líneas
                    $pdf->Cell(70, 4, mb_convert_encoding('Meses Pagados:  ' . $meses_pagados, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
                    $pdf->SetFont('Arial', 'B', 7); // Establecer la fuente en negrita

                    $pdf->Cell(40, 10, 'Son ' . MONEDA . ' (' . $montoEnLetras . ')');
                    $pdf->Ln(); // Nueva línea
                    // Combinar las fechas en una sola cadena
                    $fecha_inicio_formateada = formatearFecha($rowPago['mes_inicio']);
                    $fecha_fin_formateada = formatearFecha($rowPago['mes_fin']);
                    $fechas_combined = 'De: ' . $fecha_inicio_formateada . ' a: ' . $fecha_fin_formateada;
                    
                    // Imprimir las fechas en la misma línea
                    $pdf->SetFont('Arial', 'B', 8); // Establecer la fuente en negrita
$pdf->Cell(80, 10, $fechas_combined);
                    $pdf->Ln(); // Nueva línea
                    $pdf->SetFont('Arial', 'B', 7); // Establecer la fuente en negrita

                    $pdf->MultiCell(55, 5, 'Te atendio ' . $_SESSION["nombre"] . " " . $_SESSION["apellido"], 0, 'C',);

                    $pdf->Ln(); // Nueva línea

                    $pdf->MultiCell(55, 8, 'GRACIAS POR SU PAGO!!!', 0, 'C');

                    // Guardar o mostrar el PDF según tus necesidades
// Guardar o mostrar el PDF según tus necesidades
$pdf->Output('D', $nombreContribuyente . '_' . $apellidoContribuyente . '_Pago' . $rowPago['id_pago'] . '.pdf');
                } else {
                    echo 'Error al obtener datos del reporte.';
                }
            } else {
                echo 'Error al obtener datos del domicilio.';
            }
        } else {
            echo 'Error al obtener el nombre y apellido del contribuyente.';
        }
    } else {
        echo 'Error al consultar los datos del pago recién insertado.';
    }
} else {
    echo 'Error al recuperar el ID del pago.';
}
?>

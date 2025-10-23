<?php
require 'fpdf/fpdf.php';
require 'config.php';

class MyPDF extends FPDF {
    function Circle($x, $y, $r, $style = '') {
        $this->Ellipse($x, $y, $r, $r, $style);
    }
}

if (isset($_GET['id']) && isset($_GET['year'])) {
    $id_domicilio = $_GET['id'];
    $selected_year = $_GET['year'];

    // Retrieve necessary data from the database
    $contributor_info_sql = "SELECT c.`nombre`, c.`apellido`, d.`fecha_contrato` FROM `contribuyentes` c 
                        INNER JOIN `domicilios` d ON c.`id_contribuyente` = d.`id_contribuyente`
                        WHERE d.`id_domicilio` = $id_domicilio";

    $contributor_info_result = $conn->query($contributor_info_sql);

    if ($contributor_info_result->num_rows > 0) {
        $contributor_info = $contributor_info_result->fetch_assoc();
        $contributor_name = $contributor_info['nombre'] . ' ' . $contributor_info['apellido'];
        $fecha_contrato = $contributor_info['fecha_contrato'];

        // Retrieve the paid and pending months
        $pagos_sql = "SELECT `mes_inicio`, `mes_fin` FROM `pagos` WHERE `id_domicilio` = $id_domicilio";
        $pagos_result = $conn->query($pagos_sql);

        $meses_pagados = [];
        $meses_pendientes = [];

        if ($pagos_result->num_rows > 0) {
            while ($pago = $pagos_result->fetch_assoc()) {
                $mes_inicio_pago = new DateTime($pago["mes_inicio"]);
                $mes_fin_pago = new DateTime($pago["mes_fin"]);

                // Check if the payment intersects with the selected year
                if ($mes_inicio_pago->format('Y') <= $selected_year && $mes_fin_pago->format('Y') >= $selected_year) {
                    // Get the paid months in the payment date range for the selected year
                    $mes_actual = clone $mes_inicio_pago;
                    while ($mes_actual <= $mes_fin_pago) {
                        if ($mes_actual->format('Y') == $selected_year) {
                            $meses_pagados[] = $mes_actual->format('n');
                        }
                        $mes_actual->add(new DateInterval('P1M'));
                    }
                }
            }
        }

        // Calculate the due months based on the contract start month
        $contract_start_month = (new DateTime($fecha_contrato))->format('n');

        // If the contract start month is December, set the due months to include only December
        $due_months = ($contract_start_month == 12) ? [12] : range($contract_start_month + 1, 12);

        // Remove the months that have already been paid
        $due_months = array_diff($due_months, $meses_pagados);

        // If the selected year is beyond the contract start year, add all months for that year
        if ($selected_year > (new DateTime($fecha_contrato))->format('Y')) {
            $due_months = range(1, 12);
            // Remove the months that have already been paid
            $due_months = array_diff($due_months, $meses_pagados);
        }

        // Create PDF
        $pdf = new MyPDF();
        $pdf->AddPage();
        $pdf->Image('images/logon.png', 65, 2, 80);

        $pdf->Ln(25);
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, 'DZONOT CARRETERO 2021-2024', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Servicio de Agua potable', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        // Convert text to UTF-8 using iconv
        $report_title = 'Historial de ' . $contributor_name . ' - Del Año ' . $selected_year;
        $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', $report_title));

        // Add content to the PDF
        $pdf->Ln(8);

        // Add a table with months paid and pending
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(80, 10, 'Meses pagados', 1, 0, 'C');
        $pdf->Cell(80, 10, 'Meses debidos', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(80, 10, implode(', ', obtenerNombresMeses($meses_pagados)), 1, 0);
        $pdf->Cell(80, 10, implode(', ', obtenerNombresMeses($due_months)), 1, 1);

        // Add notification message
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 12);

        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date("d/m/Y");
        $pdf->Cell(0, 10, 'Fecha: ' . $fecha_actual, 0, 1, 'R');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 12);
        $notification_message = "Estimado(a) $contributor_name" . " con fecha de contrato $fecha_contrato\n\n";
        $notification_message .= "Le informamos que su servicio de agua potable para el año $selected_year ";
        $total_pending_months = count($due_months);
        $notification_message .= "presenta meses pagados " . count($meses_pagados) . " y pendientes " . $total_pending_months . " meses. Por favor, pase a realizar el pago lo más pronto posible.\n\n";
        $notification_message .= "En caso de no regularizar su situación, su servicio podría ser dado de baja y estaría sujeto a cortes en el suministro. Los días de atención para realizar el pago correspondiente son los viernes, sábados y domingos. Cualquier duda o aclaración puede acudir a la comisaría en horarios establecidos.\n\n";
        $notification_message .= "Agradecemos su pronta atención a este aviso.";

        $pdf->MultiCell(0, 8, iconv('UTF-8', 'ISO-8859-1', $notification_message));
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Ln(20);
        $pdf->Cell(0, 10, '________________________', 0, 1, 'C'); // Line for signature

        // Add names
        $pdf->Ln(2);
        $pdf->Cell(0, 10, '' . $contributor_name, 0, 1, 'C'); // Center-aligned for the contributor's signature
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Comisario Municipal', 0, 1, 'C'); // Left-aligned for the comisario's signature
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(0, 10, '________________________', 0, 1, 'C'); // Line for signature
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(0, 10, 'NAZARIO CHAN TUZ', 0, 1, 'C'); // Left-aligned for the comisario's signature
        // Output PDF to the browser
        $pdf->Output();
    } else {
        echo 'Contributor not found.';
    }
} else {
    echo 'Invalid parameters.';
}

// Close the connection
$conn->close();

// Function to obtain the name of the month based on its number
function obtenerNombreMes($numeroMes) {
    $nombreMeses = [
        'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sept', 'Oct', 'Nov', 'Dic'
    ];

    return $nombreMeses[$numeroMes - 1];
}

// Function to obtain an array of month names based on their numbers
function obtenerNombresMeses($numerosMeses) {
    $nombreMeses = [
        'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sept', 'Oct', 'Nov', 'Dic'
    ];

    return array_map(function ($numeroMes) use ($nombreMeses) {
        return $nombreMeses[$numeroMes - 1];
    }, $numerosMeses);
}
?>

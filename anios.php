<?php

require 'config.php';

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Loop to insert payments for 82 random contributors from 1 to 700 with active status
for ($i = 1; $i <= 700; $i++) {
    $contributorId = rand(1, 700);

    // Check if the contributor with the generated ID exists and has an active status
    $checkQuery = "SELECT id_contribuyente, tomas_por_domicilio FROM contribuyentes WHERE id_contribuyente = $contributorId AND estatus = 'activo'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $contributorData = $checkResult->fetch_assoc();
        $tomasPorDomicilio = $contributorData['tomas_por_domicilio'];

        // Check if the contributor has paid for the 11 months of 2023
        $paidMonthsQuery = "SELECT COUNT(DISTINCT MONTH(fecha_de_pago)) AS paid_months
                            FROM pagos
                            WHERE id_contribuyente = $contributorId AND YEAR(fecha_de_pago) = 2023";
        $paidMonthsResult = $conn->query($paidMonthsQuery);

        if ($paidMonthsResult->num_rows > 0) {
            $paidMonthsData = $paidMonthsResult->fetch_assoc();
            $paidMonths = $paidMonthsData['paid_months'];

            if ($paidMonths == 11) {
                // Calculate the payment amount based on the number of tomas
                $montoDelPago = $tomasPorDomicilio * 30.00;

                $sql = "INSERT INTO pagos (id_contribuyente, id_tipo_de_servicio, fecha_de_pago, monto_del_pago)
                        VALUES ($contributorId, 1, '2023-12-01', $montoDelPago)";

                if ($conn->query($sql) === TRUE) {
                    echo "Payment for contributor $contributorId added successfully. Amount: $montoDelPago<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Contributor $contributorId has not paid for all 11 months of 2023<br>";
            }
        }
    } else {
        echo "Contributor $contributorId either does not exist or has an inactive status<br>";
    }
}

// Close the connection
$conn->close();

?>

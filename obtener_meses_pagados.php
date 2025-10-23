<?php
// obtener_meses_pagados.php

// Assuming you have a database connection
// Include your database connection file or create a connection here

// Check if the 'id_contribuyente' is set in the POST request
if (isset($_POST['id_contribuyente'])) {
    $id_contribuyente = $_POST['id_contribuyente'];

    // Set the locale to Spanish
    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp');

    // Assuming you have a database table named 'pagos' with columns 'id_contribuyente' and 'mes_de_pago'
    // Replace 'your_database_host', 'your_database_username', 'your_database_password', and 'your_database_name' with your actual database credentials
    $connection = mysqli_connect('localhost', 'Dzonot', '1234', 'aguadzonot');

    if (!$connection) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    // Prepare and execute a query to get the months paid for the given contributor
    $query = "SELECT DISTINCT mes_de_pago FROM pagos WHERE id_contribuyente = '$id_contribuyente'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Fetch the results into an array
        $monthsPaid = array();
        while ($row = mysqli_fetch_assoc($result)) {
            // Format the date to display month and year (e.g., "enero 2023")
            $date = new DateTime($row['mes_de_pago']);
            $formattedDate = strftime('%B %Y', $date->getTimestamp());

            $monthsPaid[] = utf8_encode($formattedDate); // Ensure proper encoding
        }

        // Sort the months in chronological order
        setlocale(LC_TIME, 'es_ES.UTF-8');
        usort($monthsPaid, function ($a, $b) {
            return strtotime($a) - strtotime($b);
        });

        // Output the sorted months as JSON
        if (empty($monthsPaid)) {
            // No months paid, return a message
            echo json_encode(array('message' => 'No hay meses pagados.'));
        } else {
            // Use implode to join array elements with a newline
            echo implode(",", $monthsPaid);
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    echo "Invalid request";
}
?>

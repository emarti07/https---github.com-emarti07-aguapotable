<meta charset="UTF-8">

<?php
//excel.php
require '../config.php';

// Assuming your config.php file contains the database connection code.

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
?>

<table class="table table-striped table-dark" id="table_id">
    <thead>
        <tr>
                    <th class="sort asc" style="color: white; background-color: #212121;">id_dom</th>
                    <!--<th class="sort asc" style="color: white; background-color: #212121;">Id_cont</th>-->
                    <th class="sort asc" style="color: white; background-color: #212121;">Nombres</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Ene</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Feb</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Mar</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Abr</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">May</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Jun</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Jul</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Ago</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Sept</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Oct</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Nov</th>
                    <th class="sort asc" style="color: black; background-color: #CCCCCC;">Dic</th>

        </tr>
    </thead>
    <tbody>
    <?php
// Incluir el archivo de configuración
$selected_year = $_POST["selected_year"];

// Definir el año y la cantidad de meses por defecto
$selected_year = date("Y");
$selected_month_count = 12; // Mostrar todos los meses por defecto

// Verificar si se ha enviado el formulario y se han proporcionado el año y la cantidad de meses
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selected_year"]) && isset($_POST["selected_month_count"])) {
  $selected_year = $_POST["selected_year"];
  $selected_month_count = $_POST["selected_month_count"];
}

// Consulta SQL para obtener la lista de servicios con información de contribuyentes
$sql = "SELECT d.`id_domicilio`, d.`id_contribuyente`, c.`nombre`, c.`apellido` FROM `domicilios` d
        LEFT JOIN `contribuyentes` c ON d.`id_contribuyente` = c.`id_contribuyente`";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result->num_rows > 0) {
  // Mostrar el formulario para introducir manualmente el año y la cantidad de meses

  
 

  echo '<tbody>';
  while ($row = $result->fetch_assoc()) {
    $id_domicilio = $row["id_domicilio"];
    $id_contribuyente = $row["id_contribuyente"];
    $nombre = $row["nombre"];
    $apellido = $row["apellido"];

    // Consulta SQL para obtener las fechas de todos los pagos para el id_domicilio
    $pagos_sql = "SELECT `mes_inicio`, `mes_fin` FROM `pagos` WHERE `id_domicilio` = $id_domicilio";
    $pagos_result = $conn->query($pagos_sql);

    $meses_pagados = [];

    // Verificar si hay pagos para el id_domicilio
    if ($pagos_result->num_rows > 0) {
      while ($pago = $pagos_result->fetch_assoc()) {
        $mes_inicio_pago = new DateTime($pago["mes_inicio"]);
        $mes_fin_pago = new DateTime($pago["mes_fin"]);

        // Verificar si el rango de fechas del pago intersecta con el año seleccionado
        if ($mes_inicio_pago->format('Y') <= $selected_year && $mes_fin_pago->format('Y') >= $selected_year) {
          // Obtener los meses pagados en el rango de fechas del pago para el año seleccionado
          $mes_actual = clone $mes_inicio_pago;
          while ($mes_actual <= $mes_fin_pago) {
            if ($mes_actual->format('Y') == $selected_year && count($meses_pagados) < $selected_month_count) {
              $meses_pagados[] = $mes_actual->format('Y-m');
            }
            $mes_actual->add(new DateInterval('P1M'));
          }
        }
      }
    }

    echo '<tr class="searchable-row">';
    echo '<td>' . $id_domicilio . '</td>';
    //echo '<td>' . $id_contribuyente . '</td>';
    echo '<td>' . $nombre . ' ' . $apellido . '</td>';

    // Imprimir las columnas con palomita para los meses pagados
    for ($mes = 1; $mes <= $selected_month_count; $mes++) {
      $mes_actual = sprintf('%04d-%02d', $selected_year, $mes);
      echo '<td>' . (in_array($mes_actual, $meses_pagados) ? '✅' : '') . '</td>';

    }

    echo '</tr>';
  }
  echo '</tbody>';
} else {
  echo "<tr><td colspan='14'>No se encontraron resultados</td></tr>";
}

// Cerrar la conexión
$conn->close();
?>
    </tbody>
</table>


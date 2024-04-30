<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<?php
$conexion = new mysqli("localhost", "root", "soyyo", "isco3");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$consulta_recuadado = "
    SELECT 
        u.nombre,
        u.apellido,
        u.num_casa,
        p.monto,
        p.concepto_pago,
        p.pagado
    FROM 
        usuarios u
    LEFT JOIN 
        pagos p ON u.id_usuario = p.id_usuario
";

$resultados_recuadado = $conexion->query($consulta_recuadado);
?>

<div class='container mt-4'>
    <h2 class='text-center mb-4'>Control</h2>

    <h4>Personas que han pagado:</h4>
    <div class='table-responsive'>
        <table class='table table-bordered table-striped'>
            <thead class='thead-dark'>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Número de Casa</th>
                    <th>Monto</th>
                    <th>Concepto de Pago</th>
                </tr>
            </thead>
            <tbody>

            <?php
            while ($fila = $resultados_recuadado->fetch_assoc()) {
                if ($fila["pagado"]) {
                    echo "<tr>";
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["apellido"] . "</td>";
                    echo "<td>" . $fila["num_casa"] . "</td>";
                    echo "<td>$" . $fila["monto"] . "</td>";
                    echo "<td>" . $fila["concepto_pago"] . "</td>";
                    echo "</tr>";
                }
            }
            ?>

            </tbody>
        </table>
    </div>

    <h4>Personas que no han pagado:</h4>
    <div class='table-responsive'>
        <table class='table table-bordered table-striped'>
            <thead class='thead-dark'>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Número de Casa</th>
                    <th>monto</th>
                    <th>concepto</th>

                </tr>
            </thead>
            <tbody>

            <?php
            $resultados_recuadado->data_seek(0); 

            while ($fila = $resultados_recuadado->fetch_assoc()) {
                if (!$fila["pagado"]) {
                    echo "<tr>";
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["apellido"] . "</td>";
                    echo "<td>" . $fila["num_casa"] . "</td>";
                    echo "<td>" . $fila["monto"] . "</td>";
                    echo "<td>" . $fila["concepto_pago"] . "</td>";

                    echo "</tr>";
                }
            }
            ?>

            </tbody>
        </table>
    </div>

    <!-- Total recaudado -->
    <?php
    $consulta_total_recaudado = "
        SELECT 
            SUM(p.monto) AS total_recaudado
        FROM 
            pagos p
        WHERE 
            p.pagado = 1
    ";

    $resultado_total_recaudado = $conexion->query($consulta_total_recaudado);
    $total_recaudado = $resultado_total_recaudado->fetch_assoc()["total_recaudado"];
    ?>

    <h4 class="mt-4">Total Recaudado: $<?php echo number_format($total_recaudado, 2); ?></h4>

    <div class='text-center mt-4'>
        <a href='panel_admin.php' class='btn btn-primary btn-lg'>Regresar</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

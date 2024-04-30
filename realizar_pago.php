<?php
session_start();

$conexion = new mysqli("localhost", "root", "soyyo", "isco3");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$id_pago = isset($_GET["id_pago"]) ? $_GET["id_pago"] : null;

echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<title>Realizar Pago</title>';
echo '</head>';
echo '<body class="bg-light">';

if ($id_pago !== null) {

    $consulta_pago = "SELECT * FROM pagos WHERE id = $id_pago";

    $resultado_pago = $conexion->query($consulta_pago);

    if ($resultado_pago->num_rows == 1) {
        $pago = $resultado_pago->fetch_assoc();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["metodo_pago"])) {
            $metodo_pago = $_POST["metodo_pago"];

            $fecha_pago = date('Y-m-d H:i:s');

            date_default_timezone_set('America/Cancun');
            $fecha_pago_chetumal = date('Y-m-d H:i:s', strtotime($fecha_pago . ' - 1 hour')); // Resta 1 hora para ajustar a Chetumal

            $actualizar_estado = "UPDATE pagos SET pagado = 1, fecha_pago = '$fecha_pago_chetumal' WHERE id = $id_pago";
            $conexion->query($actualizar_estado);

            echo '<div class="container mt-5">';
            echo '<h2 class="text-success">¡Gracias por su pago!</h2>';
            echo '<p>ID Pago: ' . $pago["id"] . '</p>';
            echo '<p>Monto: $' . $pago["monto"] . '</p>';
            echo '<p>Método de Pago: ' . $metodo_pago . '</p>';
            echo '<p>Fecha y Hora de Pago: ' . $fecha_pago_chetumal . '</p>';
            echo '<p>Estado: Pagado</p>';
            echo '<br><a class="btn btn-primary" href="panel_admin.php">Regresar</a>';
            echo '</div>';
        } else {

            echo '<div class="container mt-5">';
            echo '<h2 class="mb-4">Seleccionar Método de Pago</h2>';
            echo '<form method="post" action="realizar_pago.php?id_pago=' . $id_pago . '">';
            echo '<div class="form-check mb-3">';
            echo '<input class="form-check-input" type="radio" name="metodo_pago" value="Efectivo" id="efectivo" required>';
            echo '<label class="form-check-label" for="efectivo">Efectivo</label>';
            echo '</div>';
            echo '<div class="form-check mb-3">';
            echo '<input class="form-check-input" type="radio" name="metodo_pago" value="Tarjeta" id="tarjeta" required>';
            echo '<label class="form-check-label" for="tarjeta">Tarjeta</label>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-success">Pagar</button>';
            echo '</form>';
            echo '</div>';
        }
    } else {
        echo '<div class="container mt-5">';
        echo '<p class="text-danger">Error: Pago no encontrado.</p>';
        echo '</div>';
    }
} else {
    echo '<div class="container mt-5">';
    echo '<p class="text-danger">Error: ID de pago no proporcionado.</p>';
    echo '</div>';
}

$conexion->close();

echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
echo '</body>';
echo '</html>';
?>

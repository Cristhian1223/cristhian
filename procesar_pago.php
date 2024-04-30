<?php
session_start();

// Conectar a la base de datos (actualiza con tus propios datos de conexión)
$conexion = new mysqli("localhost", "root", "soyyo", "isco3");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Obtener el ID del pago desde la URL
$id_pago = $_GET["id_pago"];

// Verificar si el pago existe
$consulta_pago = "SELECT * FROM pagos WHERE id_pago = $id_pago";
$resultado_pago = $conexion->query($consulta_pago);

if ($resultado_pago->num_rows == 1) {
    $pago = $resultado_pago->fetch_assoc();

    // Verificar si el pago ya está pagado
    if (!$pago["pagado"]) {
        // Procesar el método de pago (tarjeta o efectivo)
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["metodo_pago"])) {
            $metodo_pago = $_POST["metodo_pago"];

            // Actualizar el estado del pago a 'Pagado'
            $consulta_actualizar_pago = "UPDATE pagos SET pagado = 1, metodo_pago = '$metodo_pago' WHERE id_pago = $id_pago";
            $conexion->query($consulta_actualizar_pago);

            // Redirigir a la página de detalles del pago
            header("location: ver_pago.php?id_pago=$id_pago");
            exit();
        }
    }
} else {
    echo "<p>Error: Pago no encontrado.</p>";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

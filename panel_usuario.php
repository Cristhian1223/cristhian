<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pagos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy2nEfRXg5Kb8/J90p+FV0e04JZ6hJS1M" crossorigin="anonymous">
</head>
<body class="bg-dark text-light">

<?php
if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "usuario") {
    $conexion = new mysqli("localhost", "root", "soyyo", "isco3");

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    if (isset($_SESSION["id_usuario"])) {
        $usuario_id = $_SESSION["id_usuario"];

        $consulta_usuario = "SELECT * FROM usuarios WHERE id_usuario = $usuario_id";
        $resultado_usuario = $conexion->query($consulta_usuario);

        if ($resultado_usuario) {
            $info_usuario = $resultado_usuario->fetch_assoc();

            echo "<div class='container mt-3'>";
            echo "<h3 class='text-light'>Hola, " . $info_usuario["nombre"] . "! Esta es la página de usuario.</h3>";
            echo "<a href='loginn2.php' class='btn btn-primary mb-3'>cerrar sesion</a>";

            echo "<h2>Historial de Pagos</h2>";
            echo "<div class='table-responsive'>";
            echo "<table class='table table-dark'>";
            echo "<thead>";
            echo "<tr><th>Mes</th><th>Año</th><th>Monto</th><th>Concepto de Pago</th><th>Estado</th><th>Fecha de Pago</th><th>Acciones</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            $consulta_pagos = "SELECT * FROM pagos WHERE id_usuario = $usuario_id";
            $resultados = $conexion->query($consulta_pagos);

            while ($fila = $resultados->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["mes"] . "</td>";
                echo "<td>" . $fila["año"] . "</td>";
                echo "<td>$" . $fila["monto"] . "</td>";
                echo "<td>" . $fila["concepto_pago"] . "</td>";
                echo "<td>" . ($fila["pagado"] ? 'Pagado' : 'Pendiente') . "</td>";
                echo "<td>" . ($fila["pagado"] ? $fila["fecha_pago"] : 'N/A') . "</td>";
                echo "<td>";

                if (!$fila["pagado"]) {
                    echo "<a href='realizar_pago.php?id_pago=" . $fila["id"] . "' class='btn btn-success'>Pagar</a>";
                }

                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>"; 
            echo "</div>"; 

            $resultado_usuario->free();
        } else {
            echo "<p class='text-danger'>Error al obtener la información del usuario.</p>";
        }
    } else {
        echo "<p class='text-danger'>Error: No se encontró la clave 'id_usuario' en la sesión.</p>";
    }

    $conexion->close();
} else {
    echo "<p class='text-danger'>Acceso no autorizado: Debes iniciar sesión.</p>";
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGp"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoTZh5R6S" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy2nEfRXg5Kb8/J90p+FV0e04JZ6hJS1M" crossorigin="anonymous"></script>
</body>
</html>

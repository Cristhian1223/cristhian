<?php
session_start();

$conexion = new mysqli("localhost", "root", "soyyo", "isco3");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$id_usuario = isset($_GET["id_usuario"]) ? $_GET["id_usuario"] : null;

if (!is_numeric($id_usuario)) {
    die("ID de usuario no válido");
}

// Obtener el nombre y apellido del usuario
$consulta_usuario = "SELECT nombre, apellido FROM usuarios WHERE id_usuario = $id_usuario";
$resultado_usuario = $conexion->query($consulta_usuario);

if ($resultado_usuario) {
    $datos_usuario = $resultado_usuario->fetch_assoc();
    $nombre_usuario = $datos_usuario["nombre"];
    $apellido_usuario = $datos_usuario["apellido"];
} else {
    die("Error al obtener los datos del usuario: " . $conexion->error);
}

$consulta_pagos = "SELECT * FROM pagos WHERE id_usuario = $id_usuario";
$resultados_pagos = $conexion->query($consulta_pagos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos de <?php echo $nombre_usuario . ' ' . $apellido_usuario; ?> (ID: <?php echo $id_usuario; ?>)</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa; 
        }

        table {
            width: 80%;
            margin: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        a {
            display: block;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class='container'>
    <h2 class='text-center mb-4'>Pagos de <?php echo $nombre_usuario . ' ' . $apellido_usuario; ?> (ID: <?php echo $id_usuario; ?>)</h2>
    <table class='table table-bordered table-striped'>
        <thead class='thead-dark'>
            <tr>
                <th>ID Pago</th>
                <th>Mes</th>
                <th>Año</th>
                <th>Monto</th>
                <th>Concepto de Pago</th>
                <th>Estado</th>
                <th>Fecha de Pago</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $total_monto = 0;  // Variable para almacenar el total de montos

        while ($pago = $resultados_pagos->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $pago["id_usuario"] . "</td>";
            echo "<td>" . $pago["mes"] . "</td>";
            echo "<td>" . $pago["año"] . "</td>";
            echo "<td>" . $pago["monto"] . "</td>";
            echo "<td>" . $pago["concepto_pago"] . "</td>";
            echo "<td>" . ($pago["pagado"] ? 'Pagado' : 'Pendiente') . "</td>";
            echo "<td>" . ($pago["pagado"] ? $pago["fecha_pago"] : 'N/A') . "</td>";
            echo "</tr>";

            // Sumar el monto al total
            $total_monto += $pago["monto"];
        }

        $conexion->close();
        ?>

        </tbody>
        <tfoot>
            <tr>
                <th colspan="3"></th>
                <th>Total:</th>
                <th><?php echo $total_monto; ?></th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    </table>

    <a href='listar_usuarios.php' class='btn btn-primary btn-lg'>Regresar </a>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

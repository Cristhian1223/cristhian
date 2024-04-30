<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<?php
$conexion = new mysqli("localhost", "root", "soyyo", "isco3");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$consulta_usuarios = "SELECT * FROM usuarios";
$resultados_usuarios = $conexion->query($consulta_usuarios);
?>

<div class='container mt-4'>
    <h2 class='text-center mb-4'>Listado de Usuarios</h2>
    <div class='table-responsive'>
        <table class='table table-bordered table-striped'>
            <thead class='thead-dark'>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Número de Casa</th>
                    <th>ROL</th>
                    <th>Tipo de Propietario</th>
                    <th>Acciones</th>
                    <th>Eliminar Usuario</th>
                </tr>
            </thead>
            <tbody>

            <?php
            while ($usuario = $resultados_usuarios->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $usuario["id_usuario"] . "</td>";
                echo "<td>" . $usuario["nombre"] . " " . $usuario["apellido"] . "</td>";
                echo "<td>" . $usuario["num_casa"] . "</td>";
                echo "<td>" . $usuario["rol"] . "</td>";
                echo "<td>" . $usuario["tipo_propietario"] . "</td>";

                echo "<td class='text-center'>";
                echo "<a href='ver_pagos.php?id_usuario=" . $usuario["id_usuario"] . "' class='btn btn-info'>Ver Pagos</a>";
                echo "</td>";
                echo "<td class='text-center'>";
                echo "<a href='eliminar_usuarios.php?id_usuario=" . $usuario["id_usuario"] . "' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de eliminar este usuario?\")'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }

            $conexion->close();
            ?>

            </tbody>
        </table>
    </div>

    <div class='text-center mt-4'>
        <a href='panel_admin.php' class='btn btn-primary btn-lg'>Regresar</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <!-- Enlaza los archivos de Bootstrap desde un CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h2>Eliminar Usuario</h2>
        </div>
        <div class="card-body">
            <?php
            session_start();

            // Conectar a la base de datos (actualiza con tus propios datos de conexión)
            $conexion = new mysqli("localhost", "root", "soyyo", "isco3");

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            // Obtener el ID del usuario a eliminar
            $id_usuario = $_GET['id_usuario'];

            // Realizar la eliminación
            $eliminar_usuario = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";
            $resultado = $conexion->query($eliminar_usuario);

            // Verificar si la eliminación fue exitosa
            if ($resultado) {
                echo "<p class='bg-success text-white p-2'>Usuario eliminado correctamente.</p>";
            } else {
                echo "<p class='text-danger'>Error al eliminar el usuario: " . $conexion->error . "</p>";
            }

            // Cerrar la conexión a la base de datos
            $conexion->close();
            ?>

            <!-- Botón para regresar -->
            <a href="listar_usuarios.php" class="btn btn-primary mt-3">Regresar a la Lista de Usuarios</a>
        </div>
    </div>
</div>

<!-- Incluye el script de Bootstrap JS desde un CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

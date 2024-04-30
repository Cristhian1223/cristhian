<?php
session_start();

if (isset($_SESSION["rol"])) {
    if ($_SESSION["rol"] === "administrador") {
        $conexion = new mysqli("localhost", "root", "soyyo", "isco3");

        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"]; 
            $rol = $_POST["rol"];
            $num_casa = $_POST["num_casa"];
            $apellido = $_POST["apellido"];
            $tipo_propietario = $_POST["tipo_propietario"];

            $consulta_insertar_usuario = "INSERT INTO usuarios (nombre, usuario, contraseña, rol, num_casa, apellido, tipo_propietario) VALUES ('$nombre', '$usuario', '$contrasena', '$rol','$num_casa', '$apellido', '$tipo_propietario')";
            
            if ($conexion->query($consulta_insertar_usuario) === TRUE) {
                echo "Usuario agregado correctamente.";
            } else {
                echo "Error al agregar el usuario: " . $conexion->error;
            }
        }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa; 
        }

        form {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
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
    <h2 class='text-center mb-4'>Agregar Nuevo Usuario</h2>
    <form method="post" action="agregar_usuario.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required>

        <label for="num_casa">Numero de casa:</label>
        <input type="text" name="num_casa" required>

        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>

        <label for="tipo_propietario">Tipo de propietario:</label>
        <select name="tipo_propietario">
            <option value="Dueño">Dueño</option>
            <option value="Arrendatario">Arrendatario</option>
        </select>

        <label for="rol">Rol:</label>
        <select name="rol">
            <option value="usuario">Usuario</option>
            <option value="administrador">Administrador</option>
        </select>

        <input type="submit" class="btn btn-primary" value="Agregar Usuario">
    </form>

    <a href="javascript:history.back()" class="btn btn-secondary">Regresar</a>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

<?php
    } else {
        echo "Acceso no autorizado: No eres un administrador.";
    }
} else {
    echo "Acceso no autorizado: Debes iniciar sesión.";
}
?>

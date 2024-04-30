<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "soyyo";
    $database = "isco3";

    $conn = new mysqli($servername, $username, $password, $database);
    session_start();
    var_dump($_SESSION);
    
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id_usuario, nombre, rol FROM usuarios WHERE usuario = '$username' AND contraseña = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["id_usuario"] = $row["id_usuario"];
        $_SESSION["nombre"] = $row["nombre"];
        $_SESSION["rol"] = $row["rol"];

        if ($row["rol"] == "administrador") {
            header("location: panel_admin.php");
        } else {
            header("location: panel_usuario.php"); // Redirige a panel_usuario.php para usuarios normales
        }
    } else {
        echo "Credenciales incorrectas";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Inicio de Sesión</title>
    <!-- Agrega las referencias a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Iniciar Sesión</h2>
        <form method="post" action="loginn2.php">
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>

    <!-- Agrega la referencia al archivo JS de Bootstrap al final del cuerpo -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
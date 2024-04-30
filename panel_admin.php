<?php
session_start();

// Verificar si el usuario está autenticado como administrador
if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "administrador") {
    header("Location: loginn2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Administrador</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            margin: 0;
            background-color: plum; 
            background-image: url('https://us.123rf.com/450wm/rondale/rondale1602/rondale160200022/51742837-vector-panel-de-fondo-blanco-textura-volumed-sin-fisuras-para-el-dise%C3%B1o-gr%C3%A1fico-o-sitio-web.jpg '); /* Ruta a tu imagen de fondo */
            background-size: cover;
        }

        .custom-text {
            color: black !important; 
        }

        .custom-image {
            max-width: 400px; 
            height: auto; 
        }

        .card {
            background-color:black; 
            padding: 20px;
            margin-top: 100px; /* Margen superior para centrar el contenido verticalmente */
            border-radius: 10px; /* Esquinas redondeadas */
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center h-100">
    <div class="card">
        <div class="text-center mb-4">
            <img src="https://i.pinimg.com/originals/40/b9/a4/40b9a4799fe73b83f1b1d5bcd7cf47ff.jpg" alt="Logo" class="custom-image mx-auto"> 
        </div>

        <div class="d-flex flex-column align-items-center">
            <a href="agregar_pago.php" class="btn btn-primary mb-2 btn-block">Agregar pagos</a>
            <a href="listar_usuarios.php" class="btn btn-primary mb-2 btn-block">Historial de usuarios/eliminar usuarios</a>
            <a href="loginn2.php" class="btn btn-info mb-2 btn-block">Cerrar sesión</a>
            <a href="agregar_usuario.php" class="btn btn-success mb-2 btn-block">Agregar Nuevo Usuario</a>
            <a href="recuadado.php" class="btn btn-success mb-2 btn-block">Control de pagos</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

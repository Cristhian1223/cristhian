<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://pollofeliz.com/home/wp-content/uploads/2023/09/pollo-felizRGB-01.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: black;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }
    </style>
    <title>Bienvenido a la Pollería</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Bienvenido a la Polleria EL no kfc</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Selecciona tu perfil</h5>
                        
                        <form method="post">
                            <div class="form-group">
                                <label for="tipo_usuario">Perfil:</label>
                                <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                                    <option value="cliente">Cliente</option>
                                    <option value="administrador">Administrador</option>
                                    <option value="empleado">Empleado</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" name="continuar">Entrar</button>
                        </form>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["continuar"])) {
                            $tipoUsuario = $_POST["tipo_usuario"];

                            switch ($tipoUsuario) {
                                case "cliente":
                                    header("Location: cliente.php"); // Redirige al usuario a cliente.php
                                    break;
                                case "administrador":
                                    header("Location: admin.php"); // Redirige al usuario a admin.php
                                    break;
                                case "empleado":
                                    header("Location: empleado.php"); // Redirige al usuario a empleado.php
                                    break;
                                default:
                                    break;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

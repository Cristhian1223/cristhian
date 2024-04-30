<?php
session_start();

$conexion = new mysqli("localhost", "root", "soyyo", "isco3");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$id_usuario_actual = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : null;

if (!is_numeric($id_usuario_actual) || $id_usuario_actual <= 0) {
    die("ID de usuario no válido");
}

if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "administrador") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mes = $_POST["mes"];
        $ano = $_POST["ano"];
        $monto = $_POST["monto"];
        $concepto_pago = $_POST["concepto_pago"];
        $pagado = isset($_POST["pagado"]) ? 1 : 0;

        $consulta_usuarios = "SELECT id_usuario FROM usuarios WHERE rol IN ('usuario', 'administrador')";
        $resultados_usuarios = $conexion->query($consulta_usuarios);
        

        if ($resultados_usuarios) {
            while ($fila_usuario = $resultados_usuarios->fetch_assoc()) {
                $id_usuario = $fila_usuario["id_usuario"];

                $consulta_insertar_pago = "INSERT INTO pagos (id_usuario, mes, año, monto, concepto_pago, pagado) VALUES ($id_usuario, '$mes', '$ano', $monto, '$concepto_pago', $pagado)";

                if (!$conexion->query($consulta_insertar_pago)) {
                    echo "Error al agregar el pago para el usuario con ID $id_usuario: " . $conexion->error;
                }
            }

            echo "Pagos agregados correctamente para todos los usuarios.";
        } else {
            echo "Error al obtener la lista de usuarios: " . $conexion->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pago</title>
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

        .container {
            display: flex;
            justify-content: space-between;
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

        table {
            width: 50%;
            border-collapse: collapse;
            margin-left: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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
    <div>
        <h2 class='text-center mb-4'>Agregar Pago para los residentes</h2>
        <form method="post" action="agregar_pago.php?id_usuario=<?php echo $id_usuario_actual; ?>">
            <label for="mes">Mes:</label>
            <input type="text" name="mes" value="<?php echo date('m'); ?>" required>

            <label for="ano">Año:</label>
            <input type="text" name="ano" value="<?php echo date('Y'); ?>" required>

            <label for="monto">Monto:</label>
            <input type="text" name="monto" required>

            <label for="concepto_pago">Concepto de Pago:</label>
            <input type="text" name="concepto_pago" required>

            <input type="submit" class="btn btn-primary" value="Agregar Pago">
        </form>
    </div>

    <div>
        <h2 class='text-center mb-4'>Usuarios y Pagos</h2>
        <?php
            $consulta_info_usuarios = "SELECT u.id_usuario, u.nombre, u.apellido, p.mes, p.año, p.monto, p.concepto_pago
                                        FROM usuarios u
                                        LEFT JOIN pagos p ON u.id_usuario = p.id_usuario
                                        ORDER BY u.id_usuario, p.fecha_pago DESC";
            $resultados_info_usuarios = $conexion->query($consulta_info_usuarios);

            if ($resultados_info_usuarios) {
                echo "<table>";
                echo "<tr><th>ID Usuario</th><th>Nombre</th><th>Apellido</th><th>Mes</th><th>Año</th><th>Monto</th><th>Concepto de Pago</th></tr>";

                while ($fila_info_usuario = $resultados_info_usuarios->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$fila_info_usuario['id_usuario']}</td>";
                    echo "<td>{$fila_info_usuario['nombre']}</td>";
                    echo "<td>{$fila_info_usuario['apellido']}</td>";
                    echo "<td>{$fila_info_usuario['mes']}</td>";
                    echo "<td>{$fila_info_usuario['año']}</td>";
                    echo "<td>{$fila_info_usuario['monto']}</td>";
                    echo "<td>{$fila_info_usuario['concepto_pago']}</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "Error al obtener la información de usuarios y pagos: " . $conexion->error;
            }
        ?>
    </div>
</div>

<a href='panel_admin.php' class='btn btn-secondary'>Regresar al Panel de Administrador</a>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

<?php
} else {
    echo "Acceso no autorizado: Debes iniciar sesión como administrador.";
}

$conexion->close();
?>

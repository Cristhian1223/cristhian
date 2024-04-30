<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Panel de Empleado</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "soyyo";
        $dbname = "kfc";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sqlCrearTabla = "CREATE TABLE IF NOT EXISTS pedidos (
            id_pedido INT AUTO_INCREMENT PRIMARY KEY,
            producto_id INT,
            nombre_cliente VARCHAR(255),
            precio DECIMAL(10, 2),
            fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            despachado TINYINT(1) DEFAULT 0,
            FOREIGN KEY (producto_id) REFERENCES producto(id_producto)
        )";
        $conn->query($sqlCrearTabla);

        // Procesar el check-in de hora de entrada
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["checkin"])) {
            $horaEntrada = $_POST["hora_entrada"];
            $idEmpleado = $_POST["id_empleado"];

            // Actualizar la hora de entrada del empleado
            $sqlCheckin = "UPDATE empleado SET hora_entrada = '$horaEntrada' WHERE id_empleado = $idEmpleado";
            if ($conn->query($sqlCheckin) === TRUE) {
                echo '<p class="text-success">Check-in realizado con éxito.</p>';
            } else {
                echo '<p class="text-danger">Error al realizar check-in: ' . $conn->error . '</p>';
            }
        }

        // Procesar el despacho de pedidos
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["despachar"])) {
            $pedidoId = $_POST["pedido_id"];

            // Actualizar el pedido como despachado
            $sqlDespachar = "UPDATE pedidos SET despachado = 1 WHERE id_pedido = $pedidoId";
            if ($conn->query($sqlDespachar) === TRUE) {
                echo '<p class="text-success">Pedido despachado con éxito.</p>';
            } else {
                echo '<p class="text-danger">Error al despachar pedido: ' . $conn->error . '</p>';
            }
        }
        ?>

        <!-- Formulario para el check-in de hora de entrada -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Check-in de Hora de Entrada</h3>
                <form method="post" action="">
                    <!-- Campos para check-in -->
                    <div class="form-group">
                        <label for="id_empleado">ID del Empleado:</label>
                        <input type="number" class="form-control" id="id_empleado" name="id_empleado" required>
                    </div>
                    <div class="form-group">
                        <label for="hora_entrada">Hora de Entrada:</label>
                        <input type="time" class="form-control" id="hora_entrada" name="hora_entrada" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="checkin">Realizar Check-in</button>
                </form>
            </div>

            <!-- Visualizar pedidos pendientes -->
            <div class="col-md-6">
                <h3>Pedidos Pendientes</h3>
                <?php
                // Consultar pedidos no despachados
                $sqlPedidos = "SELECT * FROM pedidos WHERE despachado = 0";
                $resultPedidos = $conn->query($sqlPedidos);

                if ($resultPedidos->num_rows > 0) {
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>ID Pedido</th>';
                    echo '<th>Producto</th>';
                    echo '<th>Cliente</th>';
                    echo '<th>Precio</th>';
                    echo '<th>Fecha de Pedido</th>';
                    echo '<th>Acciones</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($rowPedido = $resultPedidos->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $rowPedido["id_pedido"] . '</td>';
                        echo '<td>' . $rowPedido["producto_id"] . '</td>';
                        echo '<td>' . $rowPedido["nombre_cliente"] . '</td>';
                        echo '<td>' . number_format($rowPedido["precio"], 2) . '</td>';
                        echo '<td>' . $rowPedido["fecha_pedido"] . '</td>';
                        echo '<td>';
                        echo '<form method="post">';
                        echo '<input type="hidden" name="pedido_id" value="' . $rowPedido["id_pedido"] . '">';
                        echo '<button type="submit" class="btn btn-primary" name="despachar">Despachar</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p class="text-info">No hay pedidos pendientes en este momento.</p>';
                }
                ?>
            </div>
        </div>
        
        <p class="text-center mt-4"><a href="pagina.php" class="btn btn-primary">Regresar</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

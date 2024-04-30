<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Bienvenido Cliente</title>
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
            FOREIGN KEY (producto_id) REFERENCES producto(id_producto)
        )";
        $conn->query($sqlCrearTabla);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comprar"])) {
            $productoId = $_POST["producto_id"];

            $sql = "SELECT * FROM producto WHERE id_producto = $productoId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $precio = $row["precio"];
                $sqlPedido = "INSERT INTO pedidos (producto_id, precio) VALUES ($productoId, $precio)";

                if ($conn->query($sqlPedido) === TRUE) {
                    $idPedido = $conn->insert_id; 

                    echo '<h1 class="text-center mb-4">¡Gracias por tu compra!</h1>';
                    echo '<div class="card">';
                    echo '<img src="' . $row["imagen"] . '" class="card-img-top" alt="' . $row["nombre"] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["nombre"] . '</h5>';
                    echo '<p class="card-text">' . $row["descripcion"] . '</p>';
                    echo '<p class="card-text"><strong>Precio: $' . number_format($row["precio"], 2) . '</strong></p>';
                    echo '<p class="card-text">Número de Pedido: ' . $idPedido . '</p>';
                    echo '<p class="card-text">Tu pedido ha sido realizado. En un momento será entregado.</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<p class="text-center mt-4"><a href="cliente.php" class="btn btn-primary">Regresar</a></p>';
                } else {
                    echo '<p class="text-danger">Hubo un error al procesar la compra. Por favor, inténtalo de nuevo.</p>';
                }
            } else {
                echo '<p class="text-danger">Hubo un error al procesar la compra. Por favor, inténtalo de nuevo.</p>';
            }
        } else {
            echo '<h1 class="text-center mb-4">Bienvenido Cliente</h1>';
            echo '<div class="row">';
            
            $sql = "SELECT * FROM producto";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<form method="post">';
                    echo '<div class="card">';
                    echo '<img src="' . $row["imagen"] . '" class="card-img-top" alt="' . $row["nombre"] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["nombre"] . '</h5>';
                    echo '<p class="card-text">' . $row["descripcion"] . '</p>';
                    echo '<p class="card-text"><strong>Precio: $' . number_format($row["precio"], 2) . '</strong></p>';
                    echo '<input type="hidden" name="producto_id" value="' . $row["id_producto"] . '">';
                    echo '<button type="submit" class="btn btn-success" name="comprar">Comprar</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-danger">No hay productos disponibles.</p>';
            }

            echo '</div>';
            echo '<p class="text-center mt-4"><a href="pagina.php" class="btn btn-primary">Regresar</a></p>';
        }

        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

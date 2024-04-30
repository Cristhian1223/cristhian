<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Panel de Administrador</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <?php
        // Configuración de la conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "soyyo";
        $dbname = "kfc";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["agregar_empleado"])) {
                // Agregar un nuevo empleado
                $nombre = $_POST["nombre"];
                $puesto = $_POST["puesto"];
                $horario = $_POST["horario"];
                $edad = $_POST["edad"];
                $salario = $_POST["salario"];
                $fechaIngreso = $_POST["fecha_ingreso"];

                $sql = "INSERT INTO empleado (nombre, puesto, horario, edad, salario, fecha_ingreso) VALUES ('$nombre', '$puesto', '$horario', $edad, $salario, '$fechaIngreso')";
                
                if ($conn->query($sql) === TRUE) {
                    echo '<p class="text-success">Empleado agregado exitosamente.</p>';
                } else {
                    echo '<p class="text-danger">Error al agregar empleado: ' . $conn->error . '</p>';
                }
            } elseif (isset($_POST["eliminar_empleado"])) {
                // Eliminar un empleado
                $idEmpleado = $_POST["id_empleado"];

                $sql = "DELETE FROM empleado WHERE id_empleado = $idEmpleado";

                if ($conn->query($sql) === TRUE) {
                    echo '<p class="text-success">Empleado eliminado exitosamente.</p>';
                } else {
                    echo '<p class="text-danger">Error al eliminar empleado: ' . $conn->error . '</p>';
                }
            } elseif (isset($_POST["modificar_producto"])) {
                // Modificar un producto
                $idProducto = $_POST["id_producto"];
                $nuevoPrecio = $_POST["nuevo_precio"];
                $nuevaDescripcion = $_POST["nueva_descripcion"];

                $sql = "UPDATE producto SET precio = $nuevoPrecio, descripcion = '$nuevaDescripcion' WHERE id_producto = $idProducto";

                if ($conn->query($sql) === TRUE) {
                    echo '<p class="text-success">Producto modificado exitosamente.</p>';
                } else {
                    echo '<p class="text-danger">Error al modificar producto: ' . $conn->error . '</p>';
                }
            } elseif (isset($_POST["agregar_producto"])) {
                // Agregar un nuevo producto
                $nombreProducto = $_POST["nombre_producto"];
                $precioProducto = $_POST["precio_producto"];
                $descripcionProducto = $_POST["descripcion_producto"];

                $sql = "INSERT INTO producto (nombre, precio, descripcion) VALUES ('$nombreProducto', $precioProducto, '$descripcionProducto')";

                if ($conn->query($sql) === TRUE) {
                    echo '<p class="text-success">Producto agregado exitosamente.</p>';
                } else {
                    echo '<p class="text-danger">Error al agregar producto: ' . $conn->error . '</p>';
                }
            }
        }
        ?>

        <!-- Formulario para agregar empleados -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Agregar Empleado</h3>
                <form method="post" action="">
                    <!-- Campos para agregar empleado -->
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="puesto">Puesto:</label>
                        <input type="text" class="form-control" id="puesto" name="puesto" required>
                    </div>
                    <div class="form-group">
                        <label for="horario">Horario:</label>
                        <input type="text" class="form-control" id="horario" name="horario" required>
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad:</label>
                        <input type="number" class="form-control" id="edad" name="edad" required>
                    </div>
                    <div class="form-group">
                        <label for="salario">Salario:</label>
                        <input type="number" class="form-control" id="salario" name="salario" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha de Ingreso:</label>
                        <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="agregar_empleado">Agregar Empleado</button>
                </form>
            </div>

            <!-- Formulario para eliminar empleados -->
            <div class="col-md-6">
                <h3>Eliminar Empleado</h3>
                <form method="post" action="">
                    <!-- Campos para eliminar empleado -->
                    <div class="form-group">
                        <label for="id_empleado">ID del Empleado:</label>
                        <input type="number" class="form-control" id="id_empleado" name="id_empleado" required>
                    </div>
                    <button type="submit" class="btn btn-danger" name="eliminar_empleado">Eliminar Empleado</button>
                </form>
            </div>
        </div>

        <!-- Formulario para agregar productos -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Agregar Producto</h3>
                <form method="post" action="">
                    <!-- Campos para agregar producto -->
                    <div class="form-group">
                        <label for="nombre_producto">Nombre del Producto:</label>
                        <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
                    </div>
                    <div class="form-group">
                        <label for="precio_producto">Precio del Producto:</label>
                        <input type="number" class="form-control" id="precio_producto" name="precio_producto" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion_producto">Descripción del Producto:</label>
                        <input type="text" class="form-control" id="descripcion_producto" name="descripcion_producto" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="agregar_producto">Agregar Producto</button>
                </form>
            </div>

            <!-- Formulario para modificar productos -->
            <div class="col-md-6">
                <h3>Modificar Producto</h3>
                <form method="post" action="">
                    <!-- Campos para modificar producto -->
                    <div class="form-group">
                        <label for="id_producto">ID del Producto:</label>
                        <input type="number" class="form-control" id="id_producto" name="id_producto" required>
                    </div>
                    <div class="form-group">
                        <label for="nuevo_precio">Nuevo Precio:</label>
                        <input type="number" class="form-control" id="nuevo_precio" name="nuevo_precio" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva_descripcion">Nueva Descripción:</label>
                        <input type="text" class="form-control" id="nueva_descripcion" name="nueva_descripcion" required>
                    </div>
                    <button type="submit" class="btn btn-warning" name="modificar_producto">Modificar Producto</button>
                </form>
            </div>
        </div>

        <!-- Mostrar la lista de empleados -->
        <h2 class="text-center mb-4">Lista de Empleados</h2>
        <?php
        $sqlEmpleados = "SELECT * FROM empleado";
        $resultEmpleados = $conn->query($sqlEmpleados);

        if ($resultEmpleados->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID Empleado</th>';
            echo '<th>Nombre</th>';
            echo '<th>Puesto</th>';
            echo '<th>Horario</th>';
            echo '<th>Edad</th>';
            echo '<th>Salario</th>';
            echo '<th>Fecha de Ingreso</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $resultEmpleados->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id_empleado"] . '</td>';
                echo '<td>' . $row["nombre"] . '</td>';
                echo '<td>' . $row["puesto"] . '</td>';
                echo '<td>' . $row["horario"] . '</td>';
                echo '<td>' . $row["edad"] . '</td>';
                echo '<td>' . $row["salario"] . '</td>';
                echo '<td>' . $row["fecha_ingreso"] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p class="text-danger">No hay empleados registrados.</p>';
        }
        ?>
        
        <!-- Mostrar la lista de productos -->
        <h2 class="text-center mb-4">Lista de Productos</h2>
        <?php
        $sqlProductos = "SELECT * FROM producto";
        $resultProductos = $conn->query($sqlProductos);

        if ($resultProductos->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID Producto</th>';
            echo '<th>Nombre</th>';
            echo '<th>Precio</th>';
            echo '<th>Descripción</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $resultProductos->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id_producto"] . '</td>';
                echo '<td>' . $row["nombre"] . '</td>';
                echo '<td>' . $row["precio"] . '</td>';
                echo '<td>' . $row["descripcion"] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p class="text-danger">No hay productos registrados.</p>';
        }
        ?>
        
        <p class="text-center mt-4"><a href="pagina.php" class="btn btn-primary">Regresar</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

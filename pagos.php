<?php
$host = 'localhost';
$db = 'isco3';
$user = 'root';
$pass = 'soyyo';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mes"])) {
    $mes = $_POST["mes"];
    $anio = $_POST["anio"];
    $usuario_id = 1; 
    $monto = $_POST["monto"];

    $sql = "INSERT INTO pagos (usuario_id, mes, anio, monto, pagado) VALUES ($usuario_id, $mes, $anio, $monto, 1)";

    if ($conn->query($sql) === TRUE) {
        echo "Pago realizado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM pagos WHERE usuario_id = $usuario_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pagos Mensuales</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4">Pagos Mensuales</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Año</th>
                    <th>Monto</th>
                    <th>Pagado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['mes']; ?></td>
                        <td><?php echo $row['anio']; ?></td>
                        <td>$<?php echo $row['monto']; ?></td>
                        <td><?php echo ($row['pagado'] ? 'Sí' : 'No'); ?></td>
                        <td>
                            <?php if (!$row['pagado']) { ?>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="mes" value="<?php echo $row['mes']; ?>">
                                    <input type="hidden" name="anio" value="<?php echo $row['anio']; ?>">
                                    <input type="hidden" name="monto" value="<?php echo $row['monto']; ?>">
                                    <button type="submit" class="btn btn-primary">Pagar</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

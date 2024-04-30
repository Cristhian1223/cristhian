<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "soyyo";
$db_name = "isco3";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
    echo 'No se pudo conectar a la base de datos: ' . mysqli_connect_error();
}

$query = "SELECT id, carreras.nombre_carrera
FROM alumno
INNER JOIN carreras ON alumno.id_carrera = carreras.id_carrera
ORDER BY alumno.a_paterno ASC";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alumnos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <table class="table">
        <tr class="danger">
            <th>ID Alumno</th>
            <th>Nombre Alumno</th>
            <th>Carrera</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr class='warning'>
                <td>" . $row['id_alumno'] . "</td>
                <td>" . $row['nombre_alumno'] . "</td>
                <td>" . $row['nombre_carrera'] . "</td>
            </tr>";
        }
        ?>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

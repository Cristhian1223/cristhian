<?php
include('conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola</title>
</head>
<body>
    <?php
    $nombre = $_GET["nombre"];
    $a_paterno = $_GET["a_paterno"];
    $a_materno = $_GET["a_materno"];
    $f_nacimiento = $_GET["f_nacimiento"];
    $f_ingreso = $_GET["f_ingreso"];
    $sexo = $_GET["sexo"];
    $t_sangre = $_GET["t_sangre"];
    $telefono = $_GET["telefono"];
    $direccion = $_GET["direccion"];
    $nacionalidad = $_GET["nacionalidad"];
    $curp = $_GET["curp"];
    $i_medica = $_GET["i_medica"];
    $status = $_GET["status"];
    $carrera = $_GET["carrera"];

    $instruccion_SQL="INSERT INTO alumno(nombre, a_paterno, a_materno, f_nacimiento, f_ingreso, sexo, t_sangre, telefono, direccion, nacionalidad, curp, i_medica, status, carrera) VALUES ('$nombre','$a_paterno','$a_materno','$f_nacimiento','$f_ingreso',$sexo,'$t_sangre','$telefono','$direccion','$nacionalidad','$curp','$i_medica',$status,$carrera)";

    $resultado = mysqli_query($con,$instruccion_SQL);

    if($resultado==FALSE){
        echo "Error en la consulta";
    }
    else{
        echo "Registro guardado <br><br>";
        echo "<table><tr><td>Nombre: $nombre</td></tr>";
        echo "<tr><td>Apellido paterno: $a_paterno</td></tr>";
        echo "<tr><td>Apellido materno: $a_materno</td></tr>";
        echo "<tr><td>Fecha de nacimiento: $f_nacimiento</td></tr>";
        echo "<tr><td>Fecha de ingreso: $f_ingreso</td></tr>";
        echo "<tr><td>Sexo: $sexo</td></tr>";
        echo "<tr><td>Tipo de sangre: $t_sangre</td></tr>";
        echo "<tr><td>Telefono: $telefono</td></tr>";
        echo "<tr><td>Direccion: $direccion</td></tr>";
        echo "<tr><td>Nacionalidad: $nacionalidad</td></tr>";
        echo "<tr><td>CURP: $curp</td></tr>";
        echo "<tr><td>Estatus: $status</td></tr>";
        echo "<tr><td>Carrera: $carrera</td></tr>";
        echo "</table>";
    }
    ?>
    
</body>
</html>
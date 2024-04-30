<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Tablas</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <?php
    include('conexion.php');  // Incluye el archivo 'conexion.php' (suponiendo que contiene la conexión a la base de datos)

    $query = "SELECT * FROM alumno ORDER BY a_paterno ASC";  // Consulta SQL para seleccionar todos los datos de la tabla "alumno"
    $result = mysqli_query($con, $query);  // Ejecuta la consulta utilizando la conexión a la base de datos
    echo "
    <div class='container'>
      <table class='table'>
        <tr class='danger'>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Fecha de nacimiento</th>
          <th>Fecha de ingreso</th>
          <th>status</th>
          <th>curp</th>
        </tr>";  // Imprime la primera fila de encabezado de la tabla

    while($row = mysqli_fetch_array($result)){
      echo "
        <tr class='warning'>
          <td>".$row['nombre']."</td>
          <td>".$row['a_paterno']."</td>
          <td>".$row['a_materno']."</td>
          <td>".$row['f_nacimiento']."</td>
          <td>".$row['f_ingreso']."</td>
          <td>".$row['status']."</td>
          <td>".$row['curp']."</td>

        </tr>";  // Imprime una fila de datos para cada registro obtenido de la consulta
        
    }
    
  ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>

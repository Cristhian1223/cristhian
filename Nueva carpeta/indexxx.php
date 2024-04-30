<?php

// Conexión a la BD
$servername = "localhost";
$username = "root";
$password = "soyyo";
$dbname = "isco3";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Consulta con inner join
$query = "SELECT e.id_empleado, e.nombre, 
                p.id_producto, p.nombre AS nombre_producto
           FROM empleados e
           INNER JOIN productos p ON e.id_empleado = p.id_producto";

$result = mysqli_query($conn, $query);

// Mostrar datos
while($row = mysqli_fetch_assoc($result)){
  
  echo "ID Empleado: " . $row['id_empleado'];
  echo "<br>Nombre: " . $row['nombre'];
  echo "<br>Apellido: " . $row['apellido'];
  echo "<br>ID Producto: " . $row['id_producto']; 
  echo "<br>Producto: " . $row['nombre_producto'];
  echo "<br><br>";
  
}

?>
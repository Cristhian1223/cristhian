<?php
// Conexión a la base de datos SQL Server
$serverName = "DESKTOP-C4FJH0E";
$connectionInfo = array("Database" => "ejemplo", "UID" => "nombre_usuario", "PWD" => "contraseña");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if (!$conn) {
    die("Error al conectar: " . sqlsrv_errors());
}

// Consulta SQL para obtener datos de la tabla
$sql = "SELECT [Nombre], [Cantidad], [Fecha_Caducidad], [Precio_Unitario], [Proveedor] FROM [dbo].[Provisiones]";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Mostrar los datos en una tabla HTML
echo "<table border='1'>";
echo "<tr><th>Nombre</th><th>Cantidad</th><th>Fecha de Caducidad</th><th>Precio Unitario</th><th>Proveedor</th></tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['Nombre'] . "</td>";
    echo "<td>" . $row['Cantidad'] . "</td>";
    echo "<td>" . $row['Fecha_Caducidad']->format('Y-m-d') . "</td>";
    echo "<td>" . $row['Precio_Unitario'] . "</td>";
    echo "<td>" . $row['Proveedor'] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Cerrar la conexión
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

<?php
$productoId = $_POST['producto'];
$cantidadComprada = $_POST['cantidad'];

// Realiza la conexión a la base de datos aquí (como se mencionó en respuestas anteriores)

// Obtener el stock actual del producto
$consultaStock = "SELECT stock FROM productos WHERE id = $productoId";
$resultStock = mysqli_query($conexion, $consultaStock);
$filaStock = mysqli_fetch_assoc($resultStock);
$stockActual = $filaStock['stock'];

if ($stockActual >= $cantidadComprada) {
    // Actualizar el stock después de la compra
    $nuevoStock = $stockActual - $cantidadComprada;
    $actualizarStock = "UPDATE productos SET stock = $nuevoStock WHERE id = $productoId";
    mysqli_query($conexion, $actualizarStock);

    echo "Compra exitosa. Stock actualizado.";
} else {
    echo "No hay suficiente stock para completar la compra.";
}

// Cierra la conexión a la base de datos aquí (como se mencionó en respuestas anteriores)
?>

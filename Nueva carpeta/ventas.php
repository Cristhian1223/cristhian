<!DOCTYPE html>
<html>
<head>
    <title>Compra de Productos</title>
</head>
<body>
    <h1>Compra de Productos</h1>
    <form method="post" action="procesar_compra.php">
        <label for="producto">Selecciona un producto:</label>
        <select name="producto">
            <option value="1">mota</option>
            <option value="2">gansitos</option>
            <!-- Agrega más opciones según los productos en tu base de datos -->
        </select><br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" min="1" value="1"><br>
        <input type="submit" value="Comprar">
    </form>
</body>
</html>

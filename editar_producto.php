<?php
$cnx = mysqli_connect("localhost", "root", "", "tiendaonline");
if(isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    $sql = "SELECT id, nombre, descripcion, precio, descuento, activo FROM productos WHERE id = '$id_producto'";
    $rta = mysqli_query($cnx, $sql);
    $producto = mysqli_fetch_assoc($rta);
}
if(isset($_POST['actualizar'])) {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];
    $activo = $_POST['activo'];

    $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', descuento='$descuento', activo='$activo' WHERE id = '$id_producto'";
    $rta = mysqli_query($cnx, $sql);

    if($rta) {
        header("Location: indexprueba.php");
        exit();
    } else {
        echo "Error al actualizar el producto";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #fff8dc;">
    <br>
    <div class="container mt-5">
        <form method="post" action="">
        <center>
        <h2>Editar Producto</h2>
    </center>
            <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input require type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea require class="form-control" id="descripcion" name="descripcion"><?php echo $producto['descripcion']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input require type="text" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>">
            </div>
            <div class="form-group">
                <label for="descuento">Descuento:</label>
                <input require type="text" class="form-control" id="descuento" name="descuento" require value="<?php echo $producto['descuento']; ?>">
            </div>
            <div class="form-group">
                <label for="activo">Activo:</label>
                <input require  type="text" class="form-control" id="activo" name="activo" value="<?php echo $producto['activo']; ?>">
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-primary" name="actualizar">Actualizar Producto</button>
            <a class="btn btn-primary" href="/indexprueba.php">Regresar</a>
        </form>
    </div>
</body>
</html>

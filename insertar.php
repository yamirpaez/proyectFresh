<?php
    //aqui se ponen todas las variables que se van a guardar del nuevo.php
    $id_productos = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];
    $activo = $_POST['activo'];

    //aqui manda toda la informacion nueva ala base de datos
    $cnx = mysqli_connect("localhost", "root", "", "tiendaonline");
    $sql = "INSERT INTO productos(id, nombre, descripcion, precio, descuento, activo) VALUES('$id_productos', '$nombre', '$descripcion', '$precio', '$descuento', '$activo')";
    $rta = mysqli_query($cnx, $sql);

    if (!$rta){
        echo "No se inserto el nuevo producto, intentalo de nuevo";
    }else{
        //el comando header es para redireccionarte a otra pagina 
        header("Location: indexprueba.php");
    }
?>
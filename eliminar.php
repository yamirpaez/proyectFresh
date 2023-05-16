<?php
    $id = $_GET['id'];
    $cnx = mysqli_connect("localhost", "root", "", "tiendaonline");
    $sql = "DELETE FROM productos WHERE id = $id";
    mysqli_query($cnx, $sql);
    mysqli_close($cnx);
    header('Location: indexprueba.php');
?>



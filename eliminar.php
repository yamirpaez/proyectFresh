<?php
    $id = $_GET['id'];
    $cnx = mysqli_connect("18.223.110.185", "ubuntu", "", "tiendaonline");
    $sql = "DELETE FROM productos WHERE id = $id";
    mysqli_query($cnx, $sql);
    mysqli_close($cnx);
    header('Location: indexprueba.php');
?>



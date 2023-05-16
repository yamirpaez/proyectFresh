<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: center;
        border: 1px solid black;
    }
    th {
        background-color: #333;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .btn {
        display: inline-block;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        background-color: #333;
    }
    .btn:hover {
        background-color: #555;
    }
    .btn-danger {
        background-color: #d9534f;
    }
    .btn-danger:hover {
        background-color: #c9302c;
    }
    .btn-warning {
        background-color: #f0ad4e;
    }
    .btn-warning:hover {
        background-color: #eea236;
    }

</style>

<?php
$cnx =mysqli_connect("18.223.110.185", "ubuntu", "", "tiendaonline");
if(isset($_POST['buscar'])){
    $busqueda = $_POST['buscar'];
    $sql = "SELECT id, nombre, descripcion, precio, descuento, activo FROM productos WHERE id LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%'";
    $rta = mysqli_query($cnx, $sql);
    if(mysqli_num_rows($rta) > 0){
?>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Activo</th>
            </tr>
        </thead>
        <tbody>
<?php
        while ($mostrar = mysqli_fetch_row($rta)){
?>
            <tr>
                <td><?php echo $mostrar['0'] ?></td>
                <td><?php echo $mostrar['1'] ?></td>
                <td><?php echo $mostrar['2'] ?></td>
                <td>$<?php echo $mostrar['3'] ?></td>
                <td><?php echo $mostrar['4'] ?>%</td>
                <td><?php echo $mostrar['5'] ?></td>
                <td>
                    <a href="indexprueba.php" class="btn btn-warning">Regresar</a>                
                </td>
            </tr>
<?php
        }
?>
        </tbody>
    </table>
<?php
    } else {
        echo "No se encontraron resultados para la búsqueda: " . $busqueda;
    }
}
mysqli_close($cnx);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Yam</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-pZjDv9X4F4vl+xG6l/7FidHiMCXPvP8WfN3KjV/TB13pGSK7V5iWJX8hKicNJzTC" crossorigin="anonymous"></script>

</head>
<style>
    .editar-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        margin-right: 5px;
    }

    .eliminar-btn {
        background-color: #dc3545;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
    }

    .cerrar-sesion {
  background-color: red;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

.cerrar-sesion:hover {
  background-color: darkred;
  box-shadow: 0px 0px 5px #888888;
}


</style>

<body style="background-color: #fff8dc;">
    <br>
    <div class="container mt-5">
    <a class="btn cerrar-sesion" href="/index.php">Cerrar Sesion</a><br>
    <br>
    <form class="form-inline justify-content-center mb-3" action="consultar.php" method="post">
        <div class="input-group">
            <input type="text" class="form-control" name="buscar" placeholder="Buscar">
            <div class="input-group-append">
            <button type="submit" class="btn btn-primary ml-2">Buscar</button>

        </div>
        </div>
        <br>
        <a href="nuevo.php" class="btn btn-success ml-2">Nuevo Producto</a>
    </form>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Activo</th>
                    <th>Opciones</th>
                </tr>
                
                <?php
                $cnx = mysqli_connect("localhost", "root", "", "tiendaonline");
                $sql = "SELECT id, nombre, descripcion, precio, descuento, activo FROM productos ORDER BY id desc";
                $rta = mysqli_query($cnx, $sql);
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
                    <a class="btn editar-btn" href="editar_producto.php?id=<?php echo $mostrar['0'] ?>">Editar</a>
                    <a class="btn eliminar-btn" href="eliminar.php?id=<?php echo $mostrar['0'] ?>">Eliminar</a>
                    </td>
                    </tr>
                    <?php
                }
                ?>
                
                
            </thead>
        </table>
    </div>
</div>

</body>
</html>
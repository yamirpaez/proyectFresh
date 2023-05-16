<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>

    body{
        background-color: #fff8dc;

    }
        form {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 50px auto;
  max-width: 600px;
  padding: 20px;
  border: 2px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h2 {
  margin-bottom: 20px;
  font-size: 2rem;
  text-align: center;
}

table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

td {
  padding: 10px;
}

input[type="text"],
input[type="number"],
textarea {
  display: block;
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 5px;
  margin-bottom: 10px;
  background-color: #f2f2f2;
  box-shadow: inset 0px 1px 3px rgba(0, 0, 0, 0.1);
}

input[type="text"]:focus,
input[type="number"]:focus,
textarea:focus {
  outline: none;
  box-shadow: inset 0px 1px 3px rgba(0, 0, 0, 0.2);
}

input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
}
a{
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
}

input[type="submit"]:hover {
  background-color: #0069d9;
}


    </style>
    <div>
    <form action="insertar.php" method="post">
    <h2>INSERTAR UN NUEVO PRODUCTO</h2>
    <table>
        <tr>
            <td>ID</td>
            <td><input type="number" name="id" required></td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><input type="text" name="nombre" required></td>
        </tr>
        <tr>
            <td>Descripcion</td> 
            <td><textarea name="descripcion" rows="5" cols="60" required></textarea></td>
        </tr>
        <tr>
            <td>Precio</td>
            <td>$ <input type="number" name="precio" required></td>
        </tr>
        <tr>
            <td>Descuento</td>
            <td><input type="number" name="descuento" step="0" required><span>%</span></td>
        </tr>
        <tr>
            <td>Activo</td>
            <td><input type="number" name="activo" required></td>
        </tr>
        <tr>
            <td><input type="submit" value="Guardar"></td>
            <td><a href="indexprueba.php" value="">Regresar</a></td>
        </tr>
    </table>
</form>

    </div>
</body>
</html>
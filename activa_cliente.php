<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';


$db = new Database();
$con =$db->conectar();


$id=isset($_GET['id'])?$_GET['id']:'';
$token=isset($_GET['token'])?$_GET['token']:'';

if($id==''|| $token==''){
    header("location: index.php");
    exit;
}

echo validaToken($id,$token,$con);

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Fresh Yam</title>
    <link rel="shorcut icon" href="/img/freshyam_icono.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <header>
        <nav>
           
            <div id="sidebar">
                <div class="toggle-btn"  >
                  <span class="navbar-toggler-icon">&#9776</span>
                </div>
                <ul>
                  <li>
                    <img src="../img/freshyam_icono.jpg" alt="Fresh Yam" class="logo"></li>
                  <li> <a href="/index.php">Inicio. </a></li>
                  <li><a href="/html/acercade.php">  Acerca De. </a></li>
                  <li> <a href="/html/producto.php">  Productos.  </a></li>
                  <li> <a href="/html/servicio.php">  Servicio.  </a></li>
                  <li> <a href="/html/contacto.php">  Contacto. </a></li>
                  <li> <a href="/checkout.php" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>
                  <li> <a href="/html/login.html">  Iniciar Sesion. </a></li>
                </ul>
              </div>
    
        </nav>
        
        <section class="textos-header">
            <h1>FRESH  YAM</h1>
            &nbsp;
            <h2>Moda sustentable</h2>

        </section>
        <div class="wave" style="height: 250px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none"
                style="height: 100%; width: 100%;">
                <path d="M-1.69,12.34 C279.91,151.48 435.10,-87.31 500.00,49.98 L500.00,150.00 L-47.40,165.30 Z"
                    style="stroke: none; fill: white;"></path>
            </svg></div>


            
    </header>
  
    <main>
        
       
        
       
    </main>
    <footer>

        <div class="contenedor-footer">
            <div class="content-foo">
                <h4>Telefono</h4>
                <p>6692400568</p>

            </div>
            <div class="content-foo">
                <h4>Gmail</h4>
                <p>Yamireze@hotmail.es</p>

            </div>
            <div class="content-foo">
                <h4>Location</h4>
                <p>Mazatlan, Sinaloa </p>

            </div>
        </div>

        <h2 class="titulo-final">FRESH YAM &copy;Yamir Paez Ayala</h2>
    </footer>


    <script src="/js/main.js"></script>
   
</body>

</html>
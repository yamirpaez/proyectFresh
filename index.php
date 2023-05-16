<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con =$db->conectar();



$sql = $con->prepare("SELECT id, nombre, precio,descuento,descuento From productos WHERE activo=1");
$sql ->execute();
$resultado =$sql->fetchAll(PDO::FETCH_ASSOC);


//session_destroy();
//print_r($_SESSION);

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

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
                    <li> 
                  
                    <li> <a href="/index.php">Inicio. </a></li>
                  <li><a href="/html/acercade.php">  Acerca De. </a></li>
                  <li> <a href="/html/producto.php">  Productos.  </a></li>
                  <li> <a href="/html/contacto.php">  Contacto. </a></li>
                  
                   
                  <li> <a href="/checkout.php" class="btn btn-primary "><i class="fa fa-shopping-cart"></i> Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>
                <li><a  href="/login.php">Administrador</a></li>
                  <?php if(isset($_SESSION['user_id'])){ ?>
                 
                   <li><div class="dropdown">
                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="btn_session" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="btn_session">
                      <li><a href class="dropdown-item" href="logout.php">Cerrar sesion</a></li>
      
                      </ul>
                         </div></li> 



                <?php }else{ ?>
                    <li> <a href="login.php" class="btn btn-success"><i class="fas fa-user"></i> Iniciar Session </a><li>

                    <?php }?>
               

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
        




        <section class="contenedor sobre-nosotros">
            <h2 class="titulo">Nuestro Producto</h2>
            <div class="contenedor-sobre-nosotros">

                <img src="/img/producto1.jpg" alt="" class="imagen-about-us">
                <div class="contenidos-textos">
                    
                    <h3><span class="span1">1</span>Descripcion del producto:</h3>
                    <p>Es un bien y un servicio.</p>
                    
                    <p>  
                        Marca de ropa que ofrece alternativas de compra mas sustentable para nuestros clientes,
                        por que nos importa de que estan hechas nuestras prendas y como se hicieron.

                        
                    </p>
                      &nbsp;                                                    
                    <p>"El mundo cambio, la industria de la moda necesita cambiar".</p>
                    &nbsp;
                    <h3><span class="span2">2</span>Iniciativas sustentables</h3>
                   &nbsp;
                    <p>Reducir los desechos y reutilizar recursos, Uso de algodon, Uso de poliester reciclado,
                Uso de tintas naturales y 
        
                    Rediseño de prendas</p>
                </div>
            </div>
        </section>

        &nbsp;
        <section class="about-services">
            <div class="contenedor">
                <h2 class="titulo">nuestros servicios</h2>
                <div class="servicio-cont">
                    <div class="servicio-int">
                        <img src="/img/servicio1.jpg" alt="">
                        <h3>Compras en  linea</h3>
                        <p>con el servicio compra en linea es mas facil obtener tu producto favorito.</p>
                    </div>
                    <div class="servicio-int">
                        <img src="/img/servicio2.jpg" alt="">
                        <h3>Entregas a cualquier parte</h3>
                        <p>Entregas seguras y rastreables.</p>
                    </div>
                    <div class="servicio-int">
                        <img src="/img/servicio3.jpg" alt="">
                        <h3>Atencion al cliente </h3>
                        <p>A su disposicion las 24 horas del dia.</p>
                    </div>
                </div>

            </div>




        </section>


           

        
        
       
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
<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';


$db = new Database();
$con =$db->conectar();


$errors=[];

if(!empty($_POST)){
   
    $usuario=trim($_POST['usuario']);
    $password=trim($_POST['password']);
   


   if(esNulo([$usuario,$password])){
      $errors[]="Debe llenar todos los campos";
   }
  if(count($errors)==0){
  $errors[]= login($usuario, $password,$con);
    
  }
}


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
                  <li> <a href="/index.php">Inicio. </a></li>
                  <li><a href="/html/acercade.php">  Acerca De. </a></li>
                  <li> <a href="/html/producto.php">  Productos.  </a></li>
                 
                  <li> <a href="/html/contacto.php">  Contacto. </a></li>
                  <li> <a href="/checkout.php" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>
                  <?php if(isset($_SESSION['user_id'])){ ?>
                  <li> <a href="" class="btn btn-success"><i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?> </a> </li>
                <?php }else{ ?>
                    <li><a href="login.php" class="btn btn-success"><i class="fas fa-user"></i>Iniciar Session </a> </li>

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
  
    <main class="form-login m-auto pt-4">
    <h2>Iniciar sesion.</h2>
           
           <?php mostrarMensajes($errors);?>
          
           <form class="row g-3" action="login.php" method="post" autocomplete="off">
                 <div class="form-floating">
                    <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario">
                     <label for="usuario">Usuario</label>
   
                 </div>
                 <div class="form-floating">
                    <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña">
                     <label for="password">Contraseña</label>
   
                 </div>
                 <div class="col-12">
                   <a href="recupera.php">¿Olvidaste tu contraseña?</a>
                 </div>
                 <div class=".d-grid gap-3 col-12">
                   <button type="submit" class="btn btn-primary">Ingresar</button>
                 </div>
                 <hr>
                 <div class="col-12">¿No tiene cuenta?<a href="/registro.php">Registrate aqui</a>
               </div>
   
           </form>
           <br>
           <br><br>
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
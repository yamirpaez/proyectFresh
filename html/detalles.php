<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
  echo 'Error en la petición';
  exit;
} else {
  $token_tmp = hash_hmac('sha512', $id, KEY_TOKEN);
  if ($token == $token_tmp) {
    $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
    $sql->execute([$id]);
    if ($sql->fetchColumn() > 0) {
      $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1");

      $sql->execute([$id]); 
      $row = $sql->fetch(PDO::FETCH_ASSOC);
      $nombre = $row['nombre'];
      $descripcion = $row['descripcion'];
      $precio = $row['precio'];
      $descuento = $row['descuento'];
      $precio_desc = $precio-(($precio*$descuento)/100);
      $dir_images='../img/'.$id.'/';
      $rutaimg=$dir_images.'fresh.jpeg';
      if(!file_exists($rutaimg)){
        $ruta='img/nohay.png';
      }

      $imagenes=array();
       if(file_exists($dir_images)){

       

      $dir=dir($dir_images);
      while(($archivo=$dir->read())!=false){
        if($archivo !='fresh.jpeg'&&(strpos($archivo,'jpeg')||strpos($archivo,'jpg') )){
                
                $imagenes[]= $dir_images.$archivo;
        }
      }
      $dir->close();
    }
  }
  } else {
    echo 'Error en la petición';
    exit;
  }
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Fresh Yam</title>
    <link rel="shorcut icon" href="/img/freshyam_icono.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/css/estilos.css">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

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
                  <li> <a href="../login.php" class="btn btn-success"><i class="fas fa-user"></i>Iniciar Session </a><li>

                    <?php }?>
          
                </ul>
             </div>
   
       </nav>



        <section class="textos-header">
            <h1>FRESH  YAM</h1>
            &nbsp;
            <h2>Moda sustentable</h2>

           


     
        <div class="wave" style="height: 250px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none"
                style="height: 100%; width: 100%;">
                <path d="M-1.69,12.34 C279.91,151.48 435.10,-87.31 500.00,49.98 L500.00,150.00 L-47.40,165.30 Z"
                    style="stroke: none; fill: white;"></path>
            </svg>

          
    
        </div>
        <nav>
           
          
        
    
    </div>
        
    </section>
          

    
    
   
    
        


    </header>

    <main>










      
         <div class="container">
           <div class="row" >
            <div class="col-md-6 order-md-1">
            <div id="carouselImages" class="carousel slide" data-bs-ride="true">
  <div class="carousel-inner">
    <div class="carousel-item active">
      
      <img width="530" height="400"src="<?php echo $rutaimg;  ?>"  class="d-block w-530">
    </div>
    <?php  foreach($imagenes as $img)   { ?>
    <div class="carousel-item ">
    <img  width="530" height="400" src="<?php echo $img;  ?>"  class="d-block w-530">
    </div>
    <?php  }  ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
            </div>  
            <div class="col-md-6 order-md-2">
              <h2><?php echo $nombre; ?></h2>

             <?php if($descuento >0){       ?>
              <p><del><?php echo MONEDA.number_format($precio,2,'.',','); ?></del></p>                
            <h2>
              <h2><?php echo MONEDA.number_format($precio_desc,2,'.',','); ?></h2>
            <small class="text-sucess"><?php  echo $descuento;?>% descuento</small> 
            </h2>
             <?php  }else{?>


           
              <h2><?php echo MONEDA.number_format($precio,2,'.',','); ?></h2>
              <?php  }?>
              <p class="lead">
                       <?php echo $descripcion;  ?>

              </p>
              <div class="d-grid gap-3 col-10 mx-auto" >
                  <button  class="btn btn-primary"  type="button">Comprar ahora  </button>
                  <button  class="btn btn-outline-primary"  type="button" onclick="addProducto(<?php echo  $id; ?>,'<?php echo $token_tmp; ?>')" >Agregar al carrito  </button>
              </div>
            </div>      
           </div>
         </div>
                

       
        
               
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
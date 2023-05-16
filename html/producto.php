<?php
require '../config/config.php';
require '../config/database.php';
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Fresh Yam</title>
    <link rel="shorcut icon" href="/img/freshyam_icono.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/css/estilos.css">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <header>
        <nav>
            <div id="sidebar">
                <div class="toggle-btn">
                    <span class="navbar-toggler-icon">&#9776</span>
                </div>
                <ul>
                    <li>
                        <img src="../img/freshyam_icono.jpg" alt="Fresh Yam" class="logo">
                    </li>
                    <li> <a href="/index.php">Inicio. </a></li>
                    <li><a href="/html/acercade.php"> Acerca De. </a></li>
                    <li> <a href="/html/producto.php"> Productos. </a></li>
                    
                    <li> <a href="/html/contacto.php"> Contacto. </a></li>
                   
                   
                    <li> <a href="/checkout.php" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>
                    <?php if(isset($_SESSION['user_id'])){ ?>
                  <li> <a href="" class="btn btn-success"><i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?> </a> </li>
                <?php }else{ ?>
                    <li><a href="login.php" class="btn btn-success"><i class="fas fa-user"></i>Iniciar Session </a></li>

                    <?php }?>
                </ul>
            </div>

        </nav>

        </div>
        <section class="textos-header">
            <h1>FRESH YAM</h1>
            &nbsp;
            <h2>Moda sustentable</h2>





            <div class="wave" style="height: 250px; overflow: hidden;"><svg viewBox="0 0 500 150"
                    preserveAspectRatio="none" style="height: 100%; width: 100%;">
                    <path d="M-1.69,12.34 C279.91,151.48 435.10,-87.31 500.00,49.98 L500.00,150.00 L-47.40,165.30 Z"
                        style="stroke: none; fill: white;"></path>
                </svg>



            </div>


        </section>







    </header>

    <main>


        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach($resultado as $row) { ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <?php 
                             $id = $row['id'];
                              $image= "../img/" . $id . "/fresh.jpeg";
                              
                              if(!file_exists($image)){
                                $image = "../img/nohay.png";
                              }
                              ?>
                        <img width="360" height="320" src="<?php  echo $image; ?>" alt="">
                        <div class="card-body">
                            <p class="card-title"><?php echo $row['nombre'];   ?></p>
                            <p class="card-text"><?php echo $row['precio']  ;   ?></p>
                            <div class="d-flex justify-content-between align-items-center">

                                <div class="btn-group">
                                    <a href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha512',$row['id'], KEY_TOKEN); ?>"
                                        class="btn btn-primary">Detalles</a>

                                </div>
                                <button  class="btn btn-outline-success"  type="button" onclick="addProducto
                                (<?php echo   $row['id']; ?>,'<?php echo hash_hmac('sha512',$row['id'], KEY_TOKEN); ?>')" >Agregar al carrito  </button>
                            </div>

                        </div>

                    </div>

                </div>
                <?php }?>
            </div>













            <section class="clientes contenedor">
                <h2 class="titulo">Que dicen nuestros clientes</h2>
                <div class="cards">
                    <div class="card">
                        <img src="" alt="">
                        <div class="contenido-texto-card">
                            <h4>
                                Angel Robles
                            </h4>
                            <p>Estoy encantado con mi compra, me llego en 2 dias y la camisa me encanto. Ahora es una de
                                mis camisas favoritas.</p>


                        </div>
                    </div>
                    <div class="card">
                        <img src="/img/cliente3.jpg" alt="">
                        <div class="contenido-texto-card">
                            <h4>
                                Andrea Picos zazueta
                            </h4>
                            <p>muy comoda, barata y ademas con esta compra sustentable ayudo a la tierra 100%
                                recomendada.</p>


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
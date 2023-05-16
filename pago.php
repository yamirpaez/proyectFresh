<?php
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$con =$db->conectar();

$producto = isset($_SESSION['carrito']['producto']) ? $_SESSION['carrito']['producto'] : null;

//print_r($_SESSION);

$lista_carrito = array();

if ($producto !=null) {
    foreach($producto as $clave => $cantidad){
        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}else{
  header("Location: index.php");
  exit;
}
//session_destroy();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
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
                    <a href="login.php" class="btn btn-success"><i class="fas fa-user"></i>Iniciar Session </a>

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
    <div class="container">
      <div class="row">
          <div class="col-6">
                <h4>Detalles de pago</h4>

                <div id="paypal-button-container"></div>

          </div>
       <div class="col-6" >
       <div class="table-reponsive">
           <table class="table">
              <thead>
               <tr>

                    <th>producto</th>
               
                    <th>Subtotal</th>
                    

                
               </tr>
            </thead>
              <tbody>
                    <?php
                       if($lista_carrito==null){
                        echo'<tr><td colspan="5" class="text-center"><b>lista vacia</td></tr>';
                       }else{

                            $total=0;      
                             foreach($lista_carrito as $producto){

                                $_id=$producto['id'];
                                $nombre=$producto['nombre'];
                                $precio=$producto['precio'];
                                $descuento=$producto['descuento'];
                                $cantidad=$producto['cantidad'];
                                $precio_desc=$precio-(($precio*$descuento)/100);
                                $subtotal=$cantidad *$precio_desc;
                                $total+= $subtotal;
                             
                       

                      ?>
                  <tr>
                        <td><?php echo $nombre; ?></td>  
                        

                        <td>
                           <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]" > <?php echo MONEDA . number_format ($subtotal,2,'.',','); ?>   </div>

                        </tr>
                       
            
                <?php   }?>
                    
                     <tr>
                         
                         <td colspan="2 "> 
                            <p class="h3 text-end" id="total" ><?php echo MONEDA.number_format($total,2,'.',',');?> </p>
                         </td>
                     
                     </tr>


                    </tbody>
                    <?php   }?>
           </table>


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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
     
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID;?>&currency=<?php echo CURRENCY;?>"></script>
     <script>
      
  paypal.Buttons({
    style:{
        color:'blue',
        shape:'pill',
        label:'pay'
    },
    createOrder:function(data,actions){
      return actions.order.create({
         purchase_units:[{
            amount:{
                value: <?php echo $total;  ?>
            }
         }]
      });

    },
    onApprove:function(data,actions){

      let URL='clases/captura.php'
           actions.order.capture().then(function (detalles){
            console.log(detalles);

            let url='clases/captura.php'

           return fetch(url,{
              method:'POST',
              headers:{
                'content-type':'application/json'

              },
              body: JSON.stringify({
                detalles: detalles
              })
            }).then(function(response){
              window.location.href="../html/completado.php?key="+detalles['id'];
            })
      
           });
    },
    onCancel:function(data){
        alert("pago cancelado");
        console.log(data);
    }
    // Configuración de los botones de PayPal
  }).render('#paypal-button-container');


    </script>
   
    </body>

</html>
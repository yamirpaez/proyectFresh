<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';


$db = new Database();
$con =$db->conectar();


$errors=[];

if(!empty($_POST)){
    $nombres=trim($_POST['nombres']);
    $apellidos=trim($_POST['apellidos']);
    $email=trim($_POST['email']);
    $telefono=trim($_POST['telefono']);
    $dni=trim($_POST['dni']);
    $usuario=trim($_POST['usuario']);
    $password=trim($_POST['password']);
    $repassword=trim($_POST['repassword']);


   if(esNulo([$nombres, $apellidos, $email, $telefono, $dni,  $usuario,$password,$repassword])){
      $errors[]="Debe llenar todos los campos";
      
   }

   if(!esEmail($email)){
    $errors[]="La direccion de correo electronico no es valida";
     
   }






   if(!validarPassword($password,$repassword)){
    $errors[]="las contraseñas no coinciden";
   }

if(usuarioExiste($usuario, $con)){
    $errors[]="El nombre del usuario $usuario ya existe";
}

if(emailExiste($email, $con)){
    $errors[]="El correo electronico  $email ya existe";
}


if(count($errors)==0){


    $id=registraCliente([$nombres, $apellidos, $email,$telefono,$dni], $con);


    if($id>0){
      require 'clases/Mailer.php';
      $mailer=new Mailer();
      $token=generarToken();
     

        $pass_hash=password_hash($password,PASSWORD_DEFAULT);
       $idUsuario=registraUsuario([$usuario,$pass_hash,$token, $id],$con);
       if($idUsuario>0){
        $url=SITE_URL .'/activa_cliente.php?id='.$idUsuario .'&token='.$token;
        // http://localhost:3000/activa_cliente_php?id=1&token=daa2e84a2b0c0e09e7f858cca1e14313
          $asunto="Activar cuenta- Fresh Yam ";
         $cuerpo="Estimado $nombres:<br> para continuar con el proceso de registro es indispensable
         de click en la siguiente liga <a href='$url'>Activar cuenta</a>";
   



             if($mailer->EnviarEmail($email,$asunto,$cuerpo)){
               echo "para terminar el proceso de registro siga
              las instrucciones que le hemos enviado ala direccion de correo electronico $email ";

              exit;
             }
       }else{
        
        $errors[]="error al registrar usuario";
       }
    }else{
        $errors[]="error al registrar cliente";
    }
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
                  <li> <a href="/html/servicio.php">  Servicio.  </a></li>
                  <li> <a href="/html/contacto.php">  Contacto. </a></li>
                  <li> <a href="/checkout.php" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>
            
                  <?php if(isset($_SESSION['user_id'])){ ?>
                  <li> <a href="" class="btn btn-success"><i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?> </a> </li>
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
        
       <div class="container">
                  <h2>Datos del cliente</h2>
             <?php  mostrarMensajes($errors); ?>
                 <form class="row g-3" action="registro.php" method="post"  autocomplete="off">
                       <div class="col-md-6">
                             <label for="nombres"><span class="text-danger">*</span>Nombres</label> 
                              <input type="text" name="nombres" id="nombres" class="form-control" >

                       </div>
                       <div class="col-md-6">
                             <label for="apellidos"><span class="text-danger">*</span> Apellidos</label> 
                              <input type="text" name="apellidos" id="apellidos" class="form-control" >

                       </div>
                       <div class="col-md-6">
                             <label for="email"><span class="text-danger">*</span> Correo electronico</label> 
                              <input type="email" name="email" id="email" class="form-control" >
                              <span id="validaEmail" class="text-danger"></span>
                       </div>
                       <div class="col-md-6">
                             <label for="telefono"><span class="text-danger">*</span> Telefono</label> 
                              <input type="tel" name="telefono" id="telefono" class="form-control" >

                       </div>
                       <div class="col-md-6">
                             <label for="dni"><span class="text-danger">*</span> DNI</label> 
                              <input type="text" name="dni" id="dni" class="form-control" >

                       </div>
                       <div class="col-md-6">
                             <label for="usuario"><span class="text-danger">*</span> Usuario</label> 
                              <input type="text" name="usuario" id="usuario" class="form-control">
                            <span id="validaUsuario" class="text-danger"></span>
                       </div>

                       <div class="col-md-6">
                             <label for="password"><span class="text-danger">*</span> Contraseña</label> 
                              <input type="password" name="password" id="password" class="form-control" >

                       </div>

                       <div class="col-md-6">
                             <label for="repassword"><span class="text-danger">*</span> Repetir Contraseña</label> 
                              <input type="password" name="repassword" id="repassword" class="form-control">

                       </div>
                    <i><b>NOTA:</b> Los campos con asteriscos son obligatorios</i>
                 <div class="col-12">
                    <button type="submit" class="btn btn-primary" >Registrar</button>
                 </div>
                
                
                </form>





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
    <script>
        let txtUsuario=document.getElementById('usuario')
         txtUsuario.addEventListener("blur",function(){
            existeUsuario(txtUsuario.value)
         }, false)

         let txtEmail=document.getElementById('email')
         txtEmail.addEventListener("blur",function(){
            existeEmail(txtEmail.value)
         }, false)


         function existeUsuario(usuario) {
  let url="clases/clienteAjax.php"
  let formData = new FormData()
  formData.append("action","existeUsuario")
  formData.append("usuario",usuario)

  fetch(url,{
    method:'POST',
    body: formData
  }).then(response => response.json())
    .then(data => {
      if(data.ok){
        document.getElementById('usuario').value=''
        document.getElementById('validaUsuario').innerHTML='Usuario no disponible'
      } else {
        document.getElementById('validaUsuario').innerHTML=''
      }
    })
}

function existeEmail(email) {
  let url="clases/clienteAjax.php"
  let formData = new FormData()
  formData.append("action","existeEmail")
  formData.append("email",email)

  fetch(url,{
    method:'POST',
    body: formData
  }).then(response => response.json())
    .then(data => {
      if(data.ok){
        document.getElementById('email').value=''
        document.getElementById('validaEmail').innerHTML='Correo no disponible'
      } else {
        document.getElementById('validaEmail').innerHTML=''
      }
    })
}

    </script>
</body>

</html>
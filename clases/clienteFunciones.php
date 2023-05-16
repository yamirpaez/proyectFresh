<?php


function esNulo(array $parametros){
foreach($parametros as $parameto){

if(strlen(trim($parameto))<1){
     return true;
}

}
return false;
}


function esEmail($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}

function validarPassword($password,$repassword){

if(strcmp($password,$repassword)==0){
    return true;
}
return false;

}

function generarToken(){
return md5(uniqid(mt_rand(),false));
}

function registraCliente(array $datos, $con){
    $sql = $con->prepare("INSERT INTO clientes (nombres, apellidos, email, telefono, dni, estatus, fecha_alta) VALUES(?, ?, ?, ?, ?, 1, now())");
    
    if($sql->execute($datos)){
        return $con->lastInsertId();
    }
    return 0;
}

function registraUsuario(array $datos,$con){

    $sql=$con->prepare("INSERT INTO usuarios (usuario, password, token, id_cliente) VALUES(?,?,?,?)");
    if($sql->execute($datos)){
        return $con->lastInsertId();

    }    
   return 0;

}

function usuarioExiste($usuario, $con){
    $sql = $con->prepare("SELECT id FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    
    $sql->execute([$usuario]);

    if($sql->fetchColumn()>0){
        return true; 
    }
        
    
    return false;
}


function emailExiste($email, $con){
    $sql = $con->prepare("SELECT id FROM clientes WHERE email LIKE ? LIMIT 1");
    
    $sql->execute([$email]);

    if($sql->fetchColumn()>0){
        return true; 
    }
        
    
    return false;
}


function mostrarMensajes(array $errors){
   if(count($errors)>0){
    echo' <div class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
    foreach($errors as $error){
      echo '<li>'.$error.'</li>';

    }
    echo '<ul>';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

    


   }
}




function validaToken($id, $token,$con){
    $sql = $con->prepare("SELECT id FROM usuarios WHERE id = ? AND token LIKE ? LIMIT 1");
    
    $sql->execute([$id,$token]);

    if($sql->fetchColumn()>0){
       if( activarUsuario($id,$con)>0){
           $msg="cuenta activada.";
       }else{
        $msg="error al activar cuenta.";
       }
    }else{
        $msg="no existe el registro del cliente.";
    }
        
    
    return $msg;
}

function activarUsuario($id, $con) {
    $sql = $con->prepare("UPDATE usuarios SET activacion=1, token='' WHERE id = ?");
    return $sql->execute([$id]);
  }

function login($usuario,$password,$con){
   $sql=$con->prepare("SELECT id,usuario,password FROM usuarios WHERE usuario LIKE ? LIMIT 1 "); 
   $sql->execute([$usuario]);
   
   if($row=$sql->fetch(PDO::FETCH_ASSOC)){
         if(esActivo($usuario,$con)){
           if(password_verify($password,$row['password'])){
            $_SESSION['user_id']=$row['id'];
            $_SESSION['user_name']=$row['usuario'];
            header("Location: indexprueba.php");
            exit;
           }
         }else{
            return'El usuario no a sido activado.';
         }
   }
   return 'El usuario y/o contraseña con incorrectos.';

}
function esActivo($usuario,$con){
    $sql=$con->prepare("SELECT activacion FROM usuarios WHERE usuario LIKE ? LIMIT 1 "); 
    $sql->execute([$usuario]);
    $row=$sql->fetch(PDO::FETCH_ASSOC);
    if($row['activacion']==1){
        return true;
    }else{
        return false; 
    }
}
?>
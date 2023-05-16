<?php
define("CLIENT_ID","AWkMKsjJDsd0DpxLFnuOy7NN4LUeWGYlhDxcbK75bZHUTxyS8PtB2yyX4OHz_pkRl5ixmjnsTWJ1NpoT");
define("CURRENCY","MXN");
define("KEY_TOKEN","A_123#Abcd$");
define("MONEDA","$");
define("SITE_URL","http://localhost:3000");

//DATOS PARA ENVIO de correo 
define("MAIL_HOST","smtp.gmail.com");
define("MAIL_USER","ingpaezayala@gmail.com");
define("MAIL_PASS","waoefbgxqrqyxtcr");
define("MAIL_PORT","465");



session_start();

$num_cart=0;
if(isset($_SESSION['carrito']['producto'])){
    $num_cart = count( $_SESSION['carrito']['producto']);
}


?>
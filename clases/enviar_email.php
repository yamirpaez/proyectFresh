<?php



use PHPMailer\PHPMailer\{PHPMailer,SMTP,Exception};

function enviar_email($id_transaccion) {

    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    require '../phpmailer/src/Exception.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; //SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = MAIL_HOST;                    //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = MAIL_USER;                    //SMTP username
        $mail->Password   = MAIL_PASS;                              //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       =MAIL_PORT;                                  //TCP port to connect to; use 465  587 if you have set `PHPMailer::ENCRYPTION_STARTTLS   `

        //Recipients
        $mail->setFrom('ingpaezayala@gmail.com', 'Tienda Fresh Yam');
        $mail->addAddress('yamireze@hotmail.es', 'Joe User');     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Detalle de su compra';

        $cuerpo='<h4>Gracias por su compra</h4>';
        $cuerpo .='<p>El ID de su compra es <b>'.$id_transaccion.'</b></p>';
        $mail->Body    = utf8_decode($cuerpo);
        $mail->AltBody = 'Le enviamos los detalles de su compra.';
        $mail->setLanguage('es','../phpmailer/language/phpmailer.lang-es.php');
        $mail->SMTPDebug = 0;
        $mail->send();

    } catch (Exception $e) {
        echo "Error al enviar el correo eletronico de la compra: {$mail->ErrorInfo}";

    }

}
?>

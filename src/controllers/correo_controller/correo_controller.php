<?php
// Incluir la clase PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'ruta/a/tu/PHPMailer/src/Exception.php';
require 'ruta/a/tu/PHPMailer/src/PHPMailer.php';
require 'ruta/a/tu/PHPMailer/src/SMTP.php';

class correo_controller 
{
    public function enviar_correo($correo_destinatario, $tema, $contenido)  {
        // Configurar el servidor SMTP y las credenciales
    $mail = new PHPMailer(true);

try {
    //correo
    $correo = 'hwiverificacion@hacebwhirlpoolindustrial.com';
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'mail.hacebwhirlpoolindustrial.com';
    $mail->SMTPAuth = true;
    $mail->Username = $correo;
    $mail->Password = 'HWI2023';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Configurar el correo
    $mail->setFrom($correo, 'RFP Notificaciones');
    $mail->addAddress($correo_destinatario);
    $mail->isHTML(true);
    $mail->Subject = $tema;
    $mail->Body = $contenido;

    // Enviar el correo
    $mail->send();
    echo 'Correo enviado correctamente';
} catch (Exception $e) {
    echo 'Error al enviar el correo: ', $mail->ErrorInfo;
}
    }
}


?>

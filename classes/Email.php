<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email,$nombre,$token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['localhost'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['2525'];
        $mail->Username = $_ENV['dc37aab2b0c106'];
        $mail->Password = $_ENV['bed4f238a3002b'];
    
        $mail->setFrom('jam.ggarcia@alumnos.utsv.edu.mx');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';
    
        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
    
        $contenido = '<html>';
        $contenido .= "<p>Hola ";
        $contenido .= "<strong>" . $this->nombre .  "</strong>";
        $contenido .= " has registrado correctamente tu cuenta en ";
        $contenido .= "[Nombre del Sitio Web]";
        $contenido .= ". Solo debes confirmarla usando el siguiente enlace.</p>";
        $contenido .= "<p>Presiona aquí: ";
        $contenido .= "<a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=";
        $contenido .= $this->token;
        $contenido .= "'>Confirmar Cuenta</a>";
        $contenido .= "<p>Si tú no creaste esta cuenta, puedes ignorar el mensaje.</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;
    
        //Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones() {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['localhost'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['2525'];
        $mail->Username = $_ENV['dc37aab2b0c106'];
        $mail->Password = $_ENV['bed4f238a3002b'];
    
        $mail->setFrom('jam.ggarcia@alumnos.utsv.edu.mx');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p>Hola ";
        $contenido .= "<strong>" . $this->nombre .  "</strong>";
        $contenido .= " has solicitado reestablecer tu contraseña. ";
        $contenido .= "Usa el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: ";
        $contenido .= "<a href='". $_ENV['APP_URL'] ."/recuperar?token=";
        $contenido .= $this->token;
        $contenido .= "'>Reestablecer contraseña</a>";
        $contenido .= "<p>Si tú no solicitaste este cambio, puedes ignorar el mensaje.</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }


}



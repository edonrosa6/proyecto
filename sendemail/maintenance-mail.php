<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require './phpmailer/src/PHPMailer.php';
    require './phpmailer/src/SMTP.php';
    require './phpmailer/src/Exception.php';

    include('../db.php');
    $conn = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la base de datos: " . mysqli_connect_error();
    } 

    $result = mysqli_query($conn, "SELECT * FROM mantenimientos");


    // Enviar email a cada Responsable del mantenimiento menor o igual a 15 días
    foreach($result as $res) {
        
        // Instanciar el objeto PHPMailer
        $mail = new PHPMailer(true);

        $FECHA = new DateTime($res["Fecha_de_mantenimiento"]);
        $VIGENCIA = new DateTime($res["Vigencia_de_mantenimiento"]);

        $interval = date_diff($FECHA, $VIGENCIA); // diferencia de dias

        $days_diff = $interval->format('%a'); // formato a diferencia de dias en dias 00

        if($days_diff <= 15) { // diferencia de dias menor o igual a 15 dias
            try {
                $message = "
                    <html>
                        <head></head>
                        <body>
                            <p style='background-color: #f7f7f7; padding: 20px;'>Mantenimiento a caducar con ID: " . $res['ID'] . "</p>
                            <p>Fecha de Vigencia de Mantenimiento: " . $res['Vigencia_de_mantenimiento'] . "</p>
                            <a href='http://s998989608.onlinehome.mx/Maintenance/Mtable2.php'>Ver mas detalles</a>
                        </body>
                    </html>
                ";
                // Configurar el servidor SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->SMTPSecure = "ssl";
                $mail->Username   = 'labalertsystem@gmail.com';
                $mail->Password   = 'vvcrblspdiqoxnqc';
                $mail->Port = 465;
        
                // Configurar el remitente y destinatario
                $mail->setFrom('labalertsystem@gmail.com');
                $mail->addAddress($res["Responsable"]);
        
                // Configurar el asunto y el cuerpo del mensaje
                $mail->Subject = 'Mantenimientos prontos a vencer';
                $mail->IsHTML(true);
                $mail->Body = $message;

                // Enviar el correo
                $mail->send();
                echo 'Correo enviado correctamente';
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        }
    }

    
?>

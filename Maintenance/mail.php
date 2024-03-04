<?php 
require_once &quot;vendor/autoload.php&quot;;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/* Clase para tratar con excepciones y errores */
require 'C:\PHPMailer\src\Exception.php';
/* Clase PHPMailer */
require 'C:\PHPMailer\src\PHPMailer.php';
/*Clase SMTP necesaria para conectarte a un servidor SMTP */
require 'C:\PHPMailer\src\SMTP.php';
$email = new PHPMailer(TRUE);


?>
<?php 
  include('../db.php');
  $conn = mysqli_connect($host, $user, $pass, $db);

  if (mysqli_connect_errno()) {
    echo "Fallo la conexion a la base de datos: " . mysqli_connect_error();
  } 

  $result = mysqli_query($conn, "SELECT * FROM calibraciones");

  foreach($result as $r) {
    $FECHA = new DateTime($r["Fecha_de_calibracion"]);
    $VIGENCIA = new DateTime($r["Vigencia_de_calibracion"]);

    $interval = date_diff($FECHA, $VIGENCIA);

    $days_diff = $interval->format('%a');

    if($days_diff < 16) {
      $to = $r['Responsable'];
      $subject = "Calibración está por llegar";
      $message = 
      $mensaje = '
        <html>
          <head>
            <title>Calibraciones</title>
          </head>
          <body>
            <p>¡Mantenimiento pronto a llegar!</p>
            <p>Mantenimiento con ID:' . $r["ID"] . '</p>            
            <p>AVISO: LA FECHA DE CALIBRACIÓN SE ACERCA A LA FECHA DE VIGENCIA</p>
          </body>
        </html>';
      $headers = "From: test@mail.com" . "\r\n" . 
        "Reply-To: contacto@mail.com" . "\r\n" . 
        "X-Mailer: PHP/" . phpversion();
    
      mail($to, $subject, $message, $headers);
    }
  }

?>

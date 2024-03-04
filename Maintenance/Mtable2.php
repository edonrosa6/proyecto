<?php
session_start();

  if(!isset($_SESSION['ID'])) {
    header("Location: ../index.php");
    exit();
  }

  include('../db.php');
  $conn = mysqli_connect($host, $user, $pass, $db);
  
  
  if (mysqli_connect_errno())
  {
    echo "Fallo la conexion a la base de datos: " . mysqli_connect_error();
  } 

  $results = mysqli_query($conn, "SELECT * FROM mantenimientos");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Lista de mantenimientos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../styles/table.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="exit-btn-box">
      <a href="javascript: history.go(-1)" class="before-btn"><i class="fa fa-arrow-left"></i> Atrás</a>
      <a href="../logout.php" class="exitBtn"><i class="fa fa-close" style="color: #fff;"></i> Salir</a>
    </div>   
    
    <h1>Lista de mantenimientos</h1>
    <p id="noEntry"><!-- To be filled by code --></p> 
    <table id="manTable">
      <!-- To be filled by code -->
      <thead>
      <tr>
          <th>ID</th>
          <th>Equipo</th>
          <th>Responsable</th>
          <th>Ubicación</th>
          <th>Fecha de Mantenimiento</th>
          <th>Vigencia de mantenimiento</th>
          <th>Detalle de mantenimiento</th>
        </tr>
      </thead>
      <tbody>
        <?php 
            foreach ( $results as $r ) {
              echo '<tr>';
              foreach ( $r as $v ) {
                      echo '<td>'.$v.'</td>';
              }
          }
        ?>
      </tbody>
    </table>
    <script src="table2.js"></script>
  </body>
</html>
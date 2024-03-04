<?php 
  if(!isset($_SESSION)) {
    session_start();
  }

  if(!isset($_SESSION['ID'])) {
    header("Location: ../index.php");
    exit();
  }

  include('../db.php');
  $id = $_GET['id'];
  $conn = mysqli_connect($host, $user, $pass, $db);
  
  
  if (mysqli_connect_errno())
  {
    echo "Fallo la conexion a la base de datos: " . mysqli_connect_error();
  } else {
    echo "Te conectase bien";
  }
  
  $result = mysqli_query($conn, "SELECT * FROM mantenimientos WHERE ID=$id");
  $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Lista de mantenimientos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../styles/table.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  </head>
  <body>
    <div class="exit-btn-box">
      <a href="javascript: history.go(-1)" class="before-btn"><i class="fa fa-arrow-left"></i> Atrás</a>
      <a href="../logout.php" class="exitBtn"><i class="fa fa-close" style="color: #fff;"></i> Salir</a>
    </div>   
    <h1>Editar mantenimiento con ID: <?php echo $id?></h1> 
    <table id="calTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Equipo</th>
          <th>Responsable</th>
          <th>Ubicación</th>
          <th>Fecha de mantenimiento</th>
          <th>Vigencia de mantenimiento</th>
          <th>Detalle de mantenimiento</th>
          <th calss="Btns"></th>
        </tr>
      </thead>
      <form action="./edit.php?id=<?php echo $id;?>" method="post">
        <tbody>
          <!-- Se rellena formulario para editar -->
          <tr>
            <?php 
              echo "
                <th>
                  <input class='thform' type='number' name='ID' value='" . $row['ID'] . "'>
                </th>
              ";
              echo "<th><input class='thform' type='text' name='Equipo' value='" . $row['Equipo'] . "'></th>";
              echo "<th><input class='thform' type='email' name='Responsable' value='" . $row['Responsable'] . "'></th>";
              echo "<th><input class='thform' type='text' name='Ubicacion' value='" . $row['Ubicacion'] . "'></th>";
              echo "<th><input class='thform' type='date' name='Fecha_de_mantenimiento' value='" . $row['Fecha_de_mantenimiento'] . "'></th>";
              echo "<th><input class='thform' type='date' name='Vigencia_de_mantenimiento' value='" . $row['Vigencia_de_mantenimiento'] . "'></th>";
              echo "<th><input class='thform' type='text' name='Detalle_de_mantenimiento' value='" . $row['Detalle_de_mantenimiento'] . "'></th>";
              echo "<th><button type='submit'>EDITAR</button></th>";
            ?>
          </tr>
        </tbody>
      </form>
    </table>
    <?php
            // Mostrar mensaje de error si existe
            if (isset($errores['ID'])) {
              echo "<div class='errors'>{$errores['ID']}</div>";
            }
          ?>
    <script src="table.js"></script>
  </body>
</html>
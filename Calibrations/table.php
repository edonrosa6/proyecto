<?php 
  ini_set('display_errors', 1);
  ini_set('display_errors', E_ALL);
  error_reporting(E_ALL);
  if(!isset($_SESSION)) {
    session_start();
  }
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
  
  $results = mysqli_query($conn, "SELECT * FROM calibraciones");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Editor de calibraciones</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../styles/table.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <script>
      function confirmarEliminacion(id) {
        var confirmacion = window.confirm("¿Estás seguro de que quieres eliminar este registro?");

        if (confirmacion) {
            window.location.href = "./delete.php?id=" + id;
        }
      }
    </script>
  </head>
  <body>
    <div class="exit-btn-box">
      <a href="javascript: history.go(-1)" class="before-btn"><i class="fa fa-arrow-left"></i> Atrás</a>
      <a href="../logout.php" class="exitBtn"><i class="fa fa-close" style="color: #fff;"></i> Salir</a>
    </div>   

    <h1>Editor de calibraciones</h1> 
    <table id="calTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Equipo</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>SN</th>
          <th>Responsable</th>
          <th>Ubicación</th>
          <th>Fecha de calibración</th>
          <th>Vigencia de calibración</th>
          <th>Proveedor</th>
          <th calss="Btns">Editar/Borrar</th>
        </tr>
      </thead>
      <tbody>
        <!-- Rellenamos datos desde la base de datos -->
        <?php 
            foreach ( $results as $r ) {
              echo '<tr>';
              foreach ( $r as $v ) {
                      echo '<td style="word-break: break-all;">'.$v.'</td>';
              }
              echo '<td>';
              echo '<a href="./table-edit.php?id=' . $r['ID'] . '" style="margin-right: 10px;"><i class="fa fa-edit" style="font-size: 22px;"></i></a>';
              echo "<a href='#' onclick='confirmarEliminacion(" . $r["ID"] . ")'><i class='fa fa-trash' style='font-size: 22px;'></i></a>";
              echo '</td>';
              echo '</tr>';
          }
        ?>
   
      </tbody>
    </table>
    <form action="./create.php" method="post">
      <table>
        <thead>
          <tr>
            <th><input class="thform" required type="number" name="ID" placeholder="ID" id="ID" /></th>
            <th><input class="thform" required type="text" name="Equipo" placeholder="Equipo" id="Equipo" /></th>
            <th><input class="thform" required type="text" name="Marca" placeholder="Marca" id="Marca" /></th>
            <th><input class="thform" required type="text" name="Modelo" placeholder="Modelo" id="Modelo" /></th>
            <th><input class="thform" required type="text" name="SN" placeholder="SN" id="SN" /></th>
            <th><input class="thform" required type="email" name="Responsable" placeholder="Responsable" id="Responsable" /></th>
            <th><input class="thform" required type="text" name="Ubicacion" placeholder="Ubicación" id="Ubicacion" /></th>
            <th><input class="thform" required type="date" name="Fecha_de_calibracion" placeholder="Calibración" id="CalDate" /></th>
            <th><input class="thform" required type="date" name="Vigencia_de_calibracion" placeholder="Vigencia" id="Vigencia" /></th>
            <th><input class="thform" required type="text" name="Proveedor" placeholder="Proveedor" id="Proveedor" /></th>
            <th><button class="fa fa-plus" id="addBtn" onclick="" type="submit">Agregar</button></th>
          </tr>
          <thead>
      </table>
    </form>
    <?php
      // Mostrar mensaje de error si existe
      if (isset($errores['ID'])) {
        echo "<div class='errors'>{$errores['ID']}</div>";
      }
      if (isset($errores['SN'])) {
        echo "<div class='errors'>{$errores['SN']}</div>";
      }
    ?>
    <script src="table.js"></script>
  </body>
</html>
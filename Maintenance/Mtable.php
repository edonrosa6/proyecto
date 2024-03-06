<?php 
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

  $results = mysqli_query($conn, "SELECT * FROM mantenimientos");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Editor de mantenimientos</title>
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

    <h1>Editor de mantenimientos</h1> 
    <table id="manTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Equipo</th>
          <th>Responsable</th>
          <th>Ubicación</th>
          <th>Fecha de Mantenimiento</th>
          <th>Vigencia de mantenimiento</th>
          <th>Detalle de mantenimiento</th>
          <th calss="Btns">Editar/Borrar</th>
        </tr>
      </thead>
      <tbody>
      <!-- Datos desde la base de datos -->
      <?php 
        foreach ( $results as $r ) {
          echo '<tr>';
          foreach ( $r as $v ) {
            echo '<td style="word-break: break-all;">'.$v.'</td>';
          }
          echo '<td>';
          echo '<a href="./Mtable-edit.php?id=' . $r['ID'] . '" style="margin-right: 10px;"><i class="fa fa-edit"></i></a>';
          echo "<a href='#' onclick='confirmarEliminacion(" . $r["ID"] . ")'><i class='fa fa-trash'></i></a>";
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
            <th><input class="thform" required type="email" name="Responsable" placeholder="Responsable" id="Responsable" /></th>
            <th><input class="thform" required type="text" name="Ubicacion" placeholder="Ubicación" id="Ubicacion" /></th>
            <th><input class="thform" required type="date" name="Fecha_de_mantenimiento" placeholder="Mantenimiento" id="manDate" /></th>
            <th><input class="thform" required type="date" name="Vigencia_de_mantenimiento" placeholder="Vigencia" id="Vigencia" /></th>
            <th><input class="thform" type="text" name="Detalle_de_mantenimiento" placeholder="Detalle" id="Detalle" /></th>
            <th><button class="fa fa-plus" id="addBtn">  Agregar</button></th>
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
    <script src="Mtable.js"></script>
  </body>
</html>
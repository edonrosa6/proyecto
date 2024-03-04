<?php 
  if(!isset($_SESSION)) {
    session_start();
  }
  
  if(!isset($_SESSION['ID'])) {
    header("Location: ../index.php");
    exit();
  }

  if($_SESSION['tipo_usuario'] !== "admin") {
    header("Location: ../home.php");
    exit();
  }

  include('../db.php');
  $id = $_GET['id'];
  $conn = mysqli_connect($host, $user, $pass, $db);
  
  
  if (mysqli_connect_errno())
  {
    echo "Fallo la conexion a la base de datos: " . mysqli_connect_error();
  }
  
  $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE ID=$id");
  $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Editar Usuario: <?php echo $row['user']; ?></title>
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
    <h1>Editar Usuario: <?php echo $row['user'];?></h1> 
    <table id="calTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Tipo de Usuario</th>
          <th></th>
        </tr>
      </thead>
      <form action="./edit.php?id=<?php echo $id;?>" method="post">
        <tbody>
          <!-- Se rellena formulario para editar -->
          <tr>
            <?php 
              echo "<th><input class='thform' required type='number' name='ID' value='" . $row['ID'] . "'></th>";
              echo "<th><input class='thform' required type='text' name='user' value='" . $row['user'] . "'></th>";
              echo "
              <th>
                <select class='thform' required type='text' name='tipo_usuario' value='" . $row['tipo_usuario'] . "'>
                  <option value='admin'>Admin</option>
                  <option value='editor_calibraciones'>Editor Calibraciones</option>
                  <option value='auditor_calibraciones'>Auditor Calibraciones</option>
                  <option value='editor_mantenimientos'>Editor Mantenimientos</option>
                  <option value='auditor_mantenimientos'>Auditor Mantenimientos</option>
                </select>
              </th>";
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
      if (isset($errores['user'])) {
        echo "<div class='errors'>{$errores['user']}</div>";
      }
    ?>
    <script src="table.js"></script>
  </body>
</html>
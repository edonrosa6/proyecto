<?php 

  // Validamos sesion
  if(!isset($_SESSION)) {
    session_start();

  }

  if(!isset($_SESSION['ID'])) {
    header("Location: ../index.html");
    exit();
  }

  if($_SESSION['tipo_usuario'] !== "admin") {
    header("Location: ../home.php");
    exit();
  }

  include('../db.php');
  $conn = mysqli_connect($host, $user, $pass, $db);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="exit-btn-box">
      <a href="javascript: history.go(-1)" class="before-btn"><i class="fa fa-arrow-left"></i> Atrás</a>
      <a href="../logout.php" class="exitBtn"><i class="fa fa-close" style="color: #fff;"></i> Salir</a>
    </div>    
    <section class="login-page">
      <h5>Crear Usuario</h5>
      <form id="login-form" action="./create-user.php" method="post">
        <input
          class="inputs"
          type="number"
          required
          name="ID"
          value=""
          placeholder="ID"
        >
        <input
          class="inputs"
          type="text"
          required
          name="user"
          value=""
          placeholder="Usuario"
        />
        <input
          class="inputs"
          type="password"
          required
          name="password"
          value=""
          placeholder="Contraseña"
        />
        <select name="tipo_usuario">
          <option value="admin">Administrador</option>
          <option value="editor_calibraciones">Editor de Calibraciones</option>
          <option value="auditor_calibraciones">Auditor de Calibraciones</option>
          <option value="editor_mantenimientos">Auditor de Mantenimientos</option>
          <option value="auditor_mantenimientos">Editor de Mantenimientos</option>
        </select>
        <input class="buttons" type="submit" id="crear-registro" value="Crear Registro" />

        
        <?php
          // Mostrar mensaje de error si existe
          if (isset($errores['user'])) {
            echo "<div class='errors'>{$errores['user']}</div>";
          }
          if (isset($errores['ID'])) {
            echo "<div class='errors'>{$errores['ID']}</div>";
          }
        ?>
      </form>

    </section>
  </body>
</html>

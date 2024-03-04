<?php 
 session_start();

 if(!isset($_SESSION['ID'])) {
  header("Location: ./login.html");
  exit();
 }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="exit-btn-box">
      <div></div>
      <a href="./logout.php" class="exitBtn"><i class="fa fa-close" style="color: #fff;"></i> Salir</a>
    </div>   
    <section class="container">
      <div>
        <h1 class="bienvenida">Hola, Bienvenido <?php echo $_SESSION['user'] ?></h1>
      </div>

      <div class="flex-container" style="margin-top:30px;">

        <?php 
          if($_SESSION['tipo_usuario'] === "admin") {
            echo '
              <div class="box">
                <a href="./Users/create-form.php">Registrar usuarios</a>
              </div>
              <div class="box">
                <a href="./Users/users-list.php">Lista de usuarios</a>
              </div>
              <div class="box">
                <a href="./Calibrations/table2.php">Ver lista de calibraciones</a>
              </div>
              <div class="box">
                <a href="./Calibrations/table.php">Editar calibraciones</a>
              </div>
              <div class="box">
                <a href="./Maintenance/Mtable.php">Editar mantenimientos</a>
              </div>
              <div class="box">
                <a href="./Maintenance/Mtable2.php">Lista de mantenimientos</a>
              </div>
            ';
          } else if($_SESSION['tipo_usuario'] === "auditor_calibraciones") {
            echo '
              <div class="box">
                <a href="./Calibrations/table2.php">Ver lista de calibraciones</a>
              </div>
            ';
          } else if($_SESSION['tipo_usuario'] === "editor_calibraciones") {
            echo '
              <div class="box">
                <a href="./Calibrations/table.php">Editar calibraciones</a>
              </div>
            ';
          } else if($_SESSION['tipo_usuario'] === "auditor_mantenimientos") {
            echo '
              <div class="box">
                <a href="./Maintenance/Mtable.php">Ver lista de mantenimientos</a>
              </div>
            ';
          } else if($_SESSION['tipo_usuario'] === "editor_mantenimientos") {
            echo '
            <div class="box">
              <a href="./Maintenance/Mtable2.php">Editar mantenimientos</a>
            </div>
            ';
          } else {
            echo 'ERROR';
          }
        ?>
       

      </div>
    </section>
  </body>
</html>

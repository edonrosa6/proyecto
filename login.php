<?php 

  if(!isset($_SESSION)){
    session_start();
  }

  if($_SESSION) {
    // redirigir a pagina de home
    header("Location: ./home.php");
    exit();
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body id="body">
    <section class="login-page">
      <h5>Login</h5>
      <form id="login-form" action="./login-logic.php" autocomplete="off" method="post">
        <input
          class="inputs"
          type="text"
          name="user"
          required
          value=""
          placeholder="Usuario"
          autocomplete="off"
        />
        <input
          class="inputs"
          type="password"
          required
          name="password"
          value=""
          placeholder="Contraseña"
        />
        <input class="buttons" type="submit" id="ingresar" value="Ingresar" />

        <?php
          // Mostrar mensaje de errores si existen
          if (isset($errores['password'])) {
              echo "<div class='errors'>{$errores['password']}</div>";
          }
        ?>
      </form>
      <p>
        <a href="#">¿Olvidaste tu contraseña?</a>
      </p>
    </section>
  </body>
</html>

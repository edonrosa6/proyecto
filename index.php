<?php
  session_start();

  // Verifica si el usuario está autenticado
  if (isset($_SESSION['ID'])) {
    // Redirigimos al usuario autenticado
    header("Location: ./home.php");
    exit();
  } else {
    // El usuario no está autenticado, redirige al formulario para iniciar sesión
    header("Location: ./login.php");
    exit();
  }
?>
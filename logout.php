<?php
// Inicia la sesión
session_start();

// Limpia todas las variables de sesión
$_SESSION = array();

// Destruye la sesión
session_destroy();

// Redirige a la página de inicio de sesión
header("Location: ./login.php");
exit();
?>
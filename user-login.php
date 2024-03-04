<?php 
  session_start();

 if($_SESSION['ID']) {
  // Redirige a Home
  header("Location: ./home.php");
  exit();
 }
?>
<?php
 session_start();

 if(!isset($_SESSION['ID'])) {
   header("Location: ../index.php");
   exit();
 }


include('../db.php');
$conn = mysqli_connect($host, $user, $pass, $db);
$id = $_GET['id'];

$sql = "DELETE FROM calibraciones WHERE ID=$id";

if (mysqli_query($conn, $sql)) {
  header("Location: ./table.php");
  exit();
} else {
  echo "<script>alert('Ha ocurrido un error al eliminar el registro.');</script>";
}

mysqli_close($conn);
?>
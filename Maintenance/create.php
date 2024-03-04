<?php
  session_start();

  if(!isset($_SESSION['ID'])) {
    header("Location: ../login.php");
    exit();
  }

  include('../db.php');

  $conn = mysqli_connect($host, $user, $pass, $db) ;

  // Recuperar datos del formulario
  $ID = $_POST['ID'];
  $Equipo = $_POST['Equipo'];
  $Responsable = $_POST['Responsable'];
  $Ubicacion = $_POST['Ubicacion'];
  $Fecha_de_mantenimiento = $_POST['Fecha_de_mantenimiento'];
  $Vigencia_de_mantenimiento = $_POST['Vigencia_de_mantenimiento'];
  $Detalle_de_mantenimiento = $_POST['Detalle_de_mantenimiento'];

 // VALIDAR ERRORES
 $errores = array();  // crear array vacio de errores
 $select = mysqli_query($conn, "SELECT * FROM mantenimientos WHERE ID = '$ID'"); // Consultar si existe un usuario con mismo ID en base de datos

  if (mysqli_num_rows($select) > 0) {
    $errores['ID'] = "Ya existe un mismo ID en otro registro.";
    include("./Mtable.php");
    exit();
  } else {
    // Insertar datos en la base de datos
    $sql = "INSERT INTO 
              mantenimientos (ID, Equipo, Responsable, Ubicacion, Fecha_de_mantenimiento, Vigencia_de_mantenimiento, Detalle_de_mantenimiento) 
            VALUES ('$ID','$Equipo', '$Responsable', '$Ubicacion', '$Fecha_de_mantenimiento', '$Vigencia_de_mantenimiento', '$Detalle_de_mantenimiento')";

    if (mysqli_query($conn, $sql)) {
      header("Location: ./Mtable.php");
      exit();
    } else {
      echo "Error al registrar: " . mysqli_error($conn);
    }
  }

mysqli_close($conn);

?>
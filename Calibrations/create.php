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
  $Marca = $_POST['Marca'];
  $Modelo = $_POST['Modelo'];
  $Equipo = $_POST['Equipo'];
  $SN = $_POST['SN'];
  $Responsable = $_POST['Responsable'];
  $Ubicacion = $_POST['Ubicacion'];
  $Fecha_de_calibracion = $_POST['Fecha_de_calibracion'];
  $Vigencia_de_calibracion = $_POST['Vigencia_de_calibracion'];
  $Proveedor = $_POST['Proveedor'];

  // VALIDAR ERRORES
  $errores = array();  // crear array vacio de errores
  $ID_MUST_DIFF = mysqli_query($conn, "SELECT * FROM calibraciones WHERE ID = $ID"); // Consultar si existe un mismo ID en base de datos
  $SN_MUST_DIFF = mysqli_query($conn, "SELECT * FROM calibraciones WHERE SN = $SN"); // Consultar si existe un mismo SN en base de datos 


  if (mysqli_num_rows($ID_MUST_DIFF) > 0 || mysqli_num_rows($SN_MUST_DIFF) > 0) {

    if (mysqli_num_rows($ID_MUST_DIFF) > 0) {
      $errores['ID'] = "Ya existe un mismo ID en otro registro.";
    }

    if (mysqli_num_rows($SN_MUST_DIFF) > 0) {
      $errores['SN'] = "Ya existe un mismo SN en otro registro.";
    }
    
    include('./table.php');
    exit();
  } else {
    // Insertar datos en la base de datos
    $sql = "INSERT INTO 
              calibraciones (ID, Marca, Equipo, Modelo, SN, Responsable, Ubicacion, Fecha_de_calibracion, Vigencia_de_calibracion, Proveedor) 
            VALUES ('$ID', '$Marca', '$Equipo', '$Modelo', '$SN', '$Responsable', '$Ubicacion', '$Fecha_de_calibracion', '$Vigencia_de_calibracion', '$Proveedor')";

    if (mysqli_query($conn, $sql)) {
      header("Location: ./table.php");
      exit();
    } else {
      echo "Error al registrar: " . mysqli_error($conn);
    }
  }

mysqli_close($conn);

?>
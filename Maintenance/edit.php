<?php
  if(!isset($_SESSION)) {
    session_start();
  }

 if(!isset($_SESSION['ID'])) {
  header("Location: ../index.php");
  exit();
 }
 include('../db.php');

  // Conexión a la base de datos
  $conn = mysqli_connect($host, $user, $pass, $db);

  // Si conexión falla
  if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
  }

  // obtener ID de la URL
  $url_ID = $_GET['id'];

  // Consulta para obtener calibraciones por ID
  $select = mysqli_query($conn, "SELECT * FROM mantenimientos WHERE ID = $url_ID");

  if ($select) {
    $row = mysqli_fetch_assoc($select);
    $ID_EN_SESION = $row['ID'];
  } else {
    echo "Error en la consulta: " . mysqli_error($conn);
  }

  // Recuperar datos del formulario de edición
  $ID = $_POST['ID'];
  $Equipo = $_POST['Equipo'];
  $Responsable = $_POST['Responsable'];
  $Ubicacion = $_POST['Ubicacion'];
  $Fecha_de_mantenimiento = $_POST['Fecha_de_mantenimiento'];
  $Vigencia_de_mantenimiento = $_POST['Vigencia_de_mantenimiento'];
  $Detalle_de_mantenimiento = $_POST['Detalle_de_mantenimiento'];

  // VALIDAR ERRORES
  $errores = array();  // crear array vacio de errores
  $ID_MUST_DIFF = mysqli_query($conn, "SELECT * FROM mantenimientos WHERE ID != $ID_EN_SESION AND ID = $ID"); // Consultar si existe un usuario diferente al ID en edición

  if (mysqli_num_rows($ID_MUST_DIFF) > 0) {
    $errores['ID'] = "Ya existe un mismo ID en otro registro.";
    include("./Mtable-edit.php");
    exit();
  } else {
  
    // ACTUALIZAR el registro en la base de datos
    $sql = "UPDATE 
              mantenimientos 
            SET 
              ID='$ID', Equipo='$Equipo', Responsable='$Responsable', 
              Ubicacion='$Ubicacion', Fecha_de_mantenimiento='$Fecha_de_mantenimiento', Vigencia_de_mantenimiento='$Vigencia_de_mantenimiento', Detalle_de_mantenimiento='$Detalle_de_mantenimiento'
            WHERE 
              ID=$ID_EN_SESION";

    if (mysqli_query($conn, $sql)) {
      header("Location: ./Mtable.php");
    } else {
      echo "Error al actualizar el registro: " . mysqli_error($conn);
    }
  }

  mysqli_close($conn);
?>
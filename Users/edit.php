<?php
  if(!isset($_SESSION)) {
    session_start();
  }

 if(!isset($_SESSION['ID'])) {
    header("Location: ../login.php");
    exit();
 }

  include('../db.php');

  // Conexión a la base de datos
  $conn = mysqli_connect($host, $user, $pass, $db);

  if (!$conn) {
      die("Conexión fallida: " . mysqli_connect_error());
  }

  // obtener ID de la URL
  $url_ID = $_GET['id'];

  // Consulta para obtener calibraciones por ID
  $select = mysqli_query($conn, "SELECT * FROM usuarios WHERE ID = $url_ID");
  
  if ($select) {
    $row = mysqli_fetch_assoc($select);
    $ID_EN_SESION = $row['ID'];
    $USER_EN_SESION = $row['user'];
  } else {
    echo "Error en la consulta: " . mysqli_error($conn);
  }

  // RECOLECTAR DATOS DEL FORM
  $ID = $_POST['ID'];
  $user = $_POST['user'];
  $tipo_usuario = $_POST['tipo_usuario'];


  // VALIDAR ERRORES
  $errores = array();  // crear array vacio de errores
  $select = "SELECT * FROM usuarios WHERE ID=$url_ID";
  $ID_MUST_DIFF = mysqli_query(
                        $conn, 
                        "SELECT * FROM usuarios 
                        WHERE ID != $ID_EN_SESION
                        AND ID = $ID"); // Consultar si existe un ID diferente al ID en edición

  $USER_MUST_DIFF = mysqli_query(
                                $conn, 
                                "SELECT user FROM usuarios 
                                WHERE user != '$USER_EN_SESION'
                                AND user = '$user'");

  if (mysqli_num_rows($ID_MUST_DIFF) > 0) {
    $errores['ID'] = 'Ya existe un mismo ID.';
  }

  if (mysqli_num_rows($USER_MUST_DIFF) > 0) {
    $errores['user'] = 'Ya existe un usuario con este nombre.';
  }

  if (!empty($errores)) {
    include('./users-edit.php'); 
  } else {
    // Actualizar el registro en la base de datos
    $sql = "UPDATE 
        usuarios 
      SET 
        ID='$ID', tipo_usuario='$tipo_usuario', user='$user'
      WHERE 
        ID=$ID_EN_SESION";

    if (mysqli_query($conn, $sql)) {
      header("Location: ./users-list.php");
    } else {
      echo "Error al actualizar el registro: " . mysqli_error($conn);
    }
  }
   
 
  

  mysqli_close($conn);
?>
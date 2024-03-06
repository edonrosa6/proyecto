<?php
  session_start();

  if($_SESSION['tipo_usuario'] !== "admin") {
    header("Location: ../home.php");
    exit();
  }

  // Revisar si el usuario esta logeado
  if(!isset($_SESSION['ID'])) {
    header("Location: ../index.php");
    exit();
  }

  include('../db.php');
  $conn = mysqli_connect($host, $user, $pass, $db);

  // RECOLECTAR DATOS DEL FORM
  $ID = $_POST['ID'];
  $user = $_POST['user'];
  $password = $_POST['password'];
  $tipo_usuario = $_POST['tipo_usuario'];

  // VALIDACIONES
  // Inicializar el array de errores
  $errores = array();
  $result = mysqli_query($conn, "SELECT user FROM usuarios WHERE user='$user'");
  $ID_MUST_DIFF = mysqli_query($conn, "SELECT ID from usuarios WHERE ID=$ID");

  if (mysqli_num_rows($ID_MUST_DIFF) > 0) {
    $errores['ID'] = 'Ya existe un mismo ID. Cámbialo.';
  }
  if (mysqli_num_rows($result) > 0) {
    $errores['user'] = 'Ya existe un usuario con este nombre.';
  }

  if (empty($errores)) {

    // Crear usuario en la base de datos
    $sql = "INSERT INTO 
              usuarios (ID, user, password, tipo_usuario) 
            VALUES ('$ID', '$user', '$password', '$tipo_usuario')";


    if (mysqli_query($conn, $sql)) {
      header("Location: ./users-list.php");
      exit();
    } else {
      echo "Error al registrar: " . mysqli_error($conn);
    }

    echo "Registro exitoso!";
  } else {
    // Si hay errores, volver al formulario y mostrar mensajes de error
    include('./create-form.php'); 
  }

  mysqli_close($conn);
?>
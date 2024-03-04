<?php
  if(!isset($_SESSION)) {
    session_start();
  }

 if(!isset($_SESSION['ID'])) {
   header("Location: ../login.php");
   exit();
 }
 include('../db.php');

  // Conexión a la base de datos (de nuevo)
  $conn = mysqli_connect($host, $user, $pass, $db);

  if (!$conn) {
      die("Conexión fallida: " . mysqli_connect_error());
  }

  // obtener ID de la URL
  $url_ID = $_GET['id'];

  // Consulta para obtener calibraciones por ID
  $select = mysqli_query($conn, "SELECT * FROM calibraciones WHERE ID = $url_ID");
  
  if ($select) {
    $row = mysqli_fetch_assoc($select);
    $ID_EN_SESION = $row['ID'];
    $SN_EN_SESION = $row['SN'];
  } else {
    echo "Error en la consulta: " . mysqli_error($conn);
  }

  // Recuperar datos del formulario de edición
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
  $ID_MUST_DIFF = mysqli_query(
                              $conn, 
                              "SELECT * FROM calibraciones
                               WHERE ID != $ID_EN_SESION
                               AND ID = $ID"); // Consultar si existe un ID diferente al ID en edición
  
  $SN_MUST_DIFF = mysqli_query(
                              $conn, 
                              "SELECT * FROM calibraciones 
                              WHERE SN != '$SN_EN_SESION' 
                              AND SN = '$SN'"); // Consultar si existe un SN diferente al SN en edición

    if (mysqli_num_rows($ID_MUST_DIFF) > 0 || mysqli_num_rows($SN_MUST_DIFF) > 0) {

      if (mysqli_num_rows($ID_MUST_DIFF) > 0) {
        $errores['ID'] = "Ya existe un mismo ID en otro registro.";
      }

      if (mysqli_num_rows($SN_MUST_DIFF) > 0) {
        $errores['SN'] = "Ya existe un mismo SN en otro registro.";
      }
    
    include('./table-edit.php');
    exit();
   } else {
    // Actualizar el registro en la base de datos
    $sql = "UPDATE 
              calibraciones 
            SET 
              ID='$ID', Modelo='$Modelo', Marca='$Marca', Equipo='$Equipo', Responsable='$Responsable', SN='$SN',
              Ubicacion='$Ubicacion', Fecha_de_calibracion='$Fecha_de_calibracion', Vigencia_de_calibracion='$Vigencia_de_calibracion', Proveedor='$Proveedor'
            WHERE 
              ID=$ID_EN_SESION";

    if (mysqli_query($conn, $sql)) {
      echo "<script>alert('Se ha editado correctamente');</script>";
      header("Location: ./table.php");
    } else {
      echo "Error al actualizar el registro: " . mysqli_error($conn);
    }
  }

  mysqli_close($conn);
?>''
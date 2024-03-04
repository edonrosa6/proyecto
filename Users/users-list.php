
<?php 
  if(!isset($_SESSION)) {
    session_start();
  }

  if(!isset($_SESSION['ID'])) {
    header("Location: ../index.php");
    exit();
  }
  
  if($_SESSION['tipo_usuario'] !== "admin") {
    header("Location: ../home.php");
    exit();
  }

  include('../db.php');
  $conn = mysqli_connect($host, $user, $pass, $db);
  
  
  if (mysqli_connect_errno())
  {
      echo "Fallo la conexion a la base de datos: " . mysqli_connect_error();
  }
  $results = mysqli_query($conn, "SELECT ID, user, tipo_usuario FROM usuarios");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Lista de usuarios</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/table.css">

    <script>
      function confirmarEliminacion(id) {
        var confirmacion = window.confirm("¿Estás seguro de que quieres eliminar este registro?");

        if (confirmacion) {
          window.location.href = "delete.php?id=" + id;
        }
      }
    </script>
  </head>
  <body>
    <div class="exit-btn-box">
      <a href="javascript: history.go(-1)" class="before-btn"><i class="fa fa-arrow-left"></i> Atrás</a>
      <a href="../logout.php" class="exitBtn"><i class="fa fa-close" style="color: #fff;"></i> Salir</a>
    </div>   
    <h1>Lista de Usuarios</h1> 
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Tipo de Usuario</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
            foreach ( $results as $r ) {
              echo '<tr>';
              foreach ( $r as $v ) {
                      echo '<td>'.$v.'</td>';
              }
              echo '<td>';
              echo '<a href="./users-edit.php?id=' . $r['ID'] . '" style="margin-right: 10px;"><i class="fa fa-edit"></i></a>';
              echo "<a href='#' onclick='confirmarEliminacion(" . $r["ID"] . ")'><i class='fa fa-trash'></i></a>";
              echo '</td>';
              echo '</tr>';
          }
        ?>
      </tbody>
    </table>
    <script src="table.js"></script>
  </body>
</html>
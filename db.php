<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "proyecto";

$bd = mysqli_connect($host, $user, $pass, $db) ;


if (mysqli_connect_errno())
{
    echo "Fallo la conexión a la base de datos: " . mysqli_connect_error();
}

mysqli_close($bd);
?>
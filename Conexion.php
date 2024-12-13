<?php
$host = "localhost";
$User = "root";
$pass = "";
$db = "iniciosesiondb";

$conexion = mysqli_connect($host, $User, $pass, $db);


if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>



<?php
session_start();
include('Conexion.php'); // Conexión a la base de datos

if (!isset($_SESSION['id_usuario'])) {
    echo "No se ha identificado al usuario.";
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$placa = $_POST['placa'];
$color = $_POST['color'];
$anio = $_POST['anio']; 

$sql = "INSERT INTO vehiculos (marca, modelo, placa, color, anio, id_usuario) VALUES ('$marca', '$modelo', '$placa', '$color', '$anio', '$id_usuario')";

if (mysqli_query($conexion, $sql)) {
    echo "Vehículo agregado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}

mysqli_close($conexion);
header("Location: Cliente.php"); // Redirige a la página principal
exit();
?>

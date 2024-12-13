<?php
session_start();
include('Conexion.php'); // Conexión a la base de datos

// Validar si los datos necesarios están presentes
if (!isset($_SESSION['id_usuario']) || !isset($_POST['campo']) || !isset($_POST['nuevo_valor'])) {
    header("Location: Cliente.php?success=0");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$campo = $_POST['campo'];
$nuevo_valor = $_POST['nuevo_valor'];

// Validar que el campo a modificar sea permitido
$campos_validos = ['nombre', 'apellidos', 'correo', 'telefono', 'direccion', 'fecha_nacimiento'];
if (!in_array($campo, $campos_validos)) {
    header("Location: Cliente.php?success=0");
    exit();
}

// Preparar y ejecutar la consulta
$query = $conexion->prepare("UPDATE usuarios SET $campo = ? WHERE id_usuario = ?");
$query->bind_param("si", $nuevo_valor, $id_usuario);

if ($query->execute()) {
    header("Location: Cliente.php?success=1");
} else {
    header("Location: Cliente.php?success=0");
}

// Cerrar conexiones
$query->close();
$conexion->close();
exit();
?>

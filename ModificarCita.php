<?php
session_start();
include('Conexion.php'); // Conexión a la base de datos


if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cita = $_POST['id_cita'];

    
    $queryActualizar = $conexion->prepare("UPDATE solicitarcita SET estatus = 'completada' WHERE id_cita = ?");
    
    if (!$queryActualizar) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $queryActualizar->bind_param("i", $id_cita);

    if ($queryActualizar->execute()) {
        header("Location: Mecanico.php?success=1");
        exit();
    } else {
        header("Location:   Mecanico.php?error=1");
        exit();
    }
}
?>

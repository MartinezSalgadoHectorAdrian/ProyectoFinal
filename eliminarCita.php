<?php
session_start();
include('Conexion.php'); // Conexión a la base de datos

// Verifica si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

// Verifica si se ha enviado la ID de la cita
if (isset($_POST['id_cita'])) {
    $id_cita = $_POST['id_cita'];

    // Preparar y ejecutar la consulta para eliminar la cita
    $queryEliminarCita = $conexion->prepare("DELETE FROM solicitarcita WHERE id_cita = ? AND id_usuario = ?");
    $queryEliminarCita->bind_param("ii", $id_cita, $_SESSION['id_usuario']);
    $queryEliminarCita->execute();

    if ($queryEliminarCita->affected_rows > 0) {
        // Si se eliminó la cita, redirige con mensaje de éxito
        header("Location: Cliente.php?success=1");
    } else {
        // Si no se eliminó la cita, redirige con mensaje de error
        header("Location: Cliente.php?error=1");
    }

    $queryEliminarCita->close();
} else {
    // Si no se envió la ID de la cita, redirige al login o página de error
    header("Location: Login.php");
    exit();
}
?>

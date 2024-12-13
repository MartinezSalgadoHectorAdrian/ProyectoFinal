<?php
session_start();

// Verificar si hay un token en la URL
if (!isset($_GET['token'])) {
    header("Location: Login.php");
    exit();
}

$token = $_GET['token'];

// Conectar a la base de datos
include("conexion.php");

// Verificar si el token existe en la base de datos
$sql = "SELECT * FROM Usuarios WHERE reset_token = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, 's', $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nueva_contrasena = $_POST['nueva_contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];

        // Validar las contraseñas
        if ($nueva_contrasena != $confirmar_contrasena) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
        } else {
            // Actualizar la contraseña en la base de datos
            $nueva_contrasena_hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
            $sql_update = "UPDATE Usuarios SET contrasena = ?, reset_token = NULL WHERE reset_token = ?";
            $stmt_update = mysqli_prepare($conexion, $sql_update);
            mysqli_stmt_bind_param($stmt_update, 'ss', $nueva_contrasena_hash, $token);
            mysqli_stmt_execute($stmt_update);

            $_SESSION['success'] = "Tu contraseña ha sido actualizada.";
            header("Location: Login.php");
            exit();
        }
    }
} else {
    $_SESSION['error'] = "El token de restablecimiento no es válido.";
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
</head>
<body>
    <h1>Restablecer Contraseña</h1>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<p class='success'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    ?>
    <form action="restablecer_contrasena.php?token=<?= $token ?>" method="POST">
        <label for="nueva_contrasena">Nueva Contraseña</label>
        <input type="password" id="nueva_contrasena" name="nueva_contrasena" required>

        <label for="confirmar_contrasena">Confirmar Contraseña</label>
        <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required>

        <button type="submit">Restablecer Contraseña</button>
    </form>
</body>
</html>

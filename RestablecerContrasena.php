<?php
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectar a la base de datos
    include("conexion.php");

    // Validar y limpiar el correo electrónico
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);

    // Verificar si el correo está registrado
    $sql = "SELECT * FROM Usuarios WHERE correo = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, 's', $correo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Generar un token único para el restablecimiento de la contraseña
        $token = bin2hex(random_bytes(50));

        // Guardar el token en la base de datos (puedes crear una columna 'reset_token' en la tabla Usuarios)
        $sql_update = "UPDATE Usuarios SET reset_token = ? WHERE correo = ?";
        $stmt_update = mysqli_prepare($conexion, $sql_update);
        mysqli_stmt_bind_param($stmt_update, 'ss', $token, $correo);
        mysqli_stmt_execute($stmt_update);

        // Enviar un correo con el enlace de restablecimiento
        $restablecer_url = "http://tusitio.com/restablecer_contrasena.php?token=" . $token;
        $asunto = "Restablecimiento de contraseña";
        $mensaje = "Hemos recibido una solicitud para restablecer tu contraseña. Haz clic en el siguiente enlace para restablecerla:\n\n" . $restablecer_url;
        $headers = "From: no-reply@tusitio.com\r\n";
        mail($correo, $asunto, $mensaje, $headers);

        $_SESSION['success'] = "Hemos enviado un enlace para restablecer tu contraseña a tu correo.";
        header("Location: Login.php");
        exit();
    } else {
        $_SESSION['error'] = "El correo ingresado no está registrado.";
        header("Location: RestablecerContrasena.php");
        exit();
    }
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
    <form action="RestablecerContrasena.php" method="POST">
        <label for="correo">Correo Electrónico</label>
        <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required>
        <button type="submit">Enviar enlace de restablecimiento</button>
    </form>
</body>
</html>

<?php
session_start();
include('Conexion.php'); // Conexión a la base de datos

if (isset($_POST['crearCuenta'])) {
    function validate($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $nombre = validate($_POST['nombre']);
    $apellidos = validate($_POST['apellidos']);
    $correo = validate($_POST['correo']);
    $telefono = validate($_POST['telefono']);
    $direccion = validate($_POST['direccion']);
    $fecha_nacimiento = validate($_POST['fecha_nacimiento']);
    $contrasena = validate($_POST['contrasena']); 

    // Validar los campos requeridos
    if (empty($nombre)) {
        $_SESSION['error'] = "El nombre es requerido.";
    } elseif (empty($apellidos)) {
        $_SESSION['error'] = "Los apellidos son requeridos.";
    } elseif (empty($correo)) {
        $_SESSION['error'] = "El correo es requerido.";
    } elseif (empty($contrasena)) {
        $_SESSION['error'] = "La contraseña es requerida.";
    } else {
        // Verificar si el correo ya existe
        $sql = "SELECT * FROM Usuarios WHERE correo = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, 's', $correo);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "El correo ya está registrado.";
        } else {
            // Ciframos la contraseña antes de almacenarla
            $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

            // Insertar usuario en la base de datos
            $sql = "INSERT INTO Usuarios (nombre, apellidos, correo, telefono, direccion, fecha_nacimiento, contrasena, rol) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 'Cliente')";
            $stmt = mysqli_prepare($conexion, $sql);
            mysqli_stmt_bind_param($stmt, 'sssssss', $nombre, $apellidos, $correo, $telefono, $direccion, $fecha_nacimiento, $contrasenaHash);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "Cuenta creada exitosamente.";
            } else {
                $_SESSION['error'] = "Error al crear la cuenta. Inténtalo nuevamente.";
            }
        }
    }

    // Redirigir a la misma página para mostrar mensajes
    header("Location: CrearCuenta.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <h2>Crear Cuenta</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p class="error"><?= $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php elseif (isset($_SESSION['success'])): ?>
        <p class="success"><?= $_SESSION['success']; ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="CrearCuenta.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required><br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required><br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" placeholder="Teléfono"><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="Direccion" name="Direccion"><br><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required><br><br>

        <button type="submit" name="crearCuenta">Crear Cuenta</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="Login.php">Iniciar sesión</a></p>
</body>
</html>

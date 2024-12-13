<?php
session_start();
if (isset($_SESSION['Nombre'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="Style.css" />

</head>
<body>
    
    <form action="IniciarSesion.php" method="POST">
        <!-- Botón para regresar a index.php -->
        <a href="index.php" class="close-btn">X</a>
        
        <h1>INICIAR SESIÓN</h1>
        <?php
        if (isset($_GET['error'])) {
            echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>
        <label for="Correo">Correo Electrónico</label>
        <input type="email" id="Correo" name="correo" placeholder="Correo electrónico" required>
        
        <label for="Clave">Contraseña</label>
        <input type="password" id="Clave" name="contrasena" placeholder="Contraseña" required>
        
        <button type="submit">Iniciar Sesión</button>
        <a href="CrearCuenta.php">Crear Cuenta</a>
        <a style="color: #111;" href="RestablecerContrasena.php">¿Olvidaste la contraseña?</a>

    </form>
</body>
</html>


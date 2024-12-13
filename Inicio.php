<?php
session_start();


if (!isset($_SESSION['Usuario'])) {
    header("Location: Index.php");
    exit();
}


$usuario = $_SESSION['Usuario'];
$nombreCompleto = $_SESSION['Nombre_Completo'];
$idUsuario = $_SESSION['Id'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Inicio</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Bienvenido, <?php echo htmlspecialchars($nombreCompleto); ?>!</h1>

        <div class="mt-4">
            <h3>Información del Usuario</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nombre Completo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($idUsuario); ?></td>
                        <td><?php echo htmlspecialchars($usuario); ?></td>
                        <td><?php echo htmlspecialchars($nombreCompleto); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <a href="CerrarSesion.php" class="btn btn-danger mt-3">Cerrar Sesión</a>
    </div>
</body>

</html>

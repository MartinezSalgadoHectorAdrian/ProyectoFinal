<?php
session_start();
include('Conexion.php'); // Conexión a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

// Consultar todas las citas
$queryCitas = $conexion->prepare("SELECT id_cita, nombre, vehiculo, descripcion, fecha, hora, servicio, estatus, id_usuario FROM solicitarcita");
$queryCitas->execute();
$resultCitas = $queryCitas->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Todas las Citas</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
    <header class="top-header">
        <div class="logo">AutoTorque</div>
    </header>
  
    <section id="showcase" class="showcase">
        <header class="main-header">
            <div class="container">
                <nav>
                    <ul class="nav-links">
                        <li><a href="Index.php">Inicio</a></li>
                    </ul>
                </nav>
            </div>
        </header>
    </section>

    <h2>Ver Todas las Citas</h2>

    
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div id="message" class="message success">
        ¡Estado de la cita actualizado correctamente!
    </div>
<?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
    <div id="message" class="message error">
        Hubo un error al actualizar el estado de la cita.
    </div>
<?php endif; ?>

    <table>
        <tr>
            <th>ID Cita</th>
            <th>Nombre</th>
            <th>Vehículo</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Servicio</th>
            <th>Status</th>
            <th>Acción</th>
        </tr>
        <?php while ($cita = $resultCitas->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($cita['id_cita']); ?></td>
            <td><?php echo htmlspecialchars($cita['nombre']); ?></td>
            <td><?php echo htmlspecialchars($cita['vehiculo']); ?></td>
            <td><?php echo htmlspecialchars($cita['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
            <td><?php echo htmlspecialchars($cita['hora']); ?></td>
            <td><?php echo htmlspecialchars($cita['servicio']); ?></td>
            <td><?php echo htmlspecialchars($cita['estatus']); ?></td>
            <td>
                <form action="ModificarCita.php" method="POST" style="display: inline;">
                    <input type="hidden" name="id_cita" value="<?php echo $cita['id_cita']; ?>">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que quieres actualizar esta cita?')">Marcar como Completada</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

    <script>
        setTimeout(() => {
            const message = document.getElementById('message');
            if (message) {
                message.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>

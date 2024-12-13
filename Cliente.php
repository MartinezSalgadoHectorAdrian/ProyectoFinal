<?php
session_start();
include('Conexion.php'); // Conexión a la base de datos

// Verificar si la sesión tiene el id_usuario
if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

// Obtener el id_usuario de la sesión
$id_usuario = $_SESSION['id_usuario'];

// Consultar datos del usuario
$queryUsuario = $conexion->prepare("SELECT nombre, apellidos, correo, telefono, direccion, fecha_nacimiento FROM usuarios WHERE id_usuario = ?");
$queryUsuario->bind_param("i", $id_usuario);
$queryUsuario->execute();
$resultUsuario = $queryUsuario->get_result();

// Consultar datos de los vehículos
$queryVehiculos = $conexion->prepare("SELECT marca, modelo, placa, color, anio FROM vehiculos WHERE id_usuario = ?");
$queryVehiculos->bind_param("i", $id_usuario);
$queryVehiculos->execute();
$resultVehiculos = $queryVehiculos->get_result();

// Verificar si el valor de id_usuario existe en la tabla usuarios
$queryUsuarioExistente = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE id_usuario = ?");
$queryUsuarioExistente->bind_param("i", $id_usuario);
$queryUsuarioExistente->execute();
$resultUsuarioExistente = $queryUsuarioExistente->get_result();

if ($resultUsuarioExistente->num_rows > 0) {
    // El usuario existe, puedes proceder con la consulta de citas
    $queryCitas = $conexion->prepare("SELECT id_cita, nombre, vehiculo, descripcion, fecha, hora, servicio, estatus FROM solicitarcita WHERE id_usuario = ?");
    $queryCitas->bind_param("i", $id_usuario);
    $queryCitas->execute();
    $resultCitas = $queryCitas->get_result();
} else {
    echo "El usuario no existe en la base de datos.";
    exit();
}
?>
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div id="message" class="message success">
        ¡Cita eliminada correctamente!
    </div>
<?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
    <div id="message" class="message error">
        Hubo un error al eliminar la cita.
    </div>
<?php endif; ?>
<!DOCTYPE html>
<html>
<head>
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
    <title>Datos del Usuario y Vehículo</title>
    <link rel="stylesheet" type="text/css" href="Style.css">

</head>
<body>
<!-- Menú lateral -->
<div class="sidebar">
    <h3 style="text-align: center; margin: 0; padding: 10px;">Menú</h3>
    <a href="#" onclick="showSection('usuarios')">Ver Usuarios</a>
    <a href="#" onclick="showSection('vehiculos')">Ver Vehículos</a>
    <a href="#" onclick="showSection('citas')">Ver Citas</a>
</div>

<!-- Contenido principal -->
<div class="main-content">
    <h2 id="title">Datos del Usuario</h2>

    <!-- Mensaje de éxito -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div id="message" class="message success">
        ¡Campo editado correctamente!
    </div>
<?php elseif (isset($_GET['success']) && $_GET['success'] == 0): ?>
    <div id="message" class="message error">
        Hubo un error al editar el campo.
    </div>
<?php endif; ?>

    <!-- Tabla de usuarios -->
    <div id="usuarios" class="section">
        <table>
            <tr>
                <th>Campo</th>
                <th>Valor</th>
                <th>Editar</th>
            </tr>
            <?php 
            while ($usuario = $resultUsuario->fetch_assoc()) { 
                foreach ($usuario as $campo => $valor) { ?>
            <tr>
                <td><?php echo ucfirst($campo); ?></td>
                <td><?php echo htmlspecialchars($valor); ?></td>
                <td>
                    <form action="modificarUsuario.php" method="POST" style="display: inline;">
                        <input type="hidden" name="campo" value="<?php echo $campo; ?>">
                        <input type="text" name="nuevo_valor" value="<?php echo htmlspecialchars($valor); ?>" required>
                        <button type="submit">Guardar</button>
                    </form>
                </td>
            </tr>
            <?php } 
            } ?>
        </table>
    </div>

    <!-- Tabla de vehículos -->
    <div id="vehiculos" class="section hidden">
        <table>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Placa</th>
                <th>Color</th>
                <th>Año</th>
            </tr>
            <?php while ($vehiculo = $resultVehiculos->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($vehiculo['marca']); ?></td>
                <td><?php echo htmlspecialchars($vehiculo['modelo']); ?></td>
                <td><?php echo htmlspecialchars($vehiculo['placa']); ?></td>
                <td><?php echo htmlspecialchars($vehiculo['color']); ?></td>
                <td><?php echo htmlspecialchars($vehiculo['anio']); ?></td>
            </tr>
            <?php } ?>
        </table>

        <!-- Botón y formulario para agregar vehículo -->
        <button onclick="document.getElementById('formVehiculo').style.display='block'">Agregar Vehículo</button>
        <div id="formVehiculo" style="display:none;">
            <h2>Agregar Vehículo</h2>
            <form action="agregarVehiculo.php" method="POST">
                <input type="text" name="marca" placeholder="Marca" required>
                <input type="text" name="modelo" placeholder="Modelo" required>
                <input type="text" name="placa" placeholder="Placa" required>
                <input type="text" name="color" placeholder="Color" required>
                <input type="number" name="anio" placeholder="Año" required>
                <button type="submit">Agregar</button>
            </form>
        </div>
    </div>
</div>

<div id="citas" class="section hidden">
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
                <form action="eliminarCita.php" method="POST" style="display: inline;">
                    <input type="hidden" name="id_cita" value="<?php echo $cita['id_cita']; ?>">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta cita?')">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<script>
function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(section => {
        section.classList.add('hidden');
    });
    document.getElementById(sectionId).classList.remove('hidden');
    document.getElementById('title').innerText = 
        sectionId === 'usuarios' ? 'Datos del Usuario' : 
        sectionId === 'vehiculos' ? 'Información del Vehículo' :
        'Mis Citas';
}

setTimeout(() => {
    const message = document.getElementById('message');
    if (message) {
        message.style.display = 'none';
    }
}, 5000);
</script>

</body>
</html>







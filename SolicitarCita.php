<?php
session_start(); 


if (!isset($_SESSION['id_usuario'])) { 
  header("Location: Login.php");
  exit();
}

include("conexion.php"); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$id_usuario = $_SESSION['id_usuario'];


$sqlVehiculos = "SELECT id_vehiculo, marca, modelo FROM vehiculos WHERE id_usuario = ?";
$stmtVehiculos = mysqli_prepare($conexion, $sqlVehiculos);
mysqli_stmt_bind_param($stmtVehiculos, 'i', $id_usuario);
mysqli_stmt_execute($stmtVehiculos);
$resultVehiculos = mysqli_stmt_get_result($stmtVehiculos);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $campos_obligatorios = ['nombre', 'vehiculo', 'descripcion', 'fecha', 'hora', 'servicio'];
    foreach ($campos_obligatorios as $campo) {
        if (empty($_POST[$campo])) {
            $_SESSION['error'] = "Error: El campo '$campo' es obligatorio.";
            header("Location: SolicitarCita.php");
            exit();
        }
    }

    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $vehiculo = htmlspecialchars(trim($_POST['vehiculo']));
    $descripcion = htmlspecialchars(trim($_POST['descripcion']));
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $servicio = $_POST['servicio'];

    // Verificación del servicio
    $servicios_permitidos = ['Mecanica', 'Hojalateria y pintura', 'Electricidad', 'Escaner', 'Estetica', 'Venta y Montaje de llantas'];
    if (!in_array($servicio, $servicios_permitidos)) {
        $_SESSION['error'] = "Error: El servicio seleccionado no es válido.";
        header("Location: SolicitarCita.php");
        exit();
    }

    $id_usuario = $_SESSION['id_usuario'];

  
    $sql = "INSERT INTO solicitarcita (nombre, vehiculo, descripcion, fecha, hora, servicio, id_usuario, estatus) VALUES (?, ?, ?, ?, ?, ?, ?, 'reservada')";

    $stmt = mysqli_prepare($conexion, $sql);

    if (!$stmt) {
        $_SESSION['error'] = "Error al preparar la consulta: " . mysqli_error($conexion);
        header("Location: SolicitarCita.php");
        exit();
    }

    
    mysqli_stmt_bind_param($stmt, "ssssssi", $nombre, $vehiculo, $descripcion, $fecha, $hora, $servicio, $id_usuario);

   
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Cita creada exitosamente.";
    } else {
        $_SESSION['error'] = "Error al registrar la cita: " . mysqli_error($conexion);
    }

   
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);

    
    header("Location: SolicitarCita.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Solicitar Cita - Taller Mecánico</title>
    <link rel="stylesheet" href="SolicitarCita.css" />
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

    <section class="appointment-form">
        <h2>Registra tu Cita</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?= $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php elseif (isset($_SESSION['success'])): ?>
            <p class="success"><?= $_SESSION['success']; ?></p>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form action="SolicitarCita.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre completo" required />

            <label for="vehiculo">Vehículo:</label>
            <select id="vehiculo" name="vehiculo" required>
                <?php while ($vehiculo = $resultVehiculos->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($vehiculo['marca']) . ' ' . htmlspecialchars($vehiculo['modelo']); ?>">
                        <?php echo htmlspecialchars($vehiculo['marca']) . ' ' . htmlspecialchars($vehiculo['modelo']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" required />

            <label for="fecha">Fecha de la Cita:</label>
            <input type="date" id="fecha" name="fecha" required />

            <label for="hora">Hora de la Cita:</label>
            <input type="time" id="hora" name="hora" required />

            <label for="servicio">Servicio Solicitado:</label>
            <select id="servicio" name="servicio">
                <option value="Mecanica">Mecanica</option>
                <option value="Hojalateria y pintura">Hojalateria y pintura</option>
                <option value="Electricidad">Electricidad</option>
                <option value="Escaner">Escaner</option>
                <option value="Estetica">Estetica</option>
                <option value="Venta y Montaje de llantas">Venta y Montaje de llantas</option>
            </select>

            <button type="submit" class="btn-primary">Enviar</button>
        </form>
    </section>

    <footer>
      <div class="container">
        <p>&copy; 2024 Taller Mecánico. Todos los derechos reservados.</p>
      </div>
    </footer>
  </body>
</html>

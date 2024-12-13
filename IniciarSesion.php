<?php
session_start();
include('Conexion.php');

if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $correo = validate($_POST['correo']);
    $contrasena = validate($_POST['contrasena']);

    if (empty($correo)) {
        header("Location: Login.php?error=El correo es requerido");
        exit();
    } elseif (empty($contrasena)) {
        header("Location: Login.php?error=La contraseña es requerida");
        exit();
    } else {
        // Buscar el usuario en la base de datos
        $sql = "SELECT * FROM Usuarios WHERE correo = ?"; 
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, 's', $correo);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

           
            if (password_verify($contrasena, $row['contrasena'])) { 
                $_SESSION['nombre'] = $row['nombre']; 
                $_SESSION['id_usuario'] = $row['id_usuario']; 
                $_SESSION['rol'] = $row['rol'];
                header("Location: index.php");
                exit();
            } else {
                header("Location: Login.php?error=El correo o la contraseña son incorrectos");
                exit();
            }
        } else {
            header("Location: Login.php?error=El correo o la contraseña son incorrectos");
            exit();
        }
    }
} else {
    header("Location: Index.php");
    exit();
}
?>

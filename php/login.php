<?php
session_start();
include('../config/conexion.php');

// Redirigir si ya está logueado
if (isset($_SESSION['admin'])) {
    header("Location: ../administrador/index_admin.php");
    exit();
}
if (isset($_SESSION['usuario'])) {
    header("Location: ../empleado/index_E.php");
    exit();
}

// Limitar intentos fallidos
if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}
if ($_SESSION['intentos'] >= 5) {
    echo "<script>alert('Demasiados intentos fallidos. Intenta más tarde.'); window.location.href='../sesion.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];

    // Login admin fijo
    $admin_usuario = "admin";
    $admin_password = "123456";

    if ($usuario === $admin_usuario && $password === $admin_password) {
        session_regenerate_id(true);
        $_SESSION['admin'] = $usuario;
        $_SESSION['rol'] = "admin";
        echo "<script>window.location.href='../administrador/index_admin.php';</script>";
        exit();
    }

    // Login empleado desde base de datos
    $stmt = $conexion->prepare("SELECT * FROM empleado WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $empleado = $resultado->fetch_assoc();

        // Verificar contraseña hasheada
        if (password_verify($password, $empleado['password'])) {
            session_regenerate_id(true);
            $_SESSION['id_empleado'] = $empleado['id_empleado'];
            $_SESSION['usuario'] = $empleado['usuario'];
            $_SESSION['rol'] = "empleado";
            $_SESSION['intentos'] = 0; // Reiniciar intentos
            echo "<script>window.location.href='../empleado/index_E.php';</script>";
            exit();
        }
    }

    // Si falla el login
    $_SESSION['intentos'] += 1;
    echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='../sesion.php';</script>";
}
?>


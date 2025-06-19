<?php
session_start();
include('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $query = "SELECT * FROM empleado WHERE usuario = '$usuario' AND password = '$password'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $empleado = mysqli_fetch_assoc($resultado);
        $_SESSION['id_empleado'] = $empleado['id_empleado'];
        $_SESSION['nombre_completo'] = $empleado['nombre_completo'];
        $_SESSION['usuario'] = $empleado['usuario'];
        header("Location: ../empleado/index_E.php"); // Redirige al panel
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='../sesion.php';</script>";
    }
}



?>

<?php
session_start();

// Usuario y contraseña fijos
$admin_usuario = "admin";
$admin_password = "123456";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if ($usuario === $admin_usuario && $password === $admin_password) {
        $_SESSION['admin'] = $usuario;
        header("Location: ../administrador/index_admin.php");
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location='../sesion_admin.php';</script>";
    }
}
?>

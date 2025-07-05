<?php 
include "../config/conexion.php";

// Mostrar estructura HTML y cargar SweetAlert2
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Registro de empleado</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['nombre_completo']) && !empty($_POST['usuario']) && !empty($_POST['password'])) {
        
        $nombre_completo = $_POST['nombre_completo'];
        $usuario         = $_POST['usuario'];
        $password        = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar contraseña

        // Consulta segura (id_empleado autoincremental)
        $stmt = $conexion->prepare("INSERT INTO empleado (nombre_completo, usuario, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre_completo, $usuario, $password);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Empleado registrado!',
                    text: 'El nuevo empleado fue agregado correctamente.',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = '../administrador/ver_tablas.php';
                });
            </script>";
        } else {
            $error = addslashes($stmt->error);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al registrar',
                    text: '$error',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../administrador/formulario.php';
                });
            </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Por favor, complete todos los campos.',
                confirmButtonColor: '#f39c12'
            }).then(() => {
                window.location.href = '../administrador/formulario.php';
            });
        </script>";
    }
}

echo "</body></html>";
?>


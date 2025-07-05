<?php 
include "../config/conexion.php";

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Registro</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['fecha_registro']) && !empty($_POST['total']) && !empty($_POST['id_empleado'])) {
        
        $fecha_registro = $_POST['fecha_registro'];
        $total = $_POST['total'];
        $id_empleado = $_POST['id_empleado']; // ✅ variable corregida
        
        $stmt = $conexion->prepare("INSERT INTO otroingreso (fecha_registro, total, id_empleado) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $fecha_registro, $total, $id_empleado);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Registro exitoso!',
                    text: 'El ingreso fue registrado correctamente.',
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
                    title: 'Error al guardar',
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
                title: 'Campos vacíos',
                text: 'Por favor completa todos los campos.',
                confirmButtonColor: '#f1c40f'
            }).then(() => {
                window.location.href = '../administrador/formulario.php';
            });
        </script>";
    }
}

echo "</body></html>";
?>


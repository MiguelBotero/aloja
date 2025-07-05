<?php
include "../config/conexion.php";

// Activar excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Iniciar HTML para usar SweetAlert
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Actualizar Empleado</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['id_empleado'])) {
        $id_empleado = $_POST['id_empleado'];
        $nombre_completo = $_POST['nombre_completo'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        // Consulta preparada
        $stmt = $conexion->prepare("UPDATE empleado SET nombre_completo = ?, usuario = ?, password = ? WHERE id_empleado = ?");
        $stmt->bind_param("sssi", $nombre_completo, $usuario, $password, $id_empleado);

        try {
            $stmt->execute();
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'El empleado ha sido actualizado correctamente.',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = '../administrador/ver_tablas.php';
                });
            </script>";
        } catch (mysqli_sql_exception $e) {
            $msg = addslashes($e->getMessage());
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al actualizar',
                    text: '$msg',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../administrador/editar_empleado.php';
                });
            </script>";
        }

    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Falta el ID',
                text: 'El ID del empleado no fue enviado.',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = '../administrador/editar_empleado.php';
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Acceso no permitido',
            text: 'Solo se permite el acceso por método POST.',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '../administrador/editar_empleado.php';
        });
    </script>";
}

echo "</body></html>";
?>



<?php
include '../../config/conexion.php';

// Activar excepciones para capturar errores de base de datos
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id = $_GET['id'] ?? null;

// Iniciar HTML para usar SweetAlert
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Eliminar Huésped</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($id) {
    try {
        $sql = "DELETE FROM huesped WHERE id_huesped = $id";
        mysqli_query($conexion, $sql);

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Eliminado!',
                text: 'El huésped fue eliminado exitosamente.',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = '../../empleado/ver_tablas_E.php';
            });
        </script>";

    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) {
            // Error por clave foránea (el huésped está en uso)
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'No se puede eliminar',
                    text: 'Este huésped está relacionado con otros registros.',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../../empleado/ver_tablas_E.php';
                });
            </script>";
        } else {
            $msg = addslashes($e->getMessage());
            echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Error inesperado',
                    text: '$msg',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../../empleado/ver_tablas_E.php';
                });
            </script>";
        }
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ID no proporcionado',
            text: 'No se recibió el ID del huésped.',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '../../empleado/ver_tablas_E.php';
        });
    </script>";
}

echo "</body></html>";
?>

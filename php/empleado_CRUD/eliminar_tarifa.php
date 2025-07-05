<?php
include '../../config/conexion.php';

// Activar excepciones de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id = $_GET['id'] ?? null;

// HTML necesario para que funcione SweetAlert2
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Eliminar Tarifa</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($id) {
    try {
        $sql = "DELETE FROM tarifa WHERE id_tarifa = $id";
        mysqli_query($conexion, $sql);

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Eliminado!',
                text: 'La tarifa fue eliminada exitosamente.',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = '../../empleado/ver_tablas_E.php';
            });
        </script>";

    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'No se puede eliminar',
                    text: 'Esta tarifa está relacionada con otros registros.',
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
            title: 'ID no recibido',
            text: 'No se recibió el ID de la tarifa a eliminar.',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '../../empleado/ver_tablas_E.php';
        });
    </script>";
}

echo "</body></html>";
?>

<?php
include "../../config/conexion.php";

// Activar excepciones de MySQL
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id_estadia = isset($_GET['id_estadia']) ? intval($_GET['id_estadia']) : null;

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Eliminar estadía</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if (is_null($id_estadia) || $id_estadia == 0) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se recibió el parámetro necesario (id_estadia).'
        }).then(() => {
            window.location.href = '../../empleado/ver_tablas_E.php';
        });
    </script>";
    echo "</body></html>";
    exit;
}

try {
    // Ejecutar la eliminación
    $sql = "DELETE FROM estadia WHERE id_estadia = $id_estadia";
    mysqli_query($conexion, $sql);

    echo "<script>
        Swal.fire({
            icon: 'success',
            title: '¡Eliminado!',
            text: 'La estadía fue eliminada exitosamente.',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            window.location.href = '../../empleado/ver_tablas_E.php';
        });
    </script>";

} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1451) {
        // Error de restricción de clave foránea
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'No se puede eliminar',
                text: 'Esta estadía está relacionada con otros registros como huésped_has_estadia.',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = '../../empleado/ver_tablas_E.php';
            });
        </script>";
    } else {
        $mensaje = addslashes($e->getMessage());
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Error inesperado',
                text: '$mensaje',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = '../../empleado/ver_tablas_E.php';
            });
        </script>";
    }
}

echo "</body></html>";
?>

<?php
include '../../config/conexion.php';

// Activar modo estricto para lanzar excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Obtener el ID por GET
$id = $_GET['id'] ?? null;

// Comienzo del HTML para usar SweetAlert
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Eliminar Otro Ingreso</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($id) {
    try {
        $sql = "DELETE FROM otroingreso WHERE id_otroingreso = $id";
        mysqli_query($conexion, $sql);

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Eliminado!',
                text: 'El otro ingreso fue eliminado exitosamente.',
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
                    text: 'Este ingreso está relacionado con otros registros.',
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
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ID no válido',
            text: 'No se proporcionó un ID para eliminar.',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '../../empleado/ver_tablas_E.php';
        });
    </script>";
}

echo "</body></html>";
?>

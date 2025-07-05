<?php
include("../config/conexion.php");

// Activar modo estricto para que mysqli lance excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Obtener el ID
$id = $_GET['id'] ?? null;

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Eliminar Novedad</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($id) {
    try {
        $sql = "DELETE FROM novedades WHERE id_novedades = $id";
        mysqli_query($conexion, $sql);

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Eliminado!',
                text: 'La novedad se eliminó correctamente.',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = '../administrador/ver_tablas.php';
            });
        </script>";

    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'No se puede eliminar',
                    text: 'Esta novedad está relacionada con otros registros.',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../administrador/ver_tablas.php';
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
                    window.location.href = '../administrador/ver_tablas.php';
                });
            </script>";
        }
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ID no válido',
            text: 'No se recibió un ID para eliminar.',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '../administrador/ver_tablas.php';
        });
    </script>";
}

echo "</body></html>";
?>

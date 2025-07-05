<?php
include '../../config/conexion.php';
// Activar errores
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Cargar librería SweetAlert y estructura HTML
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Eliminar habitación</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Intentar eliminar con manejo de errores
    try {
        $sql = "DELETE FROM habitacion WHERE id_habitacion = $id";
        mysqli_query($conexion, $sql);

        // Éxito
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Eliminado!',
                text: 'La habitación fue eliminada exitosamente.',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = '../../empleado/index_E.php';
            });
        </script>";

    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) {
            // Restricción de clave foránea
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'No se puede eliminar',
                    text: 'Esta habitación está relacionada con registros en la tabla estadía.',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../../empleado/index_E.php'';
                });
            </script>";
        } else {
            $error = addslashes($e->getMessage());
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al eliminar',
                    text: '$error',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../../empleado/index_E.php'';
                });
            </script>";
        }
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'ID no válido',
            text: 'No se proporcionó un ID de habitación.',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            window.location.href = '../../empleado/index_E.php'';
        });
    </script>";
}

echo "</body></html>";
?>



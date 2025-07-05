<?php
include "../config/conexion.php";

// Activar modo estricto para que lance excepciones en errores
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id = $_GET['id'];

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Eliminar empleado</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

try {
    $sql = "DELETE FROM empleado WHERE id_empleado = $id";
    mysqli_query($conexion, $sql);

    echo "<script>
        Swal.fire({
            icon: 'success',
            title: '¡Empleado eliminado!',
            text: 'El registro se eliminó correctamente.',
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
                text: 'Este empleado está relacionado con otros registros.',
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

echo "</body></html>";
?>

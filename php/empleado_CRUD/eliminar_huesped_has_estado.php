<?php
include "../../config/conexion.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Obtener y validar parámetros
$id_huesped = isset($_GET['id_huesped']) ? intval($_GET['id_huesped']) : 0;
$id_estadia = isset($_GET['id_estadia']) ? intval($_GET['id_estadia']) : 0;

if ($id_huesped <= 0 || $id_estadia <= 0) {
    echo "<script>
        alert('Error: Los parámetros id_huesped o id_estadia son inválidos.');
        window.location.href = '../../empleado/ver_tablas_E.php';
    </script>";
    exit;
}

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Eliminar vínculo huésped-estadía</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

try {
    // Eliminar la relación huésped-estadía
    $stmt = $conexion->prepare("DELETE FROM huesped_has_estado WHERE id_huesped = ? AND id_estadia = ?");
    $stmt->bind_param("ii", $id_huesped, $id_estadia);
    $stmt->execute();

    echo "<script>
        Swal.fire({
            icon: 'success',
            title: '¡Eliminado!',
            text: 'El vínculo huésped-estadía fue eliminado exitosamente.',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            window.location.href = '../../empleado/ver_tablas_E.php';
        });
    </script>";

} catch (mysqli_sql_exception $e) {
    $mensaje = addslashes($e->getMessage());
    $titulo = ($e->getCode() == 1451) ? "No se puede eliminar" : "Error inesperado";
    $texto = ($e->getCode() == 1451) ? "Este registro está relacionado con otras tablas." : $mensaje;

    echo "<script>
        Swal.fire({
            icon: 'error',
            title: '$titulo',
            text: '$texto',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '../../empleado/ver_tablas_E.php';
        });
    </script>";
}

echo "</body></html>";
?>






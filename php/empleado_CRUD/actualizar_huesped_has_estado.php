<?php
include '../../config/conexion.php';

// Habilitamos excepciones de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Actualizar</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

try {
    $old_id_huesped = $_POST['id_huesped_old'];
    $old_id_estadia = $_POST['id_estadia_old'];
    $new_id_huesped = $_POST['id_huesped'];
    $new_id_estadia = $_POST['id_estadia'];

    $sql = "UPDATE huesped_has_estado 
            SET id_huesped = ?, id_estadia = ?
            WHERE id_huesped = ? AND id_estadia = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iiii", $new_id_huesped, $new_id_estadia, $old_id_huesped, $old_id_estadia);
    $stmt->execute();

    echo "<script>
        Swal.fire({
            icon: 'success',
            title: '¡Actualizado!',
            text: 'El registro fue actualizado correctamente.',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            window.location.href = '../../empleado/ver_tablas_E.php';
        });
    </script>";

} catch (mysqli_sql_exception $e) {
    $error = addslashes($e->getMessage());

    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error al actualizar',
            text: '$error',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '../../empleado//editar_huesped_has_estado_E.php';
        });
    </script>";
}

echo "</body></html>";
?>


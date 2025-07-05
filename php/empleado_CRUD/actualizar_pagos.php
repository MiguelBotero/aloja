<?php
include '../../config/conexion.php';

// Mostrar SweetAlert2 correctamente
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Actualizar Pago</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pagos = $_POST['id_pagos'];
    $fecha_pago = $_POST['fecha_pago'];
    $valor = $_POST['valor'];
    $id_huesped = $_POST['id_huesped'];
    $id_estadia = $_POST['id_estadia'];
    $id_empleado = $_POST['id_empleado'];
    $imagen = $_POST['imagen'];
    $observacion = $_POST['observacion'];

    $sql = "UPDATE pagos SET 
                fecha_pago = ?, 
                valor = ?, 
                id_huesped = ?, 
                id_estadia = ?, 
                id_empleado = ?, 
                imagen = ?, 
                observacion = ?
            WHERE id_pagos = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "siiiissi", $fecha_pago, $valor, $id_huesped, $id_estadia, $id_empleado, $imagen, $observacion, $id_pagos);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'El pago fue actualizado exitosamente.',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = '../../empleado/ver_tablas_E.php';
                });
            </script>";
        } else {
            $error = addslashes(mysqli_stmt_error($stmt));
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al ejecutar',
                    text: '$error',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.history.location.location.href = '../../empleado/editar_pagos_E.php';
                });
            </script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = addslashes(mysqli_error($conexion));
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error al preparar consulta',
                text: '$error',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.history.location.location.href = '../../empleado/editar_pagos_E.php';
            });
        </script>";
    }
}

echo "</body></html>";
?>



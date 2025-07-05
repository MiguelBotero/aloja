<?php
include "../config/conexion.php";

// Activar excepciones en caso de errores
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Obtener ID de pago
$id = $_GET['id'] ?? null;

// Iniciar HTML para que funcione SweetAlert2
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Eliminar Pago</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($id) {
    try {
        $sql = "DELETE FROM pagos WHERE id_pagos = $id";
        mysqli_query($conexion, $sql);

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Pago eliminado!',
                text: 'El pago fue eliminado exitosamente.',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = '../administrador/ver_tablas.php';
            });
        </script>";

    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) {
            // Clave foránea (pago relacionado con otra tabla)
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'No se puede eliminar',
                    text: 'Este pago está relacionado con otros registros.',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../administrador/ver_tablas.php';
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
                    window.location.href = '../administrador/ver_tablas.php';
                });
            </script>";
        }
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ID no recibido',
            text: 'No se recibió el ID del pago.',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '../administrador/ver_tablas.php';
        });
    </script>";
}

echo "</body></html>";
?>


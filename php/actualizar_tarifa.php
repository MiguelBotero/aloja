<?php
include '../config/conexion.php';

// Iniciar salida HTML para que SweetAlert funcione
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Actualizar Tarifa</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id_tarifa'];
    $dia = $_POST['dia'];
    $semana = $_POST['semana'];
    $quincena = $_POST['quincena'];
    $mensual = $_POST['mensual'];
    $id_habitacion = $_POST['id_habitacion'];

    $sql = "UPDATE tarifa SET 
                dia = ?, 
                semana = ?, 
                quincena = ?, 
                mensual = ?, 
                id_habitacion = ?
            WHERE id_tarifa = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ddddii", $dia, $semana, $quincena, $mensual, $id_habitacion, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'La tarifa fue actualizada correctamente.',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = '../administrador/ver_tablas.php';
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
                    window.history.back();
                });
            </script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = addslashes(mysqli_error($conexion));
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error en la consulta',
                text: '$error',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.history.back();
            });
        </script>";
    }
}

echo "</body></html>";
?>



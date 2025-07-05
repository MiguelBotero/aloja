<?php 
include '../../config/conexion.php';

// Habilitar excepciones para MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Cargar encabezado HTML y librería de SweetAlert2
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Actualizar Novedades</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_novedades = $_POST['id_novedades'];
    $descripcion = $_POST['descripcion'];
    $id_estadia = $_POST['id_estadia'];

    // Consulta segura usando prepared statements
    $sql = "UPDATE novedades SET 
                descripcion = ?, 
                id_estadia = ?
            WHERE id_novedades = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sii", $descripcion, $id_estadia, $id_novedades);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'La novedad fue actualizada correctamente.',
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
                    title: 'Error en la ejecución',
                    text: '$error',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../../empleado/editar_novedades_E.php';
                });
            </script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = addslashes(mysqli_error($conexion));
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error al preparar la consulta',
                text: '$error',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = '../../empleado/editar_novedades_E.php';
            });
        </script>";
    }
}

echo "</body></html>";
?>


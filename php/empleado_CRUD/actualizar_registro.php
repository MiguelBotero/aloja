<?php 
include '../../config/conexion.php';

// Activar errores detallados
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Empieza el HTML antes de cualquier salida
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Actualizar Huésped</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>
";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_huesped = $_POST['id_huesped'];
    $nombre_completo = $_POST['nombre_completo'];
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $telefono_huesped = $_POST['telefono_huesped'];
    $origen = $_POST['origen'];
    $nombre_contacto = $_POST['nombre_contacto'];
    $telefono_contacto = $_POST['telefono_contacto'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE huesped SET 
                nombre_completo = ?, 
                tipo_documento = ?, 
                numero_documento = ?, 
                telefono_huesped = ?, 
                origen = ?, 
                nombre_contacto = ?, 
                telefono_contacto = ?, 
                observaciones = ?
            WHERE id_huesped = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param(
            $stmt,
            "ssisssssi",
            $nombre_completo,
            $tipo_documento,
            $numero_documento,
            $telefono_huesped,
            $origen,
            $nombre_contacto,
            $telefono_contacto,
            $observaciones,
            $id_huesped
        );

        if (mysqli_stmt_execute($stmt)) {
            // Éxito
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Actualizado!',
                        text: 'La información del huésped fue actualizada correctamente.',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        window.location.href = '../../empleado/ver_tablas_E.php';
                    });
                });
            </script>";
        } else {
            // Error en ejecución
            $error = addslashes(mysqli_stmt_error($stmt));
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al ejecutar',
                        text: '$error',
                        confirmButtonColor: '#d33'
                    }).then(() => {
                        window.location.href = '../../empleado/editar_registro_E.php';
                    });
                });
            </script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        // Error al preparar consulta
        $error = addslashes(mysqli_error($conexion));
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al preparar consulta',
                    text: '$error',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../../empleado/editar_registro_E.php';
                });
            });
        </script>";
    }
}

echo "</body></html>";
?>

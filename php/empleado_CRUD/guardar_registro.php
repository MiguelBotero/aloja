<?php 
include '../../config/conexion.php';

// Activar reporte de errores
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Estructura HTML con SweetAlert2
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Guardar Huésped</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nombre_completo     = $_POST['nombre_completo'];
    $tipo_documento      = $_POST['tipo_documento'];
    $numero_documento    = $_POST['numero_documento'];
    $telefono_huesped    = $_POST['telefono_huesped'];
    $origen              = $_POST['origen'];
    $nombre_contacto     = $_POST['nombre_contacto'];
    $telefono_contacto   = $_POST['telefono_contacto'];
    $observaciones       = $_POST['observaciones'];

    try {
        $stmt = $conexion->prepare("INSERT INTO huesped 
            (nombre_completo, tipo_documento, numero_documento, telefono_huesped, origen, nombre_contacto, telefono_contacto, observaciones) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssss", 
            $nombre_completo, 
            $tipo_documento, 
            $numero_documento, 
            $telefono_huesped, 
            $origen, 
            $nombre_contacto, 
            $telefono_contacto, 
            $observaciones
        );

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Registrado!',
                    text: 'El huésped fue registrado correctamente.',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = '../../empleado/ver_tablas_E.php';
                });
            </script>";
        } else {
            $error = addslashes($stmt->error);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al guardar',
                    text: '$error',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../../empleado/formulario_E.php';
                });
            </script>";
        }

        $stmt->close();

    } catch (mysqli_sql_exception $e) {
        $error = addslashes($e->getMessage());
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Excepción detectada',
                text: '$error',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = '../../empleado/formulario_E.php';
            });
        </script>";
    }
}

echo "</body></html>";
?>



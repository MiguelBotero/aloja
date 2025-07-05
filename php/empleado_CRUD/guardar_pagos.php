<?php
include '../../config/conexion.php';

// Activar reportes de errores
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Encabezado HTML y librería SweetAlert
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Registro de Pago</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_pago   = $_POST['fecha_pago'];
    $valor        = $_POST['valor'];
    $id_huesped   = $_POST['id_huesped'];
    $id_estadia   = $_POST['id_estadia'];
    $id_empleado  = $_POST['id_empleado'];
    $imagen2       = $_POST['imagen2'];
    $observacion  = $_POST['observacion'];

    try {
        // Prepared statement para mayor seguridad
        $stmt = $conexion->prepare("INSERT INTO pagos
            (fecha_pago, valor, id_huesped, id_estadia, id_empleado, imagen, observacion) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sddiiss", 
            $fecha_pago, 
            $valor, 
            $id_huesped, 
            $id_estadia, 
            $id_empleado, 
            $imagen2, 
            $observacion
        );

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Pago registrado!',
                    text: 'El pago se guardó correctamente.',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = '../../empleado/ver_tablas.php';
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
                title: 'Error inesperado',
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


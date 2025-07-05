
<?php
include '../../config/conexion.php';

// Habilitamos excepciones de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Iniciamos HTML para poder usar SweetAlert2
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Actualizar Estadía</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['id_estadia']) &&
        isset($_POST['fecha_inicio']) &&
        isset($_POST['fecha_fin']) &&
        isset($_POST['fecha_registro']) &&
        isset($_POST['costo']) &&
        isset($_POST['id_habitacion'])
    ) {
        $id_estadia = $_POST['id_estadia'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $fecha_registro = $_POST['fecha_registro'];
        $costo = $_POST['costo'];
        $id_habitacion = $_POST['id_habitacion'];

        // Consulta preparada segura
        $stmt = $conexion->prepare("UPDATE estadia 
            SET fecha_inicio = ?, fecha_fin = ?, fecha_registro = ?, costo = ?, id_habitacion = ? 
            WHERE id_estadia = ?");

        $stmt->bind_param("sssisi", $fecha_inicio, $fecha_fin, $fecha_registro, $costo, $id_habitacion, $id_estadia);

        try {
            $stmt->execute();

            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'La estadía fue actualizada correctamente.',
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
                    window.location.href = '../../empleado/editar_estadia_E.php';
                });
            </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Datos incompletos',
                text: 'Por favor, completa todos los campos obligatorios.',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = '../../empleado/editar_estadia_E.php';
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Acceso denegado',
            text: 'Solo se permite el método POST.',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '../../empleado/editar_estadia_E.php';
        });
    </script>";
}

echo "</body></html>";
?>

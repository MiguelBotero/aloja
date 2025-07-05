

<?php
include "../config/conexion.php";

// Habilitar errores para detectar fallos
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Cargar HTML y SweetAlert
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Actualizar Ingreso</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['id_otroingreso']) &&
        isset($_POST['fecha_registro']) &&
        isset($_POST['total']) &&
        isset($_POST['id_empleado'])
    ) {
        $id = $_POST['id_otroingreso'];
        $fecha = $_POST['fecha_registro'];
        $total = $_POST['total'];
        $empleado = $_POST['id_empleado'];

        // Consulta segura
        $sql = "UPDATE otroingreso 
                SET fecha_registro = ?, 
                    total = ?, 
                    id_empleado = ? 
                WHERE id_otroingreso = ?";

        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssii", $fecha, $total, $empleado, $id);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: '¡Actualizado!',
                        text: 'El ingreso fue actualizado exitosamente.',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        window.location.href = '../administrador/ver_tablas.php';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al ejecutar',
                        text: 'No se pudo actualizar el registro.',
                        confirmButtonColor: '#d33'
                    }).then(() => {
                        window.location.href = '../administrador/editar_otroingresos.php';
                    });
                </script>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al preparar',
                    text: 'Error al preparar la consulta SQL.',
                    confirmButtonColor: '#d33'
                }).then(() => {
                     window.location.href = '../administrador/editar_otroingresos.php';
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Por favor, completa todos los campos del formulario.',
                confirmButtonColor: '#f39c12'
            }).then(() => {
                window.history.back();
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Método no permitido',
            text: 'Debes enviar el formulario correctamente.',
            confirmButtonColor: '#f39c12'
        }).then(() => {
            window.history.back();
        });
    </script>";
}

echo "</body></html>";
?>

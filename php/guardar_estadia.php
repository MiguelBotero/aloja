<?php 
include "../config/conexion.php";

// Estructura HTML + SweetAlert2
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Registro de estadía</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (
        !empty($_POST['fecha_inicio']) &&
        !empty($_POST['fecha_fin']) &&
        !empty($_POST['fecha_registro']) &&
        !empty($_POST['costo']) &&
        !empty($_POST['id_habitacion'])
    ) {
        $fecha_inicio   = $_POST['fecha_inicio'];
        $fecha_fin      = $_POST['fecha_fin'];
        $fecha_registro = $_POST['fecha_registro'];
        $costo          = floatval($_POST['costo']);
        $id_habitacion  = intval($_POST['id_habitacion']);

        $stmt = $conexion->prepare("INSERT INTO estadia (fecha_inicio, fecha_fin, fecha_registro, costo, id_habitacion) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdi", $fecha_inicio, $fecha_fin, $fecha_registro, $costo, $id_habitacion);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Registro exitoso!',
                    text: 'La estadía se ha guardado correctamente.',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = '../administrador/ver_tablas.php';
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
                    window.location.href = '../administrador/formulario.php';
                });
            </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Todos los campos son obligatorios.',
                confirmButtonColor: '#f1c40f'
            }).then(() => {
                window.location.href = '../administrador/formulario.php';
            });
        </script>";
    }
}

echo "</body></html>";
?>


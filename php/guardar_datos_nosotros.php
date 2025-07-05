<?php
include '../config/conexion.php';

// HTML base y SweetAlert2
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Actualizar Nosotros</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if (isset($_POST['titulo'], $_POST['filosofia_servicio'], $_POST['atencion_personalizada'])) {
    $todo_ok = true;

    foreach ($_POST['titulo'] as $id => $titulo) {
        $filosofia_servicio = $_POST['filosofia_servicio'][$id];
        $atencion_personalizada = $_POST['atencion_personalizada'][$id];

        $sql = "UPDATE nosotros SET titulo = ?, filosofia_servicio = ?, atencion_personalizada = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssi", $titulo, $filosofia_servicio, $atencion_personalizada, $id);
            if (!$stmt->execute()) {
                $todo_ok = false;
                $error_msg = addslashes($stmt->error);
                break;
            }
        } else {
            $todo_ok = false;
            $error_msg = addslashes($conexion->error);
            break;
        }
    }

    if ($todo_ok) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Actualización exitosa!',
                text: 'La información fue actualizada correctamente.',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = '../administrador/nosotros_admin.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error al actualizar',
                text: '$error_msg',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = '../administrador/nosotros_admin.php';
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Datos incompletos',
            text: 'Faltan campos en el formulario.',
            confirmButtonColor: '#f39c12'
        }).then(() => {
           window.location.href = '../administrador/nosotros_admin.php';
        });
    </script>";
}

echo "</body></html>";
?>



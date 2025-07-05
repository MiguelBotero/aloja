<?php
include '../config/conexion.php';

// Incluir estructura básica con SweetAlert2
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Asociar Huésped y Estadía</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['id_huesped']) && !empty($_POST['id_estadia'])) {
        $id_huesped = $_POST['id_huesped'];
        $id_estadia = $_POST['id_estadia'];

        $stmt = $conexion->prepare("INSERT INTO huesped_has_estado (id_huesped, id_estadia) VALUES (?, ?)");
        $stmt->bind_param("ii", $id_huesped, $id_estadia);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Asociación exitosa!',
                    text: 'El huésped ha sido vinculado correctamente con la estadía.',
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
                text: 'Debes seleccionar tanto el huésped como la estadía.',
                confirmButtonColor: '#f1c40f'
            }).then(() => {
                window.location.href = '../administrador/formulario.php';
            });
        </script>";
    }
}

echo "</body></html>";
?>



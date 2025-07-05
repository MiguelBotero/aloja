
<?php 
include "../config/conexion.php";

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Registro de Novedad</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['descripcion']) && !empty($_POST['id_estadia'])) {
        $descripcion = $_POST['descripcion'];
        $id_estadia = $_POST['id_estadia'];

        // Consulta segura con prepared statements
        $stmt = $conexion->prepare("INSERT INTO novedades (descripcion, id_estadia) VALUES (?, ?)");
        $stmt->bind_param("si", $descripcion, $id_estadia);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Registro exitoso!',
                    text: 'La novedad se ha guardado correctamente.',
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
                title: 'Faltan datos',
                text: 'Por favor completa todos los campos antes de continuar.',
                confirmButtonColor: '#f1c40f'
            }).then(() => {
                window.location.href = '../administrador/formulario.php';
            });
        </script>";
    }
}

echo "</body></html>";
?>

<?php
include '../../config/conexion.php';

// Habilitar errores como excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Iniciar HTML para usar SweetAlert
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Actualizar Habitación</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"]);
    $nombre = $_POST["nombre"];
    $dotacion = $_POST["dotacion"];
    $telefono_encargado = $_POST["telefono_encargado"];
    $precio = floatval($_POST["precio"]);
    $disponibilidad = intval($_POST["disponibilidad"]);

    $imagen_actual = $_POST["imagen_actual"];
    $imagen_nueva = $_FILES["imagen"]["name"];
    $imagen_tmp = $_FILES["imagen"]["tmp_name"];

    // Manejo de imagen
    if (!empty($imagen_nueva)) {
        $nombre_imagen = uniqid() . "_" . basename($imagen_nueva);
        $ruta_destino = "../../img/" . $nombre_imagen;

        if (move_uploaded_file($imagen_tmp, $ruta_destino)) {
            $imagen_final = $nombre_imagen;

            if (file_exists("../../img/" . $imagen_actual) && $imagen_actual !== "default.jpg") {
                unlink("../../img/" . $imagen_actual);
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al subir imagen',
                    text: 'No se pudo subir la nueva imagen.',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../../empleado/editar_habitacion_E.php';
                });
            </script>";
            exit;
        }
    } else {
        $imagen_final = $imagen_actual;
    }

    // Consulta preparada para actualizar la habitación
    $sql = "UPDATE habitacion SET 
                nombre = ?, 
                dotacion = ?, 
                telefono_encargado = ?, 
                precio = ?, 
                disponibilidad = ?, 
                imagen = ? 
            WHERE id_habitacion = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssisi", $nombre, $dotacion, $telefono_encargado, $precio, $disponibilidad, $imagen_final, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'La habitación fue actualizada correctamente.',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = '../../empleado/index_E.php';
                });
            </script>";
        } else {
            $error = addslashes(mysqli_stmt_error($stmt));
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la consulta',
                    text: '$error',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../../empleado/editar_habitacion_E.php';
                });
            </script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = addslashes(mysqli_error($conexion));
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error al preparar consulta',
                text: '$error',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = '../../empleado/editar_habitacion_E.php';
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Acceso no permitido',
            text: 'Solo se permiten solicitudes POST.',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '../../empleado/editar_habitacion_E.php';
        });
    </script>";
}

echo "</body></html>";
?>




<?php
include '../../config/conexion.php';

// Activar errores para depuración (opcional en desarrollo)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Cargar estructura HTML y SweetAlert2
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Registro de habitación</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre         = $_POST['nombre'];
    $dotacion       = $_POST['dotacion'];
    $precio         = floatval($_POST['precio']);
    $disponibilidad = isset($_POST['disponibilidad']) ? 1 : 0;
    $ruta_imagen    = "";

    // Subir imagen si se envió
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $nombre_unico = uniqid() . "_" . basename($_FILES['imagen']['name']);
        $ruta_destino = "../../img/" . $nombre_unico;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
            $ruta_imagen = $ruta_destino;
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al subir imagen',
                    text: 'No se pudo guardar la imagen en el servidor.',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = '../../empleado/formulario_E.php';
                });
            </script>";
            exit;
        }
    }

    // Insertar en base de datos con consulta preparada
    $stmt = $conexion->prepare("INSERT INTO habitacion (nombre, imagen, dotacion, precio, disponibilidad) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdi", $nombre, $ruta_imagen, $dotacion, $precio, $disponibilidad);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Registro exitoso!',
                text: 'La habitación fue registrada correctamente.',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = '../../empleado/index_E.php';
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
}

echo "</body></html>";
?>


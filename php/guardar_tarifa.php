<?php
include '../config/conexion.php';

// Reportar errores de mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Iniciar estructura HTML
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Guardar Tarifa</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dia = $_POST['dia'];
    $semana = $_POST['semana'];
    $quincena = $_POST['quincena'];
    $mensual = $_POST['mensual'];
    $id_habitacion = $_POST['id_habitacion'];

    try {
        // Preparar la consulta
        $stmt = $conexion->prepare("INSERT INTO tarifa (dia, semana, quincena, mensual, id_habitacion) 
                                    VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ddddi", $dia, $semana, $quincena, $mensual, $id_habitacion);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Guardado!',
                    text: 'La tarifa fue registrada exitosamente.',
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

    } catch (mysqli_sql_exception $e) {
        $error = addslashes($e->getMessage());
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Excepción detectada',
                text: '$error',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = '../administrador/formulario.php';
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Acceso no permitido',
            text: 'Debes enviar el formulario mediante POST.',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            window.location.href = '../administrador/formulario.php';
        });
    </script>";
}

echo "</body></html>";
?>


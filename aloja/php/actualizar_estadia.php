<?php
include "../config/conexion.php";

// Validar que los datos han sido enviados por POST
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

        // Actualizar los datos
        $sql_update = "UPDATE estadia SET 
            fecha_inicio = '$fecha_inicio',
            fecha_fin = '$fecha_fin',
            fecha_registro = '$fecha_registro',
            costo = '$costo',
            id_habitacion = '$id_habitacion'
            WHERE id_estadia = $id_estadia";

        if (mysqli_query($conexion, $sql_update)) {
            header("Location: ../administrador/ver_tablas.php");
            exit();
        } else {
            echo "Error al actualizar: " . mysqli_error($conexion);
        }
    } else {
        echo "Faltan datos obligatorios.";
    }
} else {
    echo "Acceso no permitido.";
}
?>

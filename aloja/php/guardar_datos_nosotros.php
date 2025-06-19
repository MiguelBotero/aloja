<?php
include '../config/conexion.php';

// Recoger los datos enviados por el formulario
foreach ($_POST[''] as $id => $titulo) {
    $id = $_POST['descripcion'][$id];

    // Manejar la imagen subida
  

    // Actualizar los datos en la base de datos
    $sql = "UPDATE nosotros SET titulo = ?, atencion_personalizada = ?, filosofia_servicio = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $titulo, $filosofia_servicio, $atencion_personalizada, $id);
    $stmt->execute();
}

header('Location: ../administrador/nosotros_admin.php'); // Redirigir a la página de administración después de guardar
exit();

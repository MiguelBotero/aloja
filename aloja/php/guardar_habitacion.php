<?php

include "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $dotacion = $_POST['dotacion'];
    $precio = $_POST['precio'];
    $disponibilidad = isset($_POST['disponibilidad']) ? 1 : 0;
    $ruta_imagen = ""; // Por defecto

    // Manejo de imagen si fue subida
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_imagen = basename($_FILES['imagen']['name']);
        $ruta_destino = "../img/" . $nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
        $ruta_imagen = $ruta_destino;
    }

    $sql = "INSERT INTO habitacion (nombre, imagen, dotacion, precio, disponibilidad) 
            VALUES ('$nombre', '$ruta_imagen', '$dotacion', '$precio', '$disponibilidad')";
    $resultado=mysqli_query($conexion, $sql);

    if ($resultado) {
        echo "<script>alert('registro exitoso'); window.location.href='../administrador/formulario.php'</script>";
    } else {
        echo "<script>alert('Error al guardar el registro: ". mysqli_error($conexion) ."'); window.location.href='../administrador/formulario.php' </script>";
    }
}

?>
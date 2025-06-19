<?php
include "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"]);
    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $dotacion = mysqli_real_escape_string($conexion, $_POST["dotacion"]);
    $telefono_encargado = mysqli_real_escape_string($conexion, $_POST["telefono_encargado"]);
    $precio = floatval($_POST["precio"]);
    $disponibilidad = intval($_POST["disponibilidad"]);

    $imagen_actual = $_POST["imagen_actual"];
    $imagen_nueva = $_FILES["imagen"]["name"];
    $imagen_tmp = $_FILES["imagen"]["tmp_name"];

    // Si se sube una nueva imagen
    if (!empty($imagen_nueva)) {
        $nombre_imagen = uniqid() . "_" . basename($imagen_nueva);
        $ruta_destino = "../img/" . $nombre_imagen;

        // Mover la nueva imagen al servidor
        if (move_uploaded_file($imagen_tmp, $ruta_destino)) {
            $imagen_final = $nombre_imagen;

            // Opcional: eliminar la imagen anterior si no es la por defecto
            if (file_exists("../img/" . $imagen_actual) && $imagen_actual !== "default.jpg") {
                unlink("../img/" . $imagen_actual);
            }
        } else {
            echo "Error al subir la nueva imagen.";
            exit;
        }
    } else {
        $imagen_final = $imagen_actual; // Conservar la imagen anterior
    }

    // Actualizar en la base de datos
    $sql = "UPDATE habitacion SET 
                nombre = '$nombre', 
                dotacion = '$dotacion', 
                telefono_encargado = '$telefono_encargado',
                precio = $precio,
                disponibilidad = $disponibilidad,
                imagen = '$imagen_final'
            WHERE id_habitacion = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../administrador/index_admin.php?actualizado=1");
        exit;
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
    }
} else {
    echo "Acceso no autorizado.";
}
?>


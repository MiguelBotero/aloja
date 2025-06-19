<?php 

include "../config/conexion.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $nombre_completo = $_POST['nombre_completo'];
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $telefono_huesped = $_POST['telefono_huesped'];
    $origen = $_POST['origen'];
    $nombre_contacto = $_POST['nombre_contacto'];
    $telefono_contacto = $_POST['telefono_contacto'];
    $observaciones = $_POST['observaciones'];
    
    $sql = "INSERT INTO huesped (nombre_completo, tipo_documento, numero_documento, telefono_huesped, origen, nombre_contacto, telefono_contacto, observaciones) 
            VALUES ('$nombre_completo', '$tipo_documento', '$numero_documento', '$telefono_huesped', '$origen', '$nombre_contacto', '$telefono_contacto', '$observaciones')";

    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        echo "<script>alert('registro exitoso'); window.location.href='../administrador/formulario.php'</script>";
    } else {
        echo "<script>alert('Error al guardar el registro: ". mysqli_error($conexion) ."'); window.location.href='../administrador/formulario.php' </script>";
    }

}
?>
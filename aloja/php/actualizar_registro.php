<?php 

include "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_huesped = $_POST['id_huesped'];
    $nombre_completo = $_POST['nombre_completo'];
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $telefono_huesped = $_POST['telefono_huesped'];
    $origen = $_POST['origen'];
    $nombre_contacto = $_POST['nombre_contacto'];
    $telefono_contacto = $_POST['telefono_contacto'];
    $observaciones = $_POST['observaciones'];
    
    $sql = "UPDATE  huesped SET 
                              nombre_completo= '$nombre_completo',
                              tipo_documento = '$tipo_documento',
                              numero_documento= '$numero_documento',
                              telefono_huesped= '$telefono_huesped',
                              origen= '$origen',
                              nombre_contacto= '$nombre_contacto',
                              telefono_contacto= '$telefono_contacto',
                              observaciones= '$observaciones'
                              WHERE id_huesped= $id_huesped";

    $resultado = mysqli_query($conexion, $sql);
    
    if (!$resultado) {
        echo "<script>alert('error al actualizar '); window.location.href='editar_registro.php';</script>";
    } else {
        echo "<script>alert('actualización completa'); window.location.href='../administrador/ver_tablas.php'; </script>";
    }

}
?>
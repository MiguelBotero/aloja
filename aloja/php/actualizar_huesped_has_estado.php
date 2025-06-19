<?php 

include "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_huesped = $_POST['id_huesped'];
    $id_estadia = $_POST['id_estadia'];
    
    $sql = "UPDATE  huesped_has_estado SET 
                              id_huesped = '$id_huesped',
                              id_estadia = '$id_estadia',
                              
                              WHERE id_huesped= $id_huesped";

    $resultado = mysqli_query($conexion, $sql);
    
    if (!$resultado) {
        echo "<script>alert('error al actualizar '); window.location.href='editar_huesped_has_estado';</script>";
    } else {
        echo "<script>alert('actualización completa'); window.location.href='../administrador/ver_tablas.php'; </script>";
    }

}
?>
<?php 

include "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_novedades = $_POST['id_novedades'];
    $descripcion = $_POST['descripcion'];
    $id_estadia = $_POST['id_estadia'];
    
    $sql = "UPDATE  novedades SET 
                              descripcion= '$descripcion',
                              id_estadia = '$id_estadia'
                              
                              WHERE id_novedades= $id_novedades";

    $resultado = mysqli_query($conexion, $sql);
    
    if (!$resultado) {
        echo "<script>alert('error al actualizar '); window.location.href='editar_novedades.php';</script>";
    } else {
        echo "<script>alert('actualización completa'); window.location.href='../administrador/ver_tablas.php'; </script>";
    }

}
?>
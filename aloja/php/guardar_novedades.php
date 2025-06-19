<?php 

include "../config/conexion.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    
    
    $descripcion = $_POST['descripcion'];
    $id_estadia = $_POST['id_estadia'];
    
    

    
    $sql = "INSERT INTO novedades (  descripcion, id_estadia) 
            VALUES ( '$descripcion', '$id_estadia'";

    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        echo "<script>alert('registro exitoso'); window.location.href='../administrador/formulario.php'</script>";
    } else {
        echo "<script>alert('Error al guardar el registro: ". mysqli_error($conexion) ."'); window.location.href='../administrador/formulario.php' </script>";
    }

}
?>
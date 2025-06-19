<?php 

include "../config/conexion.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    
    $id_estadia = $_POST['id_estadia'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $fecha_registro = $_POST['fecha_registro'];
    $costo = $_POST['costo'];
    $id_habitacion = $_POST['id_habitacion'];

    
    $sql = "INSERT INTO estadia ( id_estadia, fecha_inicio, fecha_fin, fecha_registro, costo, id_habitacion) 
            VALUES ( '$id_estadia', '$fecha_inicio', '$fecha_fin', '$fecha_registro', '$costo','$id_habitacion')";

    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        echo "<script>alert('registro exitoso'); window.location.href='../administrador/estadia_admin.php'</script>";
    } else {
        echo "<script>alert('Error al guardar el registro: ". mysqli_error($conexion) ."'); window.location.href='../administrador/estadia_admin.php' </script>";
    }

}
?>
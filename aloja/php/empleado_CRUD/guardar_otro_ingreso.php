<?php 

include "../config/conexion.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    
    $id_otroingreso = $_POST['id_otroingreso'];
    $fecha_registro = $_POST['fecha_registro'];
    $total = $_POST['total'];
    $id_empleado = $_POST['id_empleado'];
   
    
    

    
    $sql = "INSERT INTO tarifa ( id_otroingreso, fecha_registro, total, id_habitacion) 
            VALUES ( '$id_otroingreso', '$fecha_registro', '$total',  'id_empleado' ";

    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        echo "<script>alert('registro exitoso'); window.location.href='../administrador/formulario.php'</script>";
    } else {
        echo "<script>alert('Error al guardar el registro: ". mysqli_error($conexion) ."'); window.location.href='../administrador/formulario.php' </script>";
    }

}
?>
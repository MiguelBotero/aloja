<?php 

include "../config/conexion.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    
    $id_pago = $_POST['id_pago'];
    $fecha_pago = $_POST['fecha_pago'];
    $valor = $_POST['valor'];
    $id_huesped = $_POST['id_huesped'];
    $id_estadia = $_POST['id_estadia'];
    $id_empleado = $_POST['id_empleado'];
    $imagen = $_POST['imagen'];
    $observacios = $_POST['observacion'];
    
    

    
    $sql = "INSERT INTO pagos ( id_pago, fecha_pago, valor, id_huesped, id_estadia, id_empleado, imagen, observacion) 
            VALUES ( '$id_pago', '$fecha_pago', '$valor', 'id_huesped', 'id_estadia', 'id_empleado', 'imagen', 'observacion' ";

    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        echo "<script>alert('registro exitoso'); window.location.href='../administrador/formulario.php'</script>";
    } else {
        echo "<script>alert('Error al guardar el registro: ". mysqli_error($conexion) ."'); window.location.href='../administrador/formulario.php' </script>";
    }

}
?>
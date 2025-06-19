<?php 

include "../config/conexion.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    
    $id_tarifa = $_POST['id_tarifa'];
    $dia = $_POST['dia'];
    $semana = $_POST['semana'];
    $quincena = $_POST['quincena'];
    $mensual = $_POST['mensual'];
    $id_habitacion = $_POST['id_habitacion'];
    
    

    
    $sql = "INSERT INTO tarifa ( id_tarifa,dia, semana, quincena, mensual, id_habitacion) 
            VALUES ( '$id_tarifa', '$dia', '$semana', 'quincena', 'mensual', 'id_habitacion' ";

    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        echo "<script>alert('registro exitoso'); window.location.href='../administrador/formulario.php'</script>";
    } else {
        echo "<script>alert('Error al guardar el registro: ". mysqli_error($conexion) ."'); window.location.href='../administrador/formulario.php' </script>";
    }

}
?>
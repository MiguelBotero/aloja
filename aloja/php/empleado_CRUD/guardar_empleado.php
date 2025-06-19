<?php 

include "../config/conexion.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    
    $id_estadia = $_POST['id_empleado'];
    $nombre_completo = $_POST['nombre_completo'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    

    
    $sql = "INSERT INTO empleado ( id_empleado, nombre_completo, usuario, password) 
            VALUES ( '$id_empleado', '$nombre_completo', '$usuario', '$password')";

    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        echo "<script>alert('registro exitoso'); window.location.href='../administrador/formulario.php'</script>";
    } else {
        echo "<script>alert('Error al guardar el registro: ". mysqli_error($conexion) ."'); window.location.href='../administrador/formulario.php' </script>";
    }

}
?>
<?php 

include "../config/conexion.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $id_huesped = $_POST['id_huesped']?? null;
    $id_estadia = $_POST['id_estadia']?? null;

    if (!$id_huesped || !$id_estadia) {
        echo "<script>alert('faltan datos.'); window.location.href='../administrador/formularios.php'</script>";
        exit;
    }
    
    $sql = "INSERT INTO huesped_has_estado (id_huesped, id_estadia) 
            VALUES ('$id_huesped', '$id_estadia')";

    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        echo "<script>alert('registro exitoso'); window.location.href='../administrador/formulario.php'</script>";
    } else {
        echo "<script>alert('Error al guardar el registro: ". mysqli_error($conexion) ."'); window.location.href='../administrador/formulario.php' </script>";
    }

}
?>
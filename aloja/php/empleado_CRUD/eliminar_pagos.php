<?php 

include "../config/conexion.php";

$id= $_GET['id'];
$sql = "DELETE FROM pagos WHERE id_pago=$id";
$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
    echo "<script>alert('Registro eliminado exitosamente');
    window.location.href='../administrador/ver_tablas.php'</script>";

} else {
    echo "<script>alert('Error al eliminar el registro:'); 
        window.location.href='../administrador/ver_tablas.hp'</script>";
}

?>
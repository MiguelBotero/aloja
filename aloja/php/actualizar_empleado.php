<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_empleado = $_POST['id_empleado'];
    $nombre_completo = $_POST['nombre_completo'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Puedes encriptar el password si lo deseas:
    // $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE empleado
            SET nombre_completo = '$nombre_completo', 
                usuario = '$usuario', 
                password = '$password' 
            WHERE id_empleado = $id_empleado";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../..//ver_tablas_E.php?mensaje=Actualizado");
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
} else {
    echo "Acceso no permitido.";
}
?>

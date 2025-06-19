<?php
include("../config/conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM habitacion WHERE id_habitacion = $id";
    mysqli_query($conexion, $sql);
}

header("Location: ../administrador/ver_tablas.php");
exit();

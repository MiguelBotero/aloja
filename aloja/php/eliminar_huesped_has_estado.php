<?php
include("../config/conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM huesped_has_estado WHERE id_huesped = $id";
    mysqli_query($conexion, $sql);
}

header("Location: ../administrador/ver_tablas.php");
exit();
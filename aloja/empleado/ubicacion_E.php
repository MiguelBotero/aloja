<?php
session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['usuario'])) {
    echo "Sesión no iniciada";
    exit();
}

// Conectar a la base de datos
include('../config/conexion.php');

// Obtener datos del empleado que ha iniciado sesión
$usuario = $_SESSION['usuario'];
$sql = "SELECT usuario FROM empleado WHERE usuario = '$usuario'";
$resultado = mysqli_query($conexion, $sql);
$empleado = mysqli_fetch_assoc($resultado); // <-- aquí sí obtienes el nombre


?>
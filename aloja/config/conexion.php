<?php

$host="localhost";
$user = "root";
$pass = "";
$db= "aloja";

$conexion = mysqli_connect($host,$user,$pass,$db);

if (!$conexion) {
    die("error en la conexión". mysqli_connect_error());
}


?>


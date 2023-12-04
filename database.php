<?php
$hostname = "localhost";
$username = "root";
$password = "sistemas2023";
$database = "adoptare_db";

$conex = mysqli_connect($hostname, $username, $password, $database);

if (!$conex){
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}
?>

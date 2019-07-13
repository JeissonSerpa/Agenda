<?php

//Variables de conexion

$usuario = 'root';
$pass = '';
$host = 'localhost';
$db = 'agendaPHP';

$conn = new mysqli($host, $usuario, $pass, $db);

echo $conn->ping();

?>
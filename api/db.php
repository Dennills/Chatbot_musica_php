<?php
$host = '';
$db   = '';
$user = '';
$pass = ''; // tu contraseña de MySQL si tienes

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
?>
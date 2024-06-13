<?php
    $host = '127.0.0.1:3306';
    $user = 'root';
    $pass = '';
    $db = 'carnes';

// Intenta establecer la conexión
    $conexion = mysqli_connect($host, $user, $pass, $db);
// Verifica si se estableció la conexión
    if (!$conexion) {
        echo ('Error de conexión');
    } else {
    }


?>

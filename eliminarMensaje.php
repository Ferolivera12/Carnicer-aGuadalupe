<?php
include('conexion_be.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Id = $_POST['Id'];
    $usuarioId = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
    // Elimina el mensaje de la tabla soporte
    $sql = $conexion->query("DELETE FROM empleado WHERE id= $Id");
    echo '<script> alert("El empleado se elimino correctamente");</script>';
}else {
    echo "Infomacion no encontrada";
}

$conexion->close();
?>

<?php
include('conexion_be.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoId = $_POST['productoId'];

    $usuarioId = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
    
    // Elimina el producto del carrito en la tabla carrito
    $conexion->query("DELETE FROM carrito WHERE usuario_id = $usuarioId AND producto_id = $productoId");

    echo "Producto eliminado del carrito con éxito";
} else {
    echo "Error en la solicitud";
}

$conexion->close();
?>


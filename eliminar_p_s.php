<?php

    include('conexion_be.php');  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['productoId'];
    
    
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conexion->prepare($sql);

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Registro eliminado con éxito";
    } else {
        echo "Error al eliminar el registro: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>

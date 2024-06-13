<?php 
include('conexion_be.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id = $_POST['Id'];
        $usuarioId = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
        // Elimina el mensaje de la tabla soporte
        $sql = $conexion->query("DELETE FROM productos_con_inventario WHERE id=$Id");
        echo '<script> alert("El producto se elimino correctamente");</script>';
    }else {
        echo '<script> alert("Infomacion no encontrada")</script>';
    }

    
?>
<!--isset($_GET['confirmed']) && $_GET['confirmed'] == 'true' --> 
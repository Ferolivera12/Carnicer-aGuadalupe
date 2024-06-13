<?php 
include('conexion_be.php');
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sq= "SELECT COUNT(*) as count FROM productos_con_inventario WHERE id = '$id'";
    $stmt = $conexion->prepare($sq);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if($row['count'] > 0){
            echo '<script> alert("El proveedor esta ocupado");  
            window.location.href = "proveedor.php";
             </script>';
    }elseif (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        $sql = $conexion->query("DELETE FROM proveedores WHERE id='$id'");
        if ($sql == 1) {
            echo '<script> alert("El proveedor se elimino correctamente");
            </script>';
        } else {
            echo '<div>Error al eliminar</div>';
        }
    }else{
            echo '<script>
            if (confirm("¿Estás seguro que deseas eliminar el proveedor?")) {
                window.location.href = "proveedor.php?id='.$id.'&confirmed=true";
            } else {
                window.location.href = "proveedor.php";
            }
          </script>';
        }
} 
    
?>
<!--isset($_GET['confirmed']) && $_GET['confirmed'] == 'true' -->
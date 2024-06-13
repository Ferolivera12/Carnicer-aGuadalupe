<?php 
include('conexion_be.php');
if (!empty($_POST["registrar"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["img"]) and !empty($_POST["descripcion"]) and !empty($_POST["categoria"]) and !empty($_POST["existencia"]) and !empty($_POST["id_proveedor"]) and !empty($_POST["nombre_proveedor"]) and !empty($_POST["precio_compra"])and !empty($_POST["precio_venta"])and !empty($_POST["fecha_ingreso"])and !empty($_POST["fecha_vencimiento"])) {
    
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $img = $_POST["img"];
        $descripcion = $_POST["descripcion"];
        $categoria = $_POST["categoria"];
        $existencia = $_POST["existencia"];
        $id_proveedor = $_POST["id_proveedor"];
        $nombre_proveedor = $_POST["nombre_proveedor"];
        $precio_compra = $_POST["precio_compra"];
        $precio_venta = $_POST["precio_venta"];
        $fecha_ingreso = $_POST["fecha_ingreso"];
        $fecha_vencimiento = $_POST["fecha_vencimiento"];
        $sql = $conexion->query("INSERT INTO productos_con_inventario(nombre, img, descripcion, categoria, existencia, id_proveedor, nombre_proveedor, precio_compra, precio_venta, fecha_ingreso, fecha_vencimiento) VALUES ('$nombre', '$img', '$descripcion', '$categoria', '$existencia', '$id_proveedor', '$nombre_proveedor', '$precio_compra', '$precio_venta', '$fecha_ingreso', '$fecha_vencimiento')");

        if ($sql === TRUE) {
            echo "<script>
            window.location.href = 'inventario.php';</script>";
         // Redirige a la página de registro exitoso
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            echo "<script>alert('Error al insertar el registro: ".$conexion->error."');</script>";
        }

    } else {
        echo "<script>alert('Alguno de los campos está vacío');</script>";
    }
}

?>
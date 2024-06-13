<?php
if (!empty($_POST["modificar"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["img"]) and !empty($_POST["descripcion"]) and !empty($_POST["categoria"]) and !empty($_POST["existencia"]) and !empty($_POST["id_proveedor"]) and !empty($_POST["nombre_proveedor"])and !empty($_POST["precio_compra"])and !empty($_POST["precio_venta"])and !empty($_POST["fecha_ingreso"])and !empty($_POST["fecha_vencimiento"]) and !empty($_POST["status"])) {
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
        $status = $_POST["status"];
        $sql = $conexion->query("UPDATE productos_con_inventario SET nombre='$nombre', img='$img', descripcion=$descripcion, categoria='$categoria', existencia='$existencia', id_proveedor='$id_proveedor', nombre_proveedor='$nombre_proveedor', precio_compra='$precio_compra', precio_venta='$precio_venta', fecha_ingreso='$fecha_ingreso', fecha_vencimiento='$fecha_vencimiento', status='$status' WHERE id = $id");

        if ($sql === TRUE) {
            echo "<script>alert('Datos actualizados correctamente'); window.location.href = 'index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error al insertar el registro: ".$conexion->error."');</script>";
        }
    } else {
        echo "<script>alert('Error al insertar el registro: revise que ningún campo esté vacío');</script>";
    }
}
?>
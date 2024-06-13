<?php
if (!empty($_POST["modificar"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["contacto"]) and !empty($_POST["telefono"]) and !empty($_POST["correo"]) and !empty($_POST["direccion"])) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $contacto = $_POST["contacto"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $direccion = $_POST["direccion"];
        $sql = $conexion->query("UPDATE proveedores SET nombre='$nombre', contacto='$contacto', telefono=$telefono, correo='$correo', direccion='$direccion' WHERE id = $id");

        if ($sql === TRUE) {
            echo "<script>alert('Datos actualizados correctamente'); window.location.href = 'proveedor.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error al insertar el registro: ".$conexion->error."');</script>";
        }
    } else {
        echo "<script>alert('Error al insertar el registro: revise que ningún campo esté vacío');</script>";
    }
}
?>

<?php
include('conexion_be.php');

if (!empty($_POST["registrar"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["contacto"]) && !empty($_POST["telefono"]) && !empty($_POST["correo"]) && !empty($_POST["direccion"])) {
        $nombre = $_POST["nombre"];
        $contacto = $_POST["contacto"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $direccion = $_POST["direccion"];

        // Verificar si el nombre de proveedor ya existe
        $consulta = $conexion->query("SELECT * FROM proveedores WHERE nombre = '$nombre'");
        if ($consulta->num_rows > 0) {
            echo "<script>alert('El nombre de proveedor ya existe');</script>";
        } else {
            // Insertar el nuevo registro si el nombre no existe
            $sql = $conexion->query("INSERT INTO proveedores(nombre, contacto, telefono, correo, direccion) VALUES ('$nombre', '$contacto', '$telefono', '$correo', '$direccion')");
            
            if ($sql === TRUE) {
                echo "<script>window.location.href = 'proveedor.php';</script>";
                exit(); // Asegura que el script se detenga después de la redirección
            } else {
                echo "<script>alert('Error al insertar el registro: " . $conexion->error . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Alguno de los campos está vacío');</script>";
    }
}
?>

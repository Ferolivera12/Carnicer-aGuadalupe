<?php
include('conexion_be.php'); 
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $alias = $_POST['alias'];
    $apellidop = $_POST['apellidop'];
    $apellido_m = $_POST['apellidom'];
    $telefono = $_POST['telefono'];
    $genero = $_POST['genero'];
    $puesto = $_POST['puesto'];
    $contrasena = $_POST['contrasena'];
    $Id = $_POST['Id'];

    $usuarioId = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;

    $sql = "UPDATE empleado SET nombre = ?, apellidop = ?, apellido_m = ?, alias = ?, telefono = ?, genero = ?, puesto = ?, contrasena = ? WHERE id = ? ";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param("sssssssss", $nombre, $apellidop, $apellido_m, $alias, $telefono, $genero, $puesto, $contrasena, $Id);

    if ($stmt->execute()) {
        echo "Los datos se han actualizado del empleado con éxito";
        echo "<script> alert('Agregado'); </script>";
    } else {
        echo "Error al agregar el empleado: " . $stmt->error;
        echo "<script> alert('Error al agregar'); </script>";
    }

    $stmt->close();
    $conexion->close();
    
} else {
    echo "Infomacion no encontrada";
}
header('Location: sopor.php');
    exit();
?>
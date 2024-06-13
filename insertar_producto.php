<?php
include('conexion_be.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidop = $_POST['apellidop'];
    $apellido_m = $_POST['apellidom'];
    $telefono = $_POST['telefono'];
    $genero = $_POST['genero'];
    $puesto = $_POST['puesto'];
    $contrasena = $_POST['contrasena'];

    // Divide el nombre completo en partes
    $partesNombre = explode(" ", $nombre);
   // Obtiene el primer nombre o el nombre completo si es un solo nombre
   $primerNombre = $partesNombre[0];
   if (count($partesNombre) == 1) {
    $aliasNombre = $nombre;
   } else {
    $aliasNombre = $primerNombre;
   }

    $letras = strtolower(substr($apellidop, 0, 1)) . strtolower(substr($apellido_m, 0, 1));
    $digitos = substr($telefono, -2);
    $alias = $aliasNombre. $letras . $digitos;

    $mysqli = new mysqli("127.0.0.1:33062", "root", "", "carnes1");
    if ($mysqli->connect_error) {
        die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
    }

    $nombre1 = $mysqli->real_escape_string($nombre);
    $apell1 = $mysqli->real_escape_string($apellidop);
    $apell2 = $mysqli->real_escape_string($apellido_m);
    $contra =$mysqli->real_escape_string($contrasena);
        
    $query = "SELECT * FROM empleado WHERE nombre = '$nombre1' and apellidop = '$apell1' and apellido_m = '$apell2' ";
    $result = $mysqli->query($query);
        
    if ($result->num_rows > 0) {
        echo "<script> alert('Usuario ya esta registrado. Intente con otros datos y contraseña'); </script>";
        header("refresh:3;url=sopor.php");
        exit;
    } else {
    $sql = "INSERT INTO empleado (nombre, apellidop, apellido_m, alias, telefono, genero, puesto, contrasena)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param("ssssssss", $nombre, $apellidop, $apellido_m, $alias, $telefono, $genero, $puesto, $contrasena);

    
    if ($stmt->execute()) {
        echo "Empleado agregado con éxito";
    } else {
        echo "Error al insertar el empleado: " . $stmt->error;
    }
    }
    $stmt->close();
    $conexion->close();

    header('Location: sopor.php');
    exit();
}
?>
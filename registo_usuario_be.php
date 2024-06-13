<?php

    include 'conexion_be.php';

    $nombre_completo = $_POST['nombre'];
    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'];
    $telefono = $_POST['telefono'];
        $genero = $_POST['genero'];
        $contrasena = $_POST['contrasena'];

        $sql = $conexion->query("INSERT INTO empleado (nombre,apellido_p,apellido_m,telefono,genero,contrasena) 
        VALUES ('$nombre_completo','$apellido_p', '$apellido_m','$telefono','$genero','$contrasena');");


    $ejecutar = mysqli_query($conexion,$sql);

    if($ejecutar){
        echo '
        <script> 
        alert("Usuario registrado exitosamente");
        window.location ="log_reg.php";
        </script>
        ';
    } else{
        echo '
        <script> 
        alert("Intentelo de nuevo, usuario no");
        window.location ="../log_reg.php";
        </script>
        ';
    }

    mysqli_close($conexion);
?>


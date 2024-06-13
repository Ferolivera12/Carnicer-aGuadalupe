<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/iconos.png" type="icono"> 
  <title>Base </title>
</head>

<body>
   <?php
  include 'conexion_be.php';
 
  session_start();
// Obtener el ID del usuario actual (reemplaza esto con la lógica real para obtener el ID del usuario)
  
   $usuarioId = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;

   $nombre= $_POST['nombre'];
   $mensaje = $_POST['mensaje'];
   $correo = $_POST['correo'];
   $numero = $_POST['numero'];
   
   $sql =  $conexion->query("INSERT INTO soporte (usuario_id, nombre, mensaje, correo, numero) 
   VALUES ('$usuarioId','$nombre','$mensaje','$correo','$numero');");

    if ($sql==1) {
        echo  '<script> 
        alert("Se ha enviado correctamente tu solicitud");
        window.location ="soporte.php";
        </script>';
       
    } else {
        echo '<script> 
        alert("No se envio tu solicitud");
        window.location ="soporte.php";
        </script>';
    }
   ?> 
   <br>
    <button><a href="soporte.html"></a>Vamos de vuelta </button>

</body>
</html>
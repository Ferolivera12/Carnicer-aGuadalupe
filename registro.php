<?php
include 'conexion_be.php';

// if (!empty($_POST["btn-registro"])){
    if (!empty($_POST["nombre"]) and !empty($_POST["apellido_p"]) and !empty($_POST["apellido_m"]) and !empty($_POST["telefono"])
    and !empty($_POST["genero"]) and !empty($_POST["contrasena"] )) {
        // echo "Todo ok";

        $nombre = $_POST['nombre'];
        $apellido_p = $_POST['apellido_p'];
        $apellido_m = $_POST['apellido_m'];
        $telefono = $_POST['telefono'];
        $genero = $_POST['genero'];
        $contrasena = $_POST['contrasena'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            $mysqli = new mysqli("127.0.0.1:33062", "root", "", "carnes");
        
            if ($mysqli->connect_error) {
                die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
            }
        
            $nombre1 = $mysqli->real_escape_string($nombre);
            $apell1 = $mysqli->real_escape_string($apellido_p);
            $apell2 = $mysqli->real_escape_string($apellido_m);
        
            $query = "SELECT * FROM empleado WHERE nombre = '$nombre1' and apellidop = '$apell1' and apellido_m = '$apell2' ";
            $result = $mysqli->query($query);
        
            if ($result->num_rows > 0) {
                echo "<script> alert('Usuario ya esta registrado. Intente con otro'); </script>";
                header("refresh:3;url=log_reg.php");
                exit;
            } else {
                $sql = $conexion->query("INSERT INTO empleado (nombre,apellidop,apellido_m, telefono, genero,contrasena) 
        VALUES ('$nombre','$apellido_p','$apellido_m','$telefono','$genero','$contrasena');");

        if ($sql==1) {
            echo '
            <script> 
            alert("Usuario registrado exitosamente");
            window.location ="log_reg.php";
            </script>
            ';
           
        } else {
            echo '
            <script> 
            alert("Intentelo de nuevo, usuario no registrado");
            window.location ="log_reg.php";
            </script>
            ';
        }
            }
        
            $mysqli->close();
        }

    } else {
        echo '
        <script> 
        alert("Campos si completar");
        window.location ="log_reg.php";
        </script>
        ';
    }
    
// }else {
//     echo "algo paso";
// }
?>
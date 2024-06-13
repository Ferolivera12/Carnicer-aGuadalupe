<!-- buscar_usuario.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $mysqli = new mysqli("127.0.0.1:33062", "root", "", "intento");

    if ($mysqli->connect_error) {
        die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
    }

    $email = $mysqli->real_escape_string($email);

    $query = "SELECT * FROM usuarios WHERE correo_electronico = '$email'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        header("Location: actContrase.html?email=$email");
        exit;
    } else {
        echo "<script> alert('Correo erroneo. Intente de nuevo'); </script>";
        header("refresh:3;url=recuperarCuenta.html");
        exit;
    }

   
} $conexion->close();
?>
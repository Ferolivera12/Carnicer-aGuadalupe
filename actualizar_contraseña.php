<!-- cambiar_contrasena.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $nuevaContrasena = $_POST["password"];

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    $mysqli = new mysqli("127.0.0.1:33062", "root", "", "intento");

    // Verificar la conexión
    if ($mysqli->connect_error) {
        die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
    }

    // Sanitizar la entrada para evitar inyección SQL
    $email = $mysqli->real_escape_string($email);

    $hashNuevaContrasena = password_hash($nuevaContrasena, PASSWORD_BCRYPT);

    $query = "UPDATE usuarios SET contrasena = '$hashNuevaContrasena' WHERE correo_electronico = '$email'";
    $result = $mysqli->query($query);

    if ($result) {
        echo "<script> alert('Contraseña exitosamente cambiada. Puede iniciar sesion'); </script>";
        header("refresh:3;url=log_reg.html");
        exit;
    } else {
        echo "<script> alert('Hubo un error al cambiar la contraseña. Intenta nuevamente.'); </script>";
        header("refresh:3;url=recuperarCuenta.html");
        exit;
    }

    // Cerrar la conexión a la base de datos
}
?>


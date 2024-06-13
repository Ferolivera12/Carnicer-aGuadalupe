<?php
include 'conexion_be.php';
session_start();
$alias = $_POST["alias"];
$contrasena = $_POST["txtcontrasena"];

$buscandousu = mysqli_query($conexion,"SELECT * FROM empleado WHERE alias = '$alias' and contrasena = '$contrasena' ");
$nr = mysqli_num_rows($buscandousu);
$sql = "SELECT id, alias, contrasena, puesto FROM empleado WHERE alias = '$alias' and contrasena= '$contrasena' ";
$result = $conexion->query($sql);

if ($result->num_rows >= 0) {

$row = $result->fetch_array();
$alias= $row['alias'];
$pass=  $row['contrasena'];
$puesto=$row['puesto'];


if($puesto === "Administrador"){
    $_SESSION['usuarioingresando']=$row['id'];
    $_SESSION['alias']=$row['alias'];
    $_SESSION['contrasena']=$row['contrasena'];
    $_SESSION['puesto']=$row['puesto'];
    echo "<script>var alias = '$alias';</script>";
    echo '<script> alert("El usuario " + alias +" administrador accedio"); 
    window.location ="sopor.php";
</script>';
}else if($nr == 1){
$_SESSION['usuarioingresando']=$row['id'];
echo "<script>var alia = '$alias';</script>";
echo '<script>
 alert("Empleado "+alia+" accedio"); 
 window.location ="ventas_prod.php";
</script>';
}
else if ($nr == 0) {
echo '<script> alert("Usuario no existe"); 
window.location ="log_reg.php";
</script>';
}
}

?>
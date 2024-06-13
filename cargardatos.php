<?php
include('conexion_be.php');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Realizar una consulta para obtener los datos (ajusta según tu estructura de base de datos y consulta)
$resultado = $conexion->query("SELECT * FROM productos;");

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Convertir los resultados a un array asociativo
    $datos = array();
    while ($fila = $resultado->fetch_assoc()) {
        $valores_divididos = array_map('trim', explode('"<"', $fila['descripcion']));
        
        // Filtrar elementos vacíos resultantes del proceso anterior
        $valores_divididos = array_filter($valores_divididos);
        
       //    $valores_divididos = explode('<', $fila['descripcion']);
        
        // Agregar los valores divididos como parte de los registros de la fila
        $fila['descripcion_clara'] = $valores_divididos;
        
        unset($fila['descripcion']);
        
        $datos[] = $fila;
    }
    
    // Enviar los datos como JSON al cliente
    header('Content-Type: application/json');
    echo json_encode($datos);
} else {
    echo "No se encontraron datos en la base de datos.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

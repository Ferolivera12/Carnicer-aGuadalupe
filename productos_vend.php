<?php
require 'conexion_be.php';
session_start();

// Verifica si existe la sesión y si está definida la variable id_empleado en la sesión
if (!isset($_SESSION['usuarioingresando'])) {
    echo "Error: ID de empleado no encontrado en la sesión.";
    exit; // Terminar el script
}
$id_empleado = $_SESSION['usuarioingresando'];

// Función para generar un número de serie único más corto
function generarNumeroSerie()
{
    $fecha = date('YmdHis');
    $uniqueId = substr(md5(uniqid(mt_rand(), true)), 0, 6); // Genera un ID único de 6 caracteres
    return $fecha . $uniqueId;
}

// Generar la fecha de la venta
$fecha_venta = date('Y-m-d H:i:s');

// Generar el número de serie único para la venta
$numero_serie = generarNumeroSerie();

// Convierte el JSON a array
$productos = json_decode($_POST['json'], true);

// Recorrer el arreglo de productos
foreach ($productos as $producto) {
    // Extraer datos del producto
    $codigo_prod = $producto['id'];
    $nombre = $producto['nombre'];
    $cantidad = $producto['cantidad'];
    $precio = $producto['precio'];
    $total = $producto['total'];

    // Obtener la categoría del producto desde la base de datos
    $query_categoria = "SELECT categoria FROM productos_con_inventario WHERE codigo_produc = '$codigo_prod'";
    $resultado_categoria = mysqli_query($conexion, $query_categoria);

    if ($resultado_categoria && mysqli_num_rows($resultado_categoria) > 0) {
        $fila_categoria = mysqli_fetch_assoc($resultado_categoria);
        $categoria = $fila_categoria['categoria'];
    } else {
        // Manejo de error si no se encuentra la categoría
        $categoria = 'Desconocida'; // Puedes ajustar esto según tus necesidades
    }

    // Insertar los datos en la tabla ventas
    $guardar = mysqli_query($conexion, "INSERT INTO ventas (numero_serie, id_empleado, codigo_produc, nombre_producto, 
    categoria_producto, cantidad_producto, precio_producto, fecha_venta, total_producto) VALUES 
    ('$numero_serie', '$id_empleado', '$codigo_prod', '$nombre', '$categoria', '$cantidad', '$precio', '$fecha_venta', '$total')");

    if (!$guardar) {
        echo "Error al guardar el producto con código $codigo_prod: " . mysqli_error($conexion);
        exit; // Terminar el script en caso de error
    }

    // Actualizar la cantidad del producto en la tabla productos_con_inventario
    $query_actualizar_inventario = "UPDATE productos_con_inventario SET existencia = existencia - '$cantidad' WHERE codigo_produc = '$codigo_prod'";
    $actualizar_inventario = mysqli_query($conexion, $query_actualizar_inventario);

    if (!$actualizar_inventario) {
        echo "Error al actualizar el inventario del producto con código $codigo_prod: " . mysqli_error($conexion);
        exit; // Terminar el script en caso de error
    }
}

echo "Todos los productos han sido guardados correctamente.";

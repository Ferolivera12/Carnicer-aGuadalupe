<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar dato en input</title>
</head>
<body>
    <?php
    // Establecer la conexión con la base de datos
    $conexion = mysqli_connect("127.0.0.1:33062", "root", "", "carnes1");
    
    // Verificar la conexión
    if (mysqli_connect_errno()) {
        echo "Error al conectar con la base de datos: " . mysqli_connect_error();
        exit();
    }

    // Verificar si se ha enviado un dato mediante el formulario
    if(isset($_POST['dato_seleccionado'])) {
        $dato_seleccionado = $_POST['dato_seleccionado'];
        
        // Consulta para obtener el dato de la base de datos
        $query = "SELECT * FROM productos_con_inventario WHERE id = $dato_seleccionado";
        $resultado = mysqli_query($conexion, $query);

        // Verificar si se encontraron resultados
        if ($resultado) {
            $fila = mysqli_fetch_assoc($resultado);
            $dato = $fila['nombre']; // Reemplaza 'nombre_del_campo' con el nombre del campo que deseas mostrar
        } else {
            echo "Error al obtener el dato de la base de datos.";
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="dato_seleccionado">Seleccionar dato:</label>
        <select name="dato_seleccionado" id="dato_seleccionado">
            <!-- Aquí puedes cargar los datos desde la base de datos -->
            <?php
            $query_select = "SELECT id FROM productos_con_inventario";
            $resultado_select = mysqli_query($conexion, $query_select);

            while ($row = mysqli_fetch_assoc($resultado_select)) {
                echo "<option value='".$row['id']."' >" . $row['id'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Mostrar">
    </form>

    <!-- Mostrar el dato seleccionado en un input -->
    <?php if(isset($dato)) { ?>
        <label for="input_dato">Dato seleccionado:</label>
        <input type="text" id="input_dato" name="input_dato" value="<?php echo $dato; ?>" readonly>
    <?php } ?>

    <?php mysqli_close($conexion); ?>
</body>
</html>

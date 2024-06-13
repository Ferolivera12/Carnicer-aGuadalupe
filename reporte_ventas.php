<!DOCTYPE html>
<html lang="en">
<?php
include 'conexion_be.php';
session_start();
$id = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
$corre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 0;
$sql = "SELECT nombre FROM empleado WHERE id = '$id' ";

$sql1 = "SELECT contrasena FROM empleado WHERE id = '$id' ";
$result1 = $conexion->query($sql1);

// Crear una consulta SQL
$sql2 = "SELECT id, nombre, precio_venta FROM productos_con_inventario";
// Ejecutar la consulta
$result3 = $conexion->query($sql2);
$rows = $result3->fetch_array();

$ids= $rows['id'];
$sql3 = "SELECT nombre, precio_venta FROM productos_con_inventario WHERE id = '$ids' ";
$res = $conexion->query($sql3);
$rowt = $res->fetch_assoc();

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repoorte de ventas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="Stylesheet" href="estilos_tblResultados.css">
    <link rel="Stylesheet" href="estilos3.css">

</head>

<body>
<header>
        <div>
            <nav>
                <input type="checkbox" id="menuToggle">
                <label for="menuToggle" class="hamburger">&#9776;</label>
                <div class="contas">
                    <img src="log.png" alt="Carniceria">
                    <div id="logo">
                        <h1>Carniceria Guadalupe</h1>
                        <h2><b>REPORTE DE VENTAS</b></h2>
                    </div>
                </div>
                <ul class="nav-list">
                    <li class="nav-item dropdown">
                        <a class=" d-lg-inline dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false"><strong>Ventas</strong></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item " href="ventas_prod.php">Ventas</a></li>
                            <li><a class="dropdown-item" href="prod_disp.php">Productos disponibles</a></li>
                        </ul>
                    </li>
                    <li><a href="reporte_ventas.php" role="button">Reporte de Ventas</a></li>
                    <li><a href="">Pedidos</a></li>
                    <li>
                        <div class="d-lg-inline btn-group" role="group">
                            <button type="button" class="d-lg-inline btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php
                                $sql1 = "SELECT nombre FROM empleado WHERE id = '$id' ";
                                $result = $conexion->query($sql1);
                                $row = $result->fetch_assoc();
                                $partes_nombre = explode(" ", $row['nombre']);
                                echo "<div class='d-lg-inline'>$partes_nombre[0]</div> ";
                                ?>
                                <span> <i class="bi bi-person-square"></i></span>
                            </button>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="logout.php">Cerrar sesion</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>


    <p>Reporte de ventas</p>

    

    <?php
    //validamos datos del servidor
    include 'conexion_be.php';
    //$consulta = "SELECT * FROM tabla where id ='2'"; si queremos que nos muestre solo un registro en específico de ID
    $consulta = "SELECT * FROM ventas";
    $result = $conexion->query($consulta);
    if (!$result) {
        echo "No se ha podido realizar la consulta";
    }
    echo '<table id="tablitadeuwu">';
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Empleado</th>";
    echo "<th>Producto id</th>";
    echo "<th>Nombre del roducto</th>";
    echo "<th>Categoria</th>";
    echo "<th>Cantidad</th>";
    echo "<th>Precio</th>";
    echo "<th>Fecha de venta</th>";
    echo "<th>Total del producto</th>";
    echo "</tr>";

    while ($colum = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $colum['id'] . "</td>";
        echo "<td>" . $colum['id_empleado'] . "</td>";
        echo "<td>" . $colum['id_producto'] . "</td>";
        echo "<td>" . $colum['nombre_producto'] . "</td>";
        echo "<td>" . $colum['categoria_producto'] . "</td>";
        echo "<td>" . $colum['cantidad_producto'] . "</td>";
        echo "<td>" . $colum['precio_producto'] . "</td>";
        echo "<td>" . $colum['fecha_venta'] . "</td>";
        echo "<td>" . $colum['total_producto'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    $query = "SELECT SUM(total_producto) AS total_producto FROM ventas";
    $result = $conexion->query($query);

    // Check query result
    if ($result) {
        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($result);

        // Extract the total sales value
        $totalSales = $row['total_producto'];

        // Display the total sales
        echo "Total ventas: $" . $totalSales;
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
    }
    mysqli_close($conexion);
    ?><div>
        <button id="btnExportar">Guardar Reporte</button>
    </div>

    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>
    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>

    <script>
        const $btnExportar = document.querySelector("#btnExportar"),
            $tabla = document.querySelector("#tablitadeuwu");

        $btnExportar.addEventListener("click", function() {
            let tableExport = new TableExport($tabla, {
                exportButtons: false,
                filename: "Reporte_Ventas_",
                sheetname: "Reporte_Ventas_",
            });
            let datos = tableExport.getExportData();
            let preferenciasDocumento = datos.tablitadeuwu.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
        });
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script><!-- comment -->


</html>
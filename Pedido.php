<!DOCTYPE html>
<?php
include 'conexion_be.php';
session_start();
$usuId = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
$corre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 0;
$sql = "SELECT * FROM empleado ";
$result = $conexion->query($sql);

// Crear una consulta SQL
$sql2 = "SELECT id, nombre, precio_venta FROM productos_con_inventario";
// Ejecutar la consulta
$result3 = $conexion->query($sql2);
$rows = $result3->fetch_array();

$ids = $rows['id'];
$sql3 = "SELECT nombre, precio_venta FROM productos_con_inventario WHERE id = '$ids' ";
$res = $conexion->query($sql3);
$rowt = $res->fetch_assoc();

?>
<html>

<head>
  <link rel="shortcut icon" href="log.png" type="icono">
  <title>Proveedor</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo3.css">
  <link rel="stylesheet" href="estil.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.css">
  <!--Links de las apis requeridas-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<style>
  @media print {
    body * {
      visibility: hidden;
      /* Oculta todos los elementos */
    }

    .printable,
    .printable * {
      visibility: visible;
      /* Muestra solo los elementos con la clase 'printable' y sus descendientes */
    }

    .printable {
      position: absolute;
      left: 0;
      top: 0;
    }
  }
</style>

<header>
  <div>
    <nav>
      <input type="checkbox" id="menuToggle">
      <label for="menuToggle" class="hamburger">&#9776;</label>
      <div class="contas">
        <img src="log.png" alt="Carniceria">
        <div id="logo" class="txtmov">
          <h1>Carniceria Guadalupe</h1>
        </div>
      </div>
      <ul class="nav-list">
        <li>
          <h2 class="d-lg-inline">
            Bienvenid@
            <?php
            $sql2 = "SELECT nombre FROM empleado WHERE id = '$usuId' ";
            $results = $conexion->query($sql2);
            $row2 = $results->fetch_assoc();
            $partes_nombre = explode(" ", $row2['nombre']);
            echo "<h2 class='d-lg-inline'>$partes_nombre[0]</h2> ";
            ?>

          </h2>
        </li>
      </ul>
    </nav>
  </div>
</header>
<section class="app">
  <aside class="sidebar">
    <nav class="sidebar-nav">

      <ul>
        <li>
          <a href="#"><i class="bi bi-person-lines-fill d-lg-inline"></i><span class="d-lg-inline">Empleados</span></a>
          <ul class="nav-flyout">
            <li>
              <a href="sopor.php">Empleados</a>
            </li>
            <li>
              <a href="insertarP.php">Agregar empleado</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="bi bi-box-seam d-lg-inline"></i><span class="d-lg-inline">Inventario</span></a>
          <ul class="nav-flyout">
            <li>
              <a href="inventario.php">Inventario</a>
            </li>
            <li>
              <a href="registrar_producto.php">Agregar producto</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="proveedor.php"><i class="bi bi-person-video2 d-lg-inline"></i> <span class="d-lg-inline">Proveedor</span></a>
          <ul class="nav-flyout">
            <li>
              <a href="proveedor.php">Proveedores</a>
            </li>
            <li>
              <a href="proveedor_form.php">Agregar proveedor</a>
            </li>
            <li>
              <a href="Pedido.php">Pedido a proveedor</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="bi bi-person-fill"></i>
            <?php
            $sql1 = "SELECT nombre FROM empleado WHERE id = '$usuId' ";
            $results = $conexion->query($sql1);
            $row2 = $results->fetch_assoc();
            $partes_nombre = explode(" ", $row2['nombre']);
            echo "<div class='d-lg-inline'>$partes_nombre[0]</div> ";
            ?> </a>
          <ul class="nav-flyout">
            <li>
              <a href="logout.php">Cerrar sesion</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </aside>
</section>
<?php
// Verificar si se ha enviado un dato mediante el formulario
if (isset($_POST['dato_seleccionado'])) {
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
<div class="row w-75 m-auto pb-3 pt-4">
  <main class="container">
    <div class="printable row pt-5" id="texto">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xxl-12 " id="title">
          <h1>PEDIDOS A PROVEDORES</h1>
        </div>
        <p>A continuación se lista lo que hace falta en el stock del inventario.</p>
      </div>

      <div class="accordion pt-4" id="accordionPanelsStayOpenExample">
        <div class="tabla-container"> <!-- Contenedor para centrar y ajustar el ancho -->
          <?php
          // Ajusta tu consulta SQL para obtener los productos cuyo stock sea menor que el stock mínimo y calcular la cantidad que les hace falta, agrupados por categoría
          $sql = "SELECT categoria, nombre, existencia, stock_ideal, proveedor_nombre FROM productos_con_inventario WHERE existencia < stock_ideal ORDER BY categoria";
          $result2 = $conexion->query($sql);

          $currentCategory = ""; // Variable para almacenar la categoría actual

          if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
              $categoria = $row['categoria'];
              $nombre = $row['nombre'];
              $stock = $row['stock_ideal'];
              $existencia = $row['existencia'];
              $pedido = $stock - $existencia;
              $proveedor = $row['proveedor_nombre'];

              // Comprobar si la categoría actual es diferente de la categoría anterior
              if ($categoria != $currentCategory) {
                // Si es diferente, cerrar la tabla anterior (si existe) y comenzar una nueva tabla para la nueva categoría
                if ($currentCategory != "") {
                  echo "</tbody></table>";
                }
                echo "<h2 class='text-center'>$categoria</h2>"; // Mostrar el nombre de la categoría como título de la tabla
                echo "<table id='table' class='table table-striped table-bordered mb-4' >"; // Agregar clases de Bootstrap para el diseño de la tabla
                echo "<thead><tr><th>Producto</th><th>Pedido</th><th>Proveedor</th></tr></thead><tbody>";
                $currentCategory = $categoria; // Actualizar la categoría actual
              }

              // Imprimir fila para el producto actual
              echo "<tr><td>$nombre</td><td>$pedido</td><td>$proveedor</td></tr>";
            }

            // Cerrar la última tabla después de procesar todos los productos
            echo "</tbody></table>";
            echo "<div class='text-center'>";
            echo "<button class='btn btn-primary mb-4' onclick='window.print()'>Exportar a PDF</button>"; // Botón para exportar a PDF
            echo "</div>";
          } else {
            echo "<h3 class='text-center'>No hay productos por pedir</h3>";
          }
          ?>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

        </div>

      </div>

    </div>
  </main>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
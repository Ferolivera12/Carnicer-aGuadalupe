<!DOCTYPE html>
<html lang="es">
<?php
include 'conexion_be.php';
session_start();
$usuId = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
$corre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 0;
$sql = "SELECT * FROM empleado ";
$result = $conexion->query($sql);

$sq = "SELECT nombre, puesto FROM empleado WHERE id = '$usuId' ";
$res = $conexion->query($sq);

if ($_SESSION['puesto'] !== 'Administrador') {
  header('Location: log_reg.php');
  exit();
}

// Consulta SQL para seleccionar todas las categorías
$sql_categorias = "SELECT DISTINCT categoria FROM productos_con_inventario";
$resultado_categorias = $conexion->query($sql_categorias);

// Consulta SQL para obtener los nombres de proveedores
$sql_proveedores = "SELECT id, nombre FROM proveedores";
$resultado_proveedores = $conexion->query($sql_proveedores);

// Consulta SQL para obtener los valores únicos de status
$sql_status = "SELECT DISTINCT status FROM productos_con_inventario";
$resultado_status = $conexion->query($sql_status);
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo3inv.css">
  <link rel="stylesheet" href="estilinve.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <title>Inventario</title>
</head>
<header>
  <div>
    <nav>
      <input type="checkbox" id="menuToggle">
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
            echo "<h2 class='d-lg-inline'>$partes_nombre[0]</h2>";
            ?>
          </h2>
        </li>
      </ul>
    </nav>
  </div>
</header>

<body>
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

  <div class="container d-flex justify-content-center">

    <form class="row pt-3 text-end" method="POST">
      <h2 class="text-center text-secondary pt-3">Registro de producto</h2>
      <?php
      include "conexion_be.php";
      ?>

      <div class="col-md-4 mb-3">
        <label for="codigo_produc" class="form-label">Código Producto</label>
      </div>
      <div class="col-md-8 pb-3">
        <input type="text" class="form-control" name="codigo_produc" placeholder="Escribe el Codigo del Producto" required>
      </div>

      <div class="col-md-4 pb-3">
        <label for="nombre" class="form-label">Nombre</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control" name="nombre" placeholder="Escribe el Nombre del Producto" required>
      </div>

      <div class="col-md-4 pb-3">
        <label for="img" class="form-label">URL de la imagen</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control" name="img" placeholder="Ej: Pollito_Chiken.jpg">
      </div>

      <div class="col-md-4 pb-3">
        <label for="descripcion" class="form-label">Descripción</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control" name="descripcion" placeholder="Describe las caracteristicas del Producto" required>
      </div>

      <div class="col-md-4 pb-3">
        <label for="categoria" class="form-label" required>Categoría</label>
      </div>
      <div class="col-md-8">
        <select class="form-select" name="categoria" id="categoria" placeholder="Selecciona la categoria a la que pertenece" required>
          <?php
          while ($row = $resultado_categorias->fetch_assoc()) {
            $categoria = $row['categoria'];
            echo "<option value='$categoria'>$categoria</option>";
          }
          ?>
          <option value="otra">Otra</option>
        </select>
      </div>

      <div class="col-md-4 d-none pb-3" id="divNuevaCategoria">
        <label for="nueva_categoria" class="form-label">Nueva Categoría</label>
      </div>
      <div class="col-md-8 d-none" id="divNuevaCategoriaInput">
        <input type="text" class="form-control" name="nueva_categoria" id="nueva_categoria" placeholder="Ingresa la nueva categoría">
      </div>


      <div class="col-md-4 pb-1">
        <label for="nombre_proveedor" class="form-label">Nombre Proveedor</label>
      </div>
      <div class="col-md-8">
        <select class="form-select" name="proveedor_nombre" placeholder="Selecciona el Nombre del Proveedor" required>
          <?php
          while ($row = $resultado_proveedores->fetch_assoc()) {
            $idpro = $row['id'];
            $nombre_proveedor = $row['nombre'];
            echo "<option value='$nombre_proveedor'>$nombre_proveedor</option>";
          }
          ?>
        </select>
      </div>

      <div class="col-md-4 pb-3">
        <label for="existencia" class="form-label">Existencia</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control" name="existencia" placeholder="Ingresa la existencia" required>
      </div>

      <div class="col-md-4 pb-3">
        <label for="precio_compra" class="form-label">Precio Compra</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control" name="precio_compra" placeholder="Ingresa la Cantidad" required>
      </div>

      <div class="col-md-4 pb-3">
        <label for="precio_venta" class="form-label">Precio Venta</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control" name="precio_venta" placeholder="Ingresa la Cantidad" required>
      </div>

      <div class="col-md-4 pb-3">
        <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
      </div>
      <div class="col-md-8">
        <input type="date" class="form-control" name="fecha_ingreso" placeholder="Seleeciona la Fecha" required>
      </div>

      <div class="col-md-4 pb-3">
        <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
      </div>
      <div class="col-md-8">
        <input type="date" class="form-control" name="fecha_vencimiento" placeholder="Seleeciona la Fecha" required>
      </div>

      <div class="col-md-4 pb-3">
        <label for="status" class="form-label">Status</label>
      </div>
      <div class="col-md-8">
        <select class="form-select" name="status" placeholder="Seleeciona el Status al que corresponda" required>
          <?php
          while ($row = $resultado_status->fetch_assoc()) {
            $status = $row['status'];
            echo "<option value='$status'>$status</option>";
          }
          ?>
        </select>
      </div>

      <div class="col-md-4 pb-3">
        <label for="stock_ideal" class="form-label">Stock Ideal</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control" name="stock_ideal" placeholder="Ingresa el Stock Deseado" required>
      </div>
      <div class="col-12 text-center">
        <button type="submit" class="mb-2 mt-1 btn-hover btn btn btn-primary" name="registrar" value="ok">Registrar</button>
        <a href="inventario.php" class="mb-2 mt-1 btn-hover btn btn btn-danger" role="button" aria-disabled="true">Cancelar</a>
      </div>
    </form>
  </div>
  <script>
    document.getElementById('categoria').addEventListener('change', function() {
      var divNuevaCategoria = document.getElementById('divNuevaCategoria');
      var divNuevaCategoriaInput = document.getElementById('divNuevaCategoriaInput');
      if (this.value === 'otra') {
        divNuevaCategoria.classList.remove('d-none');
        divNuevaCategoriaInput.classList.remove('d-none');
      } else {
        divNuevaCategoria.classList.add('d-none');
        divNuevaCategoriaInput.classList.add('d-none');
      }
    });
  </script>

  <footer class="footcolor">
    <div class="contenedor">
      <div class="section">
        <i class="fab fa-facebook-f"></i> CarniceriaGuadalupe Oaxaca<br>
        <i class="fab fa-instagram"></i> Guadalupe<br>
        <i class="fab fa-facebook-messenger"></i>Carniceria Guadalupe oax<br>
      </div>
      <div class="section">
        <h4 class="pt-2">Horario</h4>
        <i>
          <img src="img/hora.png" class="img-fluid" width="20" height="20">
        </i> Lunes- Viernes: 9:00 AM - 8:00 PM <br>
        Sabado: 10:00 AM - 3:00 PM <br>
      </div>
      <div class="section">
        <p align="center">&copy; 2024 Carniceria Guadalupe</p>
      </div>
    </div>
  </footer>
</body>

</html>

<?php
include "conexion_be.php";
if (isset($_POST['registrar']) && $_POST['registrar'] == 'ok') {
  $pron = $_POST['proveedor_nombre'];
  $stmt = $conexion->prepare("SELECT id FROM proveedores WHERE nombre = ?");
  $stmt->bind_param("s", $pron);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  // Recuperar los valores del formulario
  $codigo_produc = $_POST['codigo_produc'];
  $nombre = $_POST['nombre'];
  $img = $_POST['img'];
  $descripcion = $_POST['descripcion'];
  $categoria = $_POST['categoria'];
  $categoria = $_POST['categoria'] === 'otra' ? $_POST['nueva_categoria'] : $_POST['categoria'];
  $id = $row['id'];
  $proveedor_nombre = $_POST['proveedor_nombre'];
  $existencia = $_POST['existencia'];
  $precio_compra = $_POST['precio_compra'];
  $precio_venta = $_POST['precio_venta'];
  $fecha_ingreso = $_POST['fecha_ingreso'];
  $fecha_vencimiento = $_POST['fecha_vencimiento'];
  $status = $_POST['status'];
  $stock_ideal = $_POST['stock_ideal'];

  // Consulta SQL para insertar los datos en la tabla
  $sql = "INSERT INTO productos_con_inventario (codigo_produc, nombre, img, descripcion, categoria, existencia, id_proveedor, proveedor_nombre, precio_compra, precio_venta, fecha_ingreso, fecha_vencimiento, status, stock_ideal) 
            VALUES ('$codigo_produc', '$nombre', '$img', '$descripcion', '$categoria', '$existencia', '$id', '$proveedor_nombre', '$precio_compra', '$precio_venta', '$fecha_ingreso', '$fecha_vencimiento', '$status', '$stock_ideal')";

  // Ejecutar la consulta
  if ($conexion->query($sql) === TRUE) {
    echo "<script>window.location.href = 'inventario.php';</script>";
  } else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
  }
}
?>
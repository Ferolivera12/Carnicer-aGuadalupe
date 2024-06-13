<!DOCTYPE html>
<html lang="es">
<?php
include 'conexion_be.php';
session_start();
$usuId = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
$corre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 0;

if ($_SESSION['puesto'] !== 'Administrador') {
  header('Location: log_reg.php');
  exit();
}

// Consulta SQL para seleccionar todas las categorías
$sql_categorias = "SELECT DISTINCT categoria FROM productos_con_inventario";
$resultado_categorias = $conexion->query($sql_categorias);

// Consulta SQL para obtener los nombres de proveedores
$sql_proveedores = "SELECT nombre FROM proveedores";
$resultado_proveedores = $conexion->query($sql_proveedores);

// Consulta SQL para obtener los valores únicos de status
$sql_status = "SELECT DISTINCT status FROM productos_con_inventario";
$resultado_status = $conexion->query($sql_status);

// Verificar si se ha enviado un ID de producto para editar
if (isset($_GET['id'])) {
  $id_producto = $_GET['id'];
  // Consulta SQL para obtener los datos del producto a editar
  $sql_producto = "SELECT * FROM productos_con_inventario WHERE id = $id_producto";
  $resultado_producto = $conexion->query($sql_producto);
  $producto = $resultado_producto->fetch_assoc();
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilos3.css">
  <link rel="stylesheet" href="estilinven.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/1439916399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icon@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  
  <title>Editar Producto</title>
</head>
<header>
  <div>
  <nav>
    <input type="checkbox" id="menuToggle">
    <label for="menuToggle" class="hamburger">&#9776;</label>
    <div class="contas"> 
      <img src="log.png" alt="Carniceria" >
      <div id="logo"  class="txtmov">      
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
          </ul>
        </li>
        <li>
          <a href="#"><i class="bi bi-person-fill"></i> 
          <?php
          $sql1 = "SELECT nombre FROM empleado WHERE id = '$usuId' ";
          $results = $conexion->query($sql1);
          $row2 = $results->fetch_assoc();
          $partes_nombre = explode(" ", $row2['nombre']);
          echo "<div class='d-lg-inline'>$partes_nombre[0]</div>";  
          ?> 
          </a>
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
  
    <form class="row " method="post">
      <h2 class="text-center text-secondary pt-3 pb-3">Editar Producto</h2>

      <div class="col-md-4 pb-3 text-end">
        <label for="codigo_produc" class="form-label">Código</label>
      </div>
      <div class="col-md-8 pb-3 ">
        <input type="text" class="form-control" name="codigo_produc" value="<?php echo $producto['codigo_produc']; ?>">
      </div>

      <div class="col-md-4 pb-3 text-end">
        <label for="nombre" class="form-label">Nombre</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control" name="nombre" value="<?php echo $producto['nombre']; ?>">
      </div>

      <div class="col-md-4 pb-3 text-end">
        <label for="img" class="form-label">URL de la Imagen</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control" name="img" value="<?php echo $producto['img']; ?>">
      </div>

      <div class="col-md-4 pt-3 pb-3 text-end">
        <label for="descripcion" class="form-label">Descripción</label>
      </div>
      <div class="col-md-8 pb-3">
        <textarea class="form-control" name="descripcion"><?php echo $producto['descripcion']; ?></textarea>
      </div>

      <div class="col-md-4 pb-3 text-end">
        <label for="categoria" class="form-label">Categoría</label>
      </div>
      <div class="col-md-8">
        <select class="form-select" name="categoria">
          <?php while ($fila = $resultado_categorias->fetch_assoc()) { ?>
            <option value="<?php echo $fila['categoria']; ?>" <?php echo ($producto['categoria'] == $fila['categoria']) ? 'selected' : ''; ?>>
              <?php echo $fila['categoria']; ?>
            </option>
          <?php } ?>
        
        </select>
      </div>

      <div class="col-md-4 text-end">
        <label for="nombre_proveedor" class="form-label">Proveedor</label>
      </div>
      <div class="col-md-8 pb-3">
        <select class="form-select" name="proveedor_nombre">
          <?php while ($fila = $resultado_proveedores->fetch_assoc()) { ?>
            <option value="<?php echo $fila['nombre']; ?>" <?php echo ($producto['proveedor_nombre'] == $fila['nombre']) ? 'selected' : ''; ?>>
              <?php echo $fila['nombre']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="col-md-4 text-end">
        <label for="existencia" class="form-label">Existencia</label>
      </div>
      <div class="col-md-8 pb-3">
        <input type="text" class="form-control" name="existencia" value="<?php echo $producto['existencia']; ?>">
      </div>


      <div class="col-md-4 text-end">
        <label for="precio_compra" class="form-label">Precio de Compra</label>
      </div>
      <div class="col-md-8">
        <input type="number" class="form-control" name="precio_compra" value="<?php echo $producto['precio_compra']; ?>">
      </div>

      <div class="col-md-4 text-end">
        <label for="precio_venta" class="form-label">Precio de Venta</label>
      </div>
      <div class="col-md-8 pb-3">
        <input type="number" class="form-control" name="precio_venta" value="<?php echo $producto['precio_venta']; ?>">
      </div>

      <div class="col-md-4 text-end">
        <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
      </div>
      <div class="col-md-8 pb-3">
        <input type="text" class="form-control fecha" name="fecha_ingreso" value="<?php echo $producto['fecha_ingreso']; ?>">
      </div>

      <div class="col-md-4 text-end">
        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control fecha" name="fecha_vencimiento" value="<?php echo $producto['fecha_vencimiento']; ?>">
      </div>

      <div class="col-md-4 text-end">
        <label for="status" class="form-label">Status</label>
      </div>
      <div class="col-md-8 pb-3">
        <select class="form-select" name="status">
          <?php while ($fila = $resultado_status->fetch_assoc()) { ?>
            <option value="<?php echo $fila['status']; ?>" <?php echo ($producto['status'] == $fila['status']) ? 'selected' : ''; ?>>
              <?php echo $fila['status']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="col-md-4 text-end">
        <label for="stock_ideal" class="form-label">Stock Ideal</label>
      </div>
      <div class="col-md-8">
        <input type="number" class="form-control" name="stock_ideal" value="<?php echo $producto['stock_ideal']; ?>">
      </div>

      <div class="col-12 text-center">
        <button type="submit" class="mb-2 mt-1 btn-hover btn btn-primary" name="editar" value="ok">Guardar Cambios</button>
        <a href="inventario.php" class="mb-2 mt-1 btn-hover btn btn-danger" role="button" aria-disabled="true">Cancelar</a>
      </div>
    </form>
</div>

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
<script>
  $(document).ready(function(){
    $('.fecha').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true
    });
  });
</script>
</body>
</html>

<?php
if (isset($_POST['editar']) && $_POST['editar'] == 'ok') {
    // Recuperar los valores del formulario
    $id = $producto['id']; // ID del producto a editar
    $codigo_produc = $_POST['codigo_produc'];
    $nombre = $_POST['nombre'];
    $img = $_POST['img'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'] === 'otra' ? $_POST['nueva_categoria'] : $_POST['categoria'];
    $proveedor_nombre = $_POST['proveedor_nombre'];
    $existencia = $_POST['existencia'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $status = $_POST['status'];
    $stock_ideal = $_POST['stock_ideal'];

    // Consulta SQL para actualizar los datos del producto
    $sql = "UPDATE productos_con_inventario SET 
            codigo_produc = '$codigo_produc', 
            nombre = '$nombre', 
            img = '$img', 
            descripcion = '$descripcion', 
            categoria = '$categoria', 
            proveedor_nombre = '$proveedor_nombre', 
            existencia = '$existencia',
            precio_compra = '$precio_compra', 
            precio_venta = '$precio_venta', 
            fecha_ingreso = '$fecha_ingreso', 
            fecha_vencimiento = '$fecha_vencimiento', 
            status = '$status', 
            stock_ideal = '$stock_ideal' 
            WHERE id = $id";

    // Ejecutar la consulta
      if ($conexion->query($sql) === TRUE) {
        echo "<script>window.location.href = 'inventario.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>
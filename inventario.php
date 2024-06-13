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
?>

<head>
  <link rel="shortcut icon" href="log.png" type="icono">
  <title>Inventario</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo3inv.css">
  <link rel="stylesheet" href="estilinve.css">
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
  <!-- -->
  <?php
  include "conexion_be.php";

  $mostrarRegistros = false; // Variable para controlar la visibilidad de la tabla
  $alerta = ''; // Variable para almacenar el mensaje de alerta

  // Obtener el término de búsqueda y la columna de búsqueda si se ha enviado el formulario de búsqueda
  // Inicialización de variables
  $limite = 3; // Valor por defecto de registros por página
  $pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $inicio = ($pagina - 1) * $limite;

  // Manejo de filtros
  $where = "";
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['opcion']) && $_POST['opcion'] != 0) {
      $limite = (int)$_POST['opcion'];
    }

    if (isset($_POST['columna']) && !empty($_POST['dato'])) {
      $colum = $conexion->real_escape_string($_POST['columna']);
      $data = $conexion->real_escape_string($_POST['dato']);
      $where .= " AND $colum LIKE '%$data%'";
    }
  }

  // Consulta de datos con filtros y paginación
  $sql = "SELECT * FROM productos_con_inventario WHERE 1=1 $where LIMIT $inicio, $limite";
  $result = $conexion->query($sql);

  // Consulta para contar el total de registros
  $sql_total = "SELECT COUNT(id) AS total FROM productos_con_inventario WHERE 1=1 $where";
  $result_total = $conexion->query($sql_total);
  $row_total = $result_total->fetch_assoc();
  $total_registros = $row_total['total'];
  $total_paginas = ceil($total_registros / $limite);
  ?>

  <section class="m-auto w-75" id="tabla">
    <section id="inventario" class="w-100 m-50 pb-4 pt-2">
      <form method="POST" class="d-md-inline pb-2" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="opcion">Limite:</label>
        <select name="opcion" id="opcion">
          <option value="" selected disabled>Selecciona</option>
          <option value="2">2</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <input type="submit" value="Visualizar" class="mb-2 mt-1 btn-hover btn btn btn-success">

        <label for="columna">Buscar por:</label>
        <select name="columna" id="columna">
          <option value="codigo_produc">Codigo Producto</option>
          <option value="nombre">Nombre</option>
          <option value="categoria">Categoria</option>
          <option value="proveedor_nombre">Proveedor</option>
        </select>
        <label for="dato">Ingresa el dato:</label>
        <input type="text" name="dato" id="dato">
        <input type="submit" value="Obtener" class="mb-2 mt-1 btn-hover btn btn btn-success">
      </form>
    </section>

    <table class="table table-bordered">
      <thead class="bg-info">
        <tr>
          <th scope="col">Codigo Producto</th>
          <th scope="col" class="col-2">Nombre</th>
          <th scope="col">Img</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Categoria</th>
          <th scope="col">Existencia</th>
          <th scope="col">Proveedor</th>
          <th scope="col">Precio Compra</th>
          <th scope="col">Precio Venta</th>
          <th scope="col">Fecha Ingreso</th>
          <th scope="col">Fecha Vencimiento</th>
          <th scope="col">Stock Ideal</th>
          <th scope="col" class="col-8 text-center" colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($datos = $result->fetch_assoc()) {
        ?>
            <tr>
              <td><?= $datos['codigo_produc'] ?></td>
              <td><?= $datos['nombre'] ?></td>
              <td><img src="uploads/<?= $datos['img'] ?>" alt="<?= $datos['descripcion'] ?>" style="max-width: 100px; max-height: 100px;"></td>
              <td><?= $datos['descripcion'] ?></td>
              <td><?= $datos['categoria'] ?></td>
              <td><?= $datos['existencia'] ?></td>
              <td><?= $datos['proveedor_nombre'] ?></td>
              <td><?= $datos['precio_compra'] ?></td>
              <td><?= $datos['precio_venta'] ?></td>
              <td><?= $datos['fecha_ingreso'] ?></td>
              <td><?= $datos['fecha_vencimiento'] ?></td>
              <td><?= $datos['stock_ideal'] ?></td>
              <td>
                <a href="modificar_inventario.php?id=<?= $datos['id'] ?>" class="mb-2 mt-1 btn-hover btn btn btn-success" style="--bs-btn-padding-y: .15rem; --bs-btn-padding-x: .15rem;"><i class="fa-solid fa-pen-to-square"></i><span class="d-lg-inline">Editar</span></a>

                <a href="" onclick="<?php echo " elimMsj({$datos['id']}) "; ?>" class="mb-2 mt-1 btn-hover btn btn btn-danger" style="--bs-btn-padding-y: .15rem; --bs-btn-padding-x: .15rem;"><i class="bi bi-trash"></i><span class="d-lg-inline">Eliminar</span></a>
              </td>
            </tr>
        <?php
          }
        } else {
          echo "<article class='col-12 pb-5'><p><h3>No se encontró ningún resultado</h3></p></article>";
        }
        ?>

      </tbody>
    </table>
    <div aria-label="Page navigation example w-75">
      <div class="row w-100">
        <ul class="pagination justify-content-end">

          <?php if ($pagina > 1) { ?>
            <li class="page-item">
              <a class="page-link" href="inventario.php?page=<?php echo $pagina - 1 ?>  ">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
          <?php } ?>

          <?php for ($x = 1; $x <= $total_paginas; $x++) { ?>
            <li class="<?php if ($x == $pagina) echo "active" ?>">
              <?php
              echo "<a class='page-link' href='?page=$x'>$x</a>";
              ?>
            </li>
          <?php } ?>

          <?php if ($pagina < $total_paginas) { ?>
            <li class="page-item">
              <a class="page-link" href="inventario.php?page=<?php echo $pagina + 1 ?>  ">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </section>

  <script>
    function elimMsj(Id) {
      // Realiza una solicitud AJAX para eliminar el empleado
      var confirmar = confirm("¿Estás seguro de que deseas eliminar este producto?");
      // Si el usuario hace clic en "Aceptar"
      if (confirmar) {
        $.ajax({
          type: 'POST',
          url: 'eliminar_prod.php', // Crea este archivo para manejar la solicitud
          data: {
            Id: Id
          },
          success: function(response) {
            // Actualiza la página después de eliminar el producto
            location.reload(true);
          },
          error: function(error) {
            console.error('Error al eliminar el empleado:', error);
          }
        });
      } else {
        // Si el usuario hace clic en "Cancelar", no se hace nada
        console.log('Eliminación cancelada por el usuario');
      }
    }
  </script>



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

</body>

</html>
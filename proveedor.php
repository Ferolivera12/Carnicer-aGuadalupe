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
  <title>Proveedor</title>
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
    if (isset($_POST['resultados_por_pagina']) && $_POST['resultados_por_pagina'] != 0) {
      $limite = (int)$_POST['resultados_por_pagina'];
    }

    if (isset($_POST['columna']) && !empty($_POST['termino'])) {
      $colum = $conexion->real_escape_string($_POST['columna']);
      $data = $conexion->real_escape_string($_POST['termino']);
      $where .= " AND $colum LIKE '%$data%'";
    }
  }

  // Consulta de datos con filtros y paginación
  $sql = "SELECT * FROM proveedores WHERE 1=1 $where LIMIT $inicio, $limite";
  $result = $conexion->query($sql);

  // Consulta para contar el total de registros
  $sql_total = "SELECT COUNT(id) AS total FROM proveedores WHERE 1=1 $where";
  $result_total = $conexion->query($sql_total);
  $row_total = $result_total->fetch_assoc();
  $total_registros = $row_total['total'];
  $total_paginas = ceil($total_registros / $limite);
  ?>

  <?php if (!empty($alerta)) : ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $alerta; ?>
    </div>
  <?php endif; ?>

  <section class="m-auto w-75" id="tabla">
    <!-- Formulario de búsqueda -->
    <section id="productos" class="w-100 m-50 pb-4 pt-2">
      <form method="POST" class="d-md-inline pb-2" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="columna">Buscar por:</label>
        <select name="columna" id="columna">
          <option value="" selected disabled>Selecciona</option>
          <option value="id">ID</option>
          <option value="contacto">Nombre</option>
          <option value="telefono">Teléfono</option>
        </select>
        <label for="termino">ingresa:</label>
        <input type="text" name="termino" id="termino">
        <input type="submit" value="Buscar" class="mb-2 mt-1 btn-hover btn btn-success">

        <label for="resultados_por_pagina">Resultados por página:</label>
        <select name="resultados_por_pagina" id="resultados_por_pagina">
          <option value="" selected disabled>Selecciona</option>
          <option value="2">2</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="10">10</option>
        </select>
        <input type="submit" name="visualizar" value="Visualizar" class="mb-2 mt-1 btn-hover btn btn-primary">
      </form>
    </section>


    <table class="table table-bordered">
      <thead class="bg-info">
        <tr>
          <th scope="col">Id</th>
          <th scope="col" class="col-2">Empresa</th>
          <th scope="col" class="col-2">Nombre</th>
          <th scope="col" class="col-1">Telefono</th>
          <th scope="col" class="col-2">Correo electronico</th>
          <th scope="col" class="col-2">Direccion</th>
          <th scope="col" class="col-3" colspan="2" style="text-align:center;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($datos = $result->fetch_assoc()) {
        ?>
            <tr>
              <th scope="row"><?= $datos['id'] ?></th>
              <td><?= $datos['nombre'] ?></td>
              <td><?= $datos['contacto'] ?></td>
              <td><?= $datos['telefono'] ?></td>
              <td><?= $datos['correo'] ?></td>
              <td><?= $datos['direccion'] ?></td>
              <td>
                <a href="modificar_provedor.php?id=<?= $datos['id'] ?>" class="mb-2 mt-1 btn-hover btn btn-success btn-sm" style="padding: 0.2rem 0.4rem;"><i class="fa-solid fa-pen-to-square"></i><span class="d-lg-inline"> Editar</span></a>
                <a href="eliminar_persona.php?id=<?= $datos['id'] ?>" class="btn btn-small btn-danger btn-sm" style="padding: 0.2rem 0.4rem;"><i class="fa-solid fa-trash"></i> Eliminar</a>
              </td>
            </tr>
      </tbody>
  <?php }
        } else {
          echo "<article class='col-12 pb-5'><p><h3>No se encontró ningún resultado</h3></p></article>";
        } ?>

    </table>

    <div aria-label="Page navigation example w-75">
      <div class="row w-100">
        <ul class="pagination justify-content-end">

          <?php if ($pagina > 1) { ?>
            <li class="page-item">
              <a class="page-link" href="proveedor.php?page=<?php echo $pagina - 1 ?>  ">
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
              <a class="page-link" href="proveedor.php?page=<?php echo $pagina + 1 ?>  ">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </section>


</body>
<footer class="footcolor ">
  <div class="contenedor">
    <div class="section  ">
      <i class="fab fa-facebook-f"></i> CarniceriaGuadalupe Oaxaca<br>
      <i class="fab fa-instagram"></i> Guadalupe<br>
      <i class="fab fa-facebook-messenger"></i>Carniceria Guadalupe oax<br>
    </div>

    <div class="section ">
      <h4 class="pt-2">Horario</h4>
      <i>
        <img src="img/hora.png" class=" img-fluid" width="20" height="20">
      </i> Lunes- Viernes: 9:00 AM - 8:00 PM <br>
      Sabado: 10:00 AM - 3:00 PM <br>
    </div>

    <div class="section ">
      <p align="center">&copy; 2024 Carniceria Guadalupe</p>
    </div>

  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>
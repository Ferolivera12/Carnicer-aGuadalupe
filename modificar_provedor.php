<!doctype html>
<html lang="en">
<?php
include "conexion_be.php";
session_start();
$id=$_GET["id"];
#echo$id;
$sql=$conexion->query(" select * from proveedores where id = $id ");

$usuId = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
$corre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 0;
$sql1 = "SELECT * FROM empleado ";
$result = $conexion->query($sql1);

$sq = "SELECT nombre, puesto FROM empleado WHERE id = '$usuId' ";
$res = $conexion->query($sq);

if ($_SESSION['puesto'] !== 'Administrador') {
  header('Location: log_reg.php');
  exit();
}
?>

<head>
  <title>Editar proveedor</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="estilos3.css">
  <link rel="stylesheet" href="estil.css">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" ></script> 
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
<header>
  <div>
    <nav>
      <input type="checkbox" id="menuToggle">
      <label for="menuToggle" class="hamburger">&#9776;</label>
      <div class="contas">
        <img src="log.png" alt="Carniceria">
        <div id="logo" class="txtmov">
          <h1>ADMINISTRADOR</h1>
          <h2><b>EDITAR PROVEEDOR</b></h2>
        </div>
      </div>
      <ul class="nav-list">
        <li>
          <a class="d-lg-inline dropdown-toggle" data-bs-toggle="dropdown" href="sopor.php" role="button" aria-expanded="false">Empleados</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item " href="sopor.php">Empleados</a></li>
            <li><a class="dropdown-item " href="insertarP.php">Agregar empleado</a></li>
          </ul>
        </li>
        <li><a href="produc.php">Inventario</a></li>
        <li><a href="proveedor.php">Proveedores</a></li>

        <li>
          <div class="d-lg-inline btn-group" role="group">
            <button type="button" class="d-lg-inline btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <?php
              $sql1 = "SELECT nombre FROM empleado WHERE id = '$usuId' ";
              $results = $conexion->query($sql1);
              $row2 = $results->fetch_assoc();
              $partes_nombre = explode(" ", $row2['nombre']);
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
              <a href="#"><i class="ion-ios-alarm-outline"></i>Watch</a>
            </li>
            <li>
              <a href="#"><i class="ion-ios-camera-outline"></i>Creeper</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="proveedor.php"><i class="bi bi-person-video2 d-lg-inline"></i> <span class="d-lg-inline">Proveedor</span></a>
          <ul class="nav-flyout">
            <li>
              <a href="#"><i class="ion-ios-flame-outline"></i>Burn</a>
            </li>
            <li>
              <a href="#"><i class="ion-ios-lightbulb-outline"></i>Bulbs</a>
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
              <a href="#">Cerrar sesion</a>
            </li>
            <li>
              <a href="#"><i class="ion-arrow-graph-down-left"></i>You Lose</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </aside>
</section>
  <main>
  <form class="col-4 m-auto border border-gray" method="post">
    
    <?php
    include "mod_provedor.php";
    while($datos=$sql->fetch_object()){ ?>
    <div class="mb-3 mt-3">
    <label for="exampleInputEmail1" class="form-label">Id</label>
    <input type="text" class="form-control" name="id" value="<?= $datos->id ?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Empresa</label>
    <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="contacto" value="<?= $datos->contacto ?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Telefono</label>
    <input type="text" class="form-control" name="telefono" value="<?= $datos->telefono ?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
    <input type="email" class="form-control" name="correo" value="<?= $datos->correo ?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Direccion</label>
    <input type="text" class="form-control" name="direccion" value="<?= $datos->direccion ?>">
  </div>
  
  <button type="submit" class="mb-3 btn btn-primary" name="modificar" value="ok">Guardar cambios</button>
  <button type="button" onclick="window.location.href='proveedor.php'" class="mb-3 btn btn-warning">Cancelar</button>


      
    <?php }
    ?>
    
  
</form>
  </main>
  <footer class="footcolor ">
  <div class="contenedor ">
   <div class="section footcolor">
       <h3>Carniceria Guadalupe</h3>
       <i class="fab fa-facebook-f"></i> CarniceriaGuadalupe Oaxaca<br>
       <i class="fab fa-instagram"></i> Guadalupe<br>
       <i class="fab fa-facebook-messenger"></i>Carniceria Guadalupe oax<br>
   </div>
      
   <div class="section footcolor">
   <h3>Telefonos</h3>
   <i class="fab fa-whatsapp"></i> 9512670254<br>
   <h4 class="pt-2">Horario</h4>
   <i>
   <img src="img/hora.png" class=" img-fluid" width="20" height="20">   
   </i> Lunes- Viernes: 9:00 AM - 8:00 PM <br>
   Sabado: 10:00 AM - 3:00 PM <br>
   </div>
      
  <div class="section footcolor">
  <p align ="center">&copy; 2024 Carniceria Guadalupe</p>   
  </div>
          
</div>   
</footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
  </script>
</body>

</html>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'conexion_be.php';
session_start();
$usuId = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;

$sql1 = "SELECT nombre, puesto FROM empleado WHERE id = '$usuId' ";
$result1 = $conexion->query($sql1);

if ($_SESSION['puesto'] !== 'Administrador') {
  header('Location: log_reg.php');
  exit();
}

?>
<html>

<head>
  <link rel="shortcut icon" href="img/iconos.png" type="icono"> <!--Este es el icono-->
  <title>Carniceria Guadalupe</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo3emp.css">
  <link rel="stylesheet" href="estilemp.css">
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

<body>
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

  <form action="insertar_producto.php" method="post">
    <h2 class="text-center text-secondary pt-3 ">Registro de empleado</h2>
    <div class="border rounded p-2">
      <div class="mb-3 mt-5 row ">
        <label for="nombre" class="col-12 col-md-4 col-form-label text-end">Nombre</label>
        <div class="col-md-8">
          <input type="text" name="nombre" class="form-control" id="nombres" oninput="eliminarNumeros()" placeholder="Escribe el nombre del empleado" required pattern="\^[A-Za-Z]+\" title="Solo escribir letras">
          <span id="txt1"></span>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="apellidop" class="col-12 col-md-4 col-form-label text-end">Primero apellido </label>
        <div class="col-md-8">
          <input type="text" name="apellidop" class="form-control" id="apellido" oninput="elimNum()" placeholder="Escribe el apellido del empleado" required pattern="\^[A-Za-Z]+\" title="Solo escribir letras">
          <span id="txt12"></span>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="apellidom" class="col-12 col-md-4 col-form-label text-end">Segundo apellido</label>
        <div class="col-md-8">
          <input type="text" name="apellidom" class="form-control" id="apells" oninput="eliNum()" placeholder="Escribe el apellido del empleado" required pattern="\^[A-Za-Z]+\" title="Solo escribir letras">
          <span id="txt13"></span>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="telefono" class="col-12 col-md-4 col-form-label text-end">Telefono</label>
        <div class="col-md-8">
          <input type="text" name="telefono" class="form-control" id="telef" oninput="Alias(), eliLetras()" placeholder="Escribe el numero" required pattern="\^[0-9]+$\" maxlength="10" title="Solo escribir números">
          <span id="txt2"></span>
        </div>
      </div>


      <div class="mb-3 row">
        <label for="alias" class="col-12 col-md-4 col-form-label text-end">Nombre de usuario</label>
        <div class="col-md-8">
          <p id="aliass" name="alias"></p>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="genero" class="col-12 col-md-4 col-form-label text-end">Genero</label>
        <div class="col-md-8">
          <select id="genero" name="genero" class="form-control" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
          </select>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="puesto" class="col-12 col-md-4 col-form-label text-end">Puesto</label>
        <div class="col-md-8">
          <select id="puesto" name="puesto" class="form-control" required>
            <option value="Empleado">Empleado</option>
            <option value="Administrador">Administrador</option>
          </select>
        </div>
      </div>

      <div class="mb-4 row">
        <label for="contrasena" class="col-12 col-md-4 col-form-label text-end">Contraseña</label>
        <div class="col-md-8">
          <input type="text" name="contrasena" class="form-control" id="contra" oninput="Contra()" placeholder="Escribe la contraseña" required pattern="[A-Za-z0-9]+" title="Solo escribir números y letras">
          <span id="txt3"></span>
        </div>
      </div>
    </div>
    <div class="text-end col-12">
      <button type="submit" class="mb-2 w-25 mt-1 btn-hover btn btn btn-primary">Guardar</button>
      <button type="button" onclick="redirigir()" class="w-25 btn-hover btn btn btn-danger">Cancelar</button>
    </div>
  </form>

  <script>
    function redirigir() {
      window.location.href = 'sopor.php';
    }

    function Alias() {
      var nombre = document.getElementById("nombres").value.trim();
      var apellP = document.getElementById("apellido").value;
      var apellm = document.getElementById("apells").value;
      var telefono = document.getElementById("telef").value.trim();
      // Concatenar los valores y realizar alguna transformación, como mayúsculas o minúsculas
      var apell = apellP.charAt(0).toLowerCase();
      var apelle = apellm.charAt(0).toLowerCase();
      var alias = nombre.split(' ')[0] + apell.substr(0, 1) + apelle.substr(0, 1) + telefono.substr(-2);
      // Mostrar el alias generado en un elemento HTML
      document.getElementById("aliass").innerHTML = alias;
    }
  </script>


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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script><!-- comment -->
  <script src="validar.js"></script>

</body>

</html>
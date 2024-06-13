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
<script>
  function validarTelefono() {
    var x, t;
    var patron = /^[0-9]{10}$/;
    t = document.getElementById("telefono");
    x = t.value;
    var tele = patron.test(x);
    if (!tele) {
      var tex = "Ingresa 10 números, campo obligatorio";
      t.value = "";
      t.style.border = '1px solid red';
      document.getElementById("txtTelefono").innerHTML = tex;
      return false;
    } else {
      t.style.border = '1px solid #C0F3EF';
      document.getElementById("txtTelefono").innerHTML = "";
      return true;
    }
  }

  function validarCorreo() {
    var x, t;
    var patron = /\S+@\S+\.\S+/;
    t = document.getElementById("correo");
    x = t.value;
    var corr = patron.test(x);
    if (!corr) {
      var tex = "Correo electrónico no válido";
      t.value = "";
      t.style.border = '1px solid red';
      document.getElementById("txtCorreo").innerHTML = tex;
      return false;
    } else {
      t.style.border = '1px solid #C0F3EF';
      document.getElementById("txtCorreo").innerHTML = "";
      return true;
    }
  }

  function validarNombre() {
    var x, t;
    var patrone = /^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]$/;
    t = document.getElementById("nombre");
    x = document.getElementById("nombre").value;
    var valn = patrone.test(x);
    var mayu = x.charAt(0) !== x.charAt(0).toUpperCase();
    if (!valn && mayu) {
      var tex;
      tex = "Campo obligatorio, ingresa letras con la primera letra en mayusycula";
      t.value.replace(/[^a-zA-Z\s]/g, '');
      t.value = "";
      t.style.border = '1px solid red';
      document.getElementById("txt1").innerHTML = tex;
    } else {
      t.style.border = '1px solid #C0F3EF';
      tex = "";
      document.getElementById("txt1").innerHTML = tex;
    }
  }

  function validarProveedor() {
    var x, t;
    var patrone = /^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]$/;
    t = document.getElementById("contacto");
    x = document.getElementById("contacto").value;
    var valn = patrone.test(x);
    var mayu = x.charAt(0) !== x.charAt(0).toUpperCase();
    if (!valn && mayu) {
      var tex;
      tex = "Campo obligatorio, ingresa letras con la primera letra en mayusycula";
      t.value.replace(/[^a-zA-Z\s]/g, '');
      t.value = "";
      t.style.border = '1px solid red';
      document.getElementById("txt2").innerHTML = tex;
    } else {
      t.style.border = '1px solid #C0F3EF';
      tex = "";
      document.getElementById("txt2").innerHTML = tex;
    }
  }

  function validarDireccion() {
    var x, t;
    t = document.getElementById("direccion");
    x = t.value;
    if (x.length > 50) {
      var tex = "La dirección no debe exceder los 50 caracteres";
      t.value = "";
      t.style.border = '1px solid red';
      document.getElementById("txtDireccion").innerHTML = tex;
      return false;
    } else {
      t.style.border = '1px solid #C0F3EF';
      document.getElementById("txtDireccion").innerHTML = "";
      return true;
    }
  }

  function validarFormulario() {
    return validarTelefono() && validarCorreo() && validarDireccion();
  }

  function soloLetras(e) {
    var key = e.keyCode || e.which;
    var tecla = String.fromCharCode(key).toLowerCase();
    var letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    var especiales = [8, 37, 39, 46];

    var tecla_especial = false;
    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      e.preventDefault();
    }
  }

  function soloNumeros(e) {
    var key = e.keyCode || e.which;
    var tecla = String.fromCharCode(key).toLowerCase();
    var numeros = "0123456789";
    var especiales = [8, 37, 39, 46];

    var tecla_especial = false;
    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (numeros.indexOf(tecla) == -1 && !tecla_especial) {
      e.preventDefault();
    }
  }
</script>

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo3.css">
  <link rel="stylesheet" href="estil.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <title>Proveedores</title>
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

  <div class="container-fluid row">
    <form class="col-4" method="post" onsubmit="return validarFormulario()">
      <h2 class="text-center text-secondary pt-3">Registro de proveedor</h2>
      <?php
      include "conexion_be.php";
      include "registro_persona.php";
      ?>

      <div class="mb-3">
        <label for="id" class="form-label">Id</label>
        <input type="text" class="form-control" name="id" id="id" disabled>
      </div>
      <div class="mb-3">
        <label for="nombre" class="form-label">Empresa</label>
        <input type="text" class="form-control" name="nombre" id="nombre" onkeypress="soloLetras(event)" onblur="validarNombre()">
        <span id="txt1"></span>
      </div>
      <div class="mb-3">
        <label for="contacto" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="contacto" id="contacto" onkeypress="soloLetras(event)" onblur="validarProveedor()">
        <span id="txt2"></span>
      </div>
      <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" name="telefono" id="telefono" onkeypress="soloNumeros(event)" onblur="validarTelefono()">
        <div id="txtTelefono" class="text-danger"></div>
      </div>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" name="correo" id="correo" onblur="validarCorreo()">
        <div id="txtCorreo" class="text-danger"></div>
      </div>
      <div class="mb-3">
        <label for="direccion" class="form-label">Dirección</label>
        <input type="text" class="form-control" name="direccion" id="direccion" onblur="validarDireccion()">
        <div id="txtDireccion" class="text-danger"></div>
      </div>
      <div class="col-12 text-center">
        <button type="submit" class="mb-2 mt-1 btn-hover btn btn-primary" name="registrar" value="ok">Registrar</button>
        <a href="proveedor.php" class="mb-2 mt-1 btn-hover btn btn-danger" role="button" aria-disabled="true">Cancelar</a>
      </div>
    </form>
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
</body>

</html>


<?php
include 'conexion_be.php';

if (isset($_POST['nombre'])) {
  $nombre = $_POST['nombre'];

  $sql = "SELECT * FROM proveedores WHERE nombre = '$nombre'";
  $result = $conexion->query($sql);

  if ($result->num_rows > 0) {
    echo "";
  } else {
    echo "";
  }
}
?>
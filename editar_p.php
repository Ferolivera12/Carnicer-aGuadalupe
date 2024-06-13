<?php
include('conexion_be.php');
session_start();
$id = isset($_GET['empleado']) ? $_GET['empleado'] : 0;
// Obtener el ID del usuario actual (reemplaza esto con la lógica real para obtener el ID del usuario)
// Consultar los productos en el carrito del usuario actual
$usuario_id = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;

$sql = "SELECT * FROM empleado WHERE id= '$id' ";

$sql1 = "SELECT nombre FROM empleado WHERE id = '$usuario_id'";

$result1 = $conexion->query($sql1);
$result = $conexion->query($sql);
$row = $result->fetch_assoc();

if($_SESSION['puesto'] !== 'Administrador'){
    header('Location: log_reg.php');
    exit();
}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
       <link rel="shortcut icon" href="log.png" type="icono">
       <title>Carniceria Guadalupe</title>
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
                <img src="log.png" alt="Carniceria" >
            <div class="txtmov">      
                <h1>Carniceria Guadalupe</h1>  
            </div>
            </div>
            <ul class="nav-list">
                <li>
                <div id="texto">
                <h1> Bienvenid@
                <?php
                $sql2 = "SELECT nombre FROM empleado WHERE id = '$usuario_id' ";
                $results = $conexion->query($sql2);
                $row2 = $results->fetch_assoc();
                $partes_nombre = explode(" ", $row2['nombre']);
                echo "<div class='d-lg-inline'>$partes_nombre[0]</div> ";  
                ?> 
                </h1>
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
                $sql1 = "SELECT nombre FROM empleado WHERE id = '$usuario_id' ";
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

        <form action="edicion_producto.php" method="POST" >
        <h2 class="text-center text-secondary pt-2 ">Editar datos</h2>
        <div class="border rounded p-1">
        <div class="mb-3 row pt-4 text-end">
                <label for="Id" class="col-12 col-md-4 col-form-label text-end">Id</label>
                <div class="col-md-8">
                    <input type="text" name="Id" class="form-control" value="<?php echo "{$row['id']}"?>" placeholder="Codigo del producto"
                            title="Solo escribir letras" readonly>
                </div>
            </div>

            <div class="mb-3 row text-end">
                <label for="alias" class="col-12 col-md-4 col-form-label">Nombre de usuario</label> 
                <div class="col-md-8">
                    <input type="text" name="alias" class="form-control" value="<?php echo "{$row['alias']}" ?>" placeholder="Letras con numeros"
                           required pattern="\^[A-Za-Z0-9]+\" title="Solo escribir letras con numeros">
                </div>
            </div>

            <div class="mb-3 row text-end">
                <label for="nombre" class="col-12 col-md-4 col-form-label">Nombre</label>
                <div class="col-md-8">
                    <input type="text" name="nombre" class="form-control" value="<?php echo "{$row['nombre']}"?>" placeholder="Primera letra en mayusculas"
                           required pattern="\^[A-Za-Z]+\" title="Solo escribir letras, la primera letra debe ser en mayusculas">
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="apellidop" class="col-12 col-md-4 col-form-label text-end">Primer apellido</label>
                <div class="col-md-8">
                <input type="text" name="apellidop" class="form-control" value="<?php echo "{$row['apellidop']}"?>" placeholder="Primera letra en mayuscula"
                       required pattern="\^[A-Za-Z]+\" title="Solo escribir letras, la primera letra debe ser en mayuscula">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="apellidom" class="col-12 col-md-4 col-form-label text-end">Segundo apellido</label>
                <div class="col-md-8">
                <input type="text" name="apellidom" class="form-control" value="<?php echo "{$row['apellido_m']}"?>" placeholder="Primera letra en mayuscula"
                       required pattern="\^[A-Za-Z]+\" title="Solo escribir letras, la primera letra debe ser en mayuscula">
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="telefono" class="col-12 col-md-4 col-form-label text-end">Telefono</label>
                <div class="col-md-8">
                    <input type="text" name="telefono" class="form-control" value="<?php echo "{$row['telefono']}"?>" placeholder="Telefono del empleado"
                           required pattern="\^[0-9]+\" maxlength="10" title="Solo escribir números">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="genero" class="col-12 col-md-4 col-form-label text-end">Genero</label>
                <div class="col-md-8">
                           <select id="genero" name ="genero" class="form-control" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="puesto" class="col-12 col-md-4 col-form-label text-end">Puesto</label>
                <div class="col-md-8">
                           <select id="puesto" name ="puesto" class="form-control" required>
                            <option value="Empleado">Empleado</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="contrasena" class="col-12 col-md-4 col-form-label text-end">Contraseña</label>
                <div class="col-md-8">
                <input type="text" name="contrasena" class="form-control" value="<?php echo "{$row['contrasena']}"?>" placeholder="Letras y numeros con mas de 8 caracteres"
                       required pattern="\^[A-Za-z0-9]+$\" title="Escribir letras y numeros" required>
                </div>
            </div>
        </div>
        <div class="text-end col-12">
            <button type="submit" class="mb-2 mt-1 btn-hover btn btn btn-primary">Guardar</button>
            <button type="button"  onclick="redirigir()" class="mb-2 mt-1 btn-hover btn btn btn-danger">Cancelar</button>
        </div>
        </form>

        <script>
            function redirigir() {
            window.location.href = 'sopor.php';
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
  <p align ="center">&copy; 2024 Carniceria Guadalupe</p>   
  </div>
          
</div>   
</footer>

       <script src="Animation.js" ></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script><!-- comment -->    
       <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        
    </body>
</html>

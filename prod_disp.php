<!DOCTYPE html>

<?php
// Incluir la conexión a la base de datos
include 'conexion_be.php';

// Iniciar sesión para recuperar el ID y nombre del usuario
session_start();
$id = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
$corre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : "";

// Función para obtener todos los productos
function getAllProductos()
{
    global $conexion; // Acceso a la conexión global

    $sql = "SELECT * FROM productos_con_inventario";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
        return $productos;
    } else {
        return [];
    }
}

// Obtener productos disponibles
$productos = getAllProductos();

$sql1 = "SELECT contrasena FROM empleado WHERE id = '$id' ";
$result1 = $conexion->query($sql1);
?>
<html>

<head>
    <link rel="shortcut icon" href="log.png" type="icono"> <!--Este es el icono-->
    <title>Carniceria Guadalupe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo3inv.css">
    <link rel="stylesheet" href="estilinve.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="prod_disp.css">
</head>

<body>
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
                <h2 class="d-lg-inline" >
                Bienvenid@
                <?php
                $sql2 = "SELECT nombre FROM empleado WHERE id = '$id' ";
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
                        <a href="#"><i class="bi bi-cart3"></i><span class="d-lg-inline">Ventas</span></a>
                        <ul class="nav-flyout">
                            <li>
                                <a href="ventas_prod.php">Ventas</a>
                            </li>
                            <li>
                                <a href="prod_disp.php">Productos disponibles</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="ver.php"><i class="bi bi-journal-text"></i><span class="d-lg-inline">Reporte de ventas</span></a>

                    </li>
                    <li>
                        <a href="Pedido.php"><i class="bi bi-unity"></i><span class="d-lg-inline">Pedidos</span></a>

                    </li>
                    <li>
                        <a href="#"><i class="bi bi-person-fill"></i>
                            <?php
                            $sql1 = "SELECT nombre FROM empleado WHERE id = '$id' ";
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
<section class="m-auto w-75" id="tabla">
    <div class="container p-1 my-4 text-black">
        <h2>Productos Disponibles</h2>          
        <div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Existencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <td><?php echo $producto['codigo_produc']; ?></td>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td><?php echo $producto['descripcion']; ?></td>
                            <td><?php echo $producto['categoria']; ?></td>
                            <td><?php echo $producto['precio_venta']; ?></td>
                            <td><?php echo $producto['existencia']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
  <p align ="center">&copy; 2024 Carniceria Guadalupe</p>   
  </div>  
</div>   
</footer>



 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script><!-- comment -->
<script src="Animation.js"></script>
</body>
</html>
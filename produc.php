<?php
include('conexion_be.php');
session_start();
// Obtener el ID del usuario actual (reemplaza esto con la lógica real para obtener el ID del usuario)
// Consultar los productos en el carrito del usuario actual
$usuario_id = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
$corre= isset($_SESSION['contrasena']) ? $_SESSION['contrasena'] : 0;
$sql = "SELECT * FROM empleado";

$sql1 = "SELECT nombre, puesto, contrasena FROM empleado WHERE id = '$usuario_id'";
$user = $conexion->query($sql1);

$result= $conexion->query($sql);

if($_SESSION['puesto'] !== 'Administrador'){
    header('Location: log_reg.php');
    exit();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="log.png" type="icono"> <!--Este es el icono-->
        <title>Carniceria Guadalupe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilo.css">
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
            <div id="logo">      
                <h1>ADMINISTRADOR</h1>
                <h2><b>INVENTARIO</b></h2>       
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
                <li><a href="produc.php"><strong>Inventario</strong></a></li>

                <li>
                <div class="d-lg-inline btn-group" role="group">
                <button type="button" class="d-lg-inline btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <?php 
                $raw = $user->fetch_assoc();
                  $partes_nombre = explode(" ", $raw['nombre']);
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
            
        <section id="productos" class="w-75 m-auto pt-2">
                
                <a href="insertarP.php" class="mb-2 mt-1 pt-2 btn-hover btn btn btn-success" role="button"
                   aria-disabled="true">Agregar</a>
            </section>
                
            
            <div class="w-100 d-block mb-5 mt-5 justify-content-center align-items-center" id="tabla">
                <div>
                <div class="row w-100 m-auto justify-content-center align-items-center my-3 my-md-0">    
                <article class="d-none d-md-block col-md-2 border">
                <p class='text-center'><strong>Nombre</strong></p>
                </article>
                <article class="d-none d-md-block col-md-1 border">
                <p class='text-center'><strong>Código</strong></p>
                </article>
                <article class="d-none d-md-block col-md-1 border">
                <p class='text-center'><strong>Precio</strong></p>
                </article>
                <article class="d-none d-md-block col-md-1 border">
                    <p class='text-center'><strong>Stock</strong></p>
                </article>
                <article class="d-none d-md-block col-md-1 border">
                    <p class='text-center'><strong>Categoria</strong></p>
                </article>
                <article class="d-none d-md-block col-md-2 border">
                    <p class='text-center'><strong>Imagen</strong></p>
                </article>
                <article class="d-none d-md-block col-md-2 border">
                    <p class='text-center'><strong>descripcion</strong></p>
                </article>
                <article class="d-none d-md-block col-md-1 border">
                    <p class='text-center'><strong>Editar</strong></p>
                </article>
                <article class="d-none d-md-block col-md-1 border">
                    <p class='text-center'><strong>Eliminar</strong></p>
                </article>
                    </div>
                    <div id="resultados">
<?php
$totalCompra = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $descripcion_corta= substr($row['descripcion'], 0, 25);
        $nombre_corta= substr($row['nombre'], 0, 30);
        echo "  <div class='row w-100 m-auto justify-content-center align-items-center my-3 my-md-0'>
                <article class='col-6 border d-md-none'>
                <p class='text-center'><strong>Nombre</strong></p>
                </article>
                <article class='col-6 d-sm-block d-md-block col-md-2 border'>
                <p class='text-justify'><small>{$nombre_corta}</small></p>
                </article>
                <article class='col-6 border d-md-none'>
                <p class='text-center'><strong>id</strong></p>
                </article>
                <article class='col-6 d-sm-block d-md-block col-md-1 border'>
                <p class='text-center'>{$row['id']}</p>
                </article>
                <article class='col-6 border d-md-none'>
                <p class='text-center'><strong>Precio</strong></p>
                </article>
                <article class='col-6 d-sm-block d-md-block col-md-1 border'>
                <p class='text-center'>{$row['precio']}</p>
                </article>
                <article class='col-6 border d-md-none'>
                <p class='text-center'><strong>Stock</strong></p>
                </article>
                <article class='col-6 d-sm-block d-md-block col-md-1 border'>
                <p class='text-center'>{$row['existencia']}</p>
                </article>
                <article class='col-6 border d-md-none'>
                <p class='text-center'><strong>Categoria</strong></p>
                </article>
                <article class='col-6 d-sm-block d-md-block col-md-1 border'>
                <p class='text-center'>{$row['categoria']}</p>
                </article>
                <article class='col-6 border d-md-none'>
                <p class='text-center'><strong>Imagen</strong></p>
                </article>
                <article class='col-6 d-sm-block d-md-block col-md-2 border'>
                <p class='text-center'><small>{$row['img']}</small></p>
                </article>
                <article class='col-6 border d-md-none'>
                <p class='text-center'><strong>Descripcion</strong></p>
                </article>
                <article class='col-6 d-sm-block d-md-block col-md-2 border'>
                <p><small>{$descripcion_corta}</small></p>
                </article>

                <article class='col-6 border d-md-none'>
                <p class='text-center'><strong>Editar</strong></p>
                </article>
                <article class='col-6 d-sm-block d-md-block col-md-1 border'>
                    <button type='button' onclick='redirigirEdit({$row['id']})' class='mb-2 mt-1 btn-hover btn btn btn-warning' style=' --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .15rem;'>
                        <span class= 'd-md-none d-lg-inline text-center'><small>  Editar </small></span>
                        <span >  <i class='bi bi-pencil-fill '></i></span>
                    </button>
                </article>
                
                <article class='col-6 border d-md-none'>
                <p class='text-center'><strong>Eliminar</strong></p>
                </article>                
                <article class='col-6 d-sm-block d-md-block col-md-1 border'>
                    <button type='button' onclick=\"eliminarProducto({$row['id']})\" class='mb-2 mt-1 btn-hover btn btn btn-danger' style=' --bs-btn-padding-y: .2rem; --bs-btn-padding-x: .2rem;'>
                        <span class= 'text-center d-md-none d-lg-inline'><small>  Eliminar </small></span>
                        <span><small> <i class='bi bi-trash-fill'></i></small></span>
                    </button>
                </article>

                </div>";
    }
} else {
    echo "<h1>La tabla de productos está vacía</h1>";
}
?>
                </div>     
                </div>
            </div>
        
        <script>
        function redirigirEdit(id) {
            window.location.href = 'editar_p.php?producto=' + id;
        }
        
        function eliminarProducto(productoId) {
        // Realiza una solicitud AJAX para eliminar el producto del carrito en el servidor
        $.ajax({
            type: 'POST',
            url: 'eliminar_p_s.php', // Crea este archivo para manejar la solicitud
            data: { productoId: productoId },
            success: function(response) {
                // Actualiza la página después de eliminar el producto
                location.reload(true);
            },
            error: function(error) {
                console.error('Error al eliminar el producto:', error);
            }
        });
    }
      </script>


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
  <img src="log.png" alt="alt" class="img-fluid w-50" width="50" height="25">
  <p align ="center">&copy; 2024 Carniceria Guadalupe</p>   
  </div>
       </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script><!-- comment -->    
        <script src="Animation.js" ></script>
    </body>
</html>
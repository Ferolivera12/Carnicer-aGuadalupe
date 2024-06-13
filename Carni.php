<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'conexion_be.php';
session_start();
$id = isset($_SESSION['usuarioingresando']) ? $_SESSION['usuarioingresando'] : 0;
$corre= isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 0;
$sql = "SELECT nombre FROM empleado WHERE id = '$id' ";

$sql1 = "SELECT contrasena FROM empleado WHERE id = '$id' ";
$result1 = $conexion->query($sql1);


?>
<!--$buscandousu = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo_electronico = '$corre' ");
$nr = mysqli_num_rows($buscandousu);
if ($result1->num_rows >= 0) {

$row = $result1->fetch_array();
$correo=$row['correo_electronico'];
if( $corre === 'root12@gmail.com'){
  header('Location: log_reg.html '); 
  exit();
}
else if($nr == 1){
  $_SESSION['usuarioingresando']=$row['id'];
    header('Location: Tech.php');
}
}-->
<html>
    <head>
        <link rel="shortcut icon" href="log.png" type="icono"> <!--Este es el icono-->
         <title>Carniceria Guadalupe</title>
         <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilo.css">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    
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
                <h1>Carniceria Guadalupe</h1>
                <h2><b>HOME</b></h2>
            </div>
            </div>
            <ul class="nav-list">
                <li><a href="Carni.php"><strong>Home</strong></a></li>
                <li><a href="Qsom.php">Ventas</a></li>
                <li class="nav-item dropdown">
                <a class=" d-lg-inline dropdown-toggle" data-bs-toggle="dropdown" href="productos.php" role="button" aria-expanded="false">Ventas del dia</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item " href="">Laptops</a></li>
                <li><a class="dropdown-item" href="">Componentes y piezas</a></li>
                </ul>
                </li>
                <li><a href="Pedido.php">Pedidos</a></li>
                
                <li>
                <div class="d-lg-inline btn-group" role="group">
                <button type="button" class="d-lg-inline btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <?php 
                $sql1 = "SELECT nombre FROM empleado WHERE id = '$id' ";
                $result = $conexion->query($sql1);
                  $row = $result->fetch_assoc();
                  $partes_nombre = explode(" ", $row['nombre']);
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
         <div id="texto" class="container p-1 my-4 text-black"><!-- pt es su altura my-5 es el espaciado-->
           
           <?php 
                  $result = $conexion->query($sql);
                  $row = $result->fetch_assoc();
                  $partes_nombre = explode(" ", $row['nombre']);

                  echo "<p><h2>BIENVENID@ $partes_nombre[0] <h2></p> ";   
                             
                  ?>

           
          <p>Somos una empresa especializada en la venta de equipos de cómputo y servicios relacionados,
              con una sólida reputación por ofrecer productos de alta calidad y servicios excepcionales.<br>
          Ofrecemos una gran variedad de productos, disponibilidad, precios bajos y seguridad al momento de comprar, 
          son algunos de los beneficios que Tech&Service trae para ti gracias a nuestros 10 años en el mercado. 
          A través de nuestro sitio web  podrás encontrar productos como hardware, computadoras, laptops, y servicios de soporte
          y asesoramiento técnico. Además, nuestro envío asegurado garantiza la tranquilidad de recibir tu mercancía sin preocupaciones.
          
   </p>
        </div>
        <div>   
<div id="carouselEx" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="img/venta.png" class="d-block w-100" alt="..." width="50" height="420">
         <div class="carousel-caption d-md-block text-white" >
        <h5>Tech&Service ofrece equipos de cómputo de calidad y servicio de soporte</h5>
      </div>
           </div>
    <div class="carousel-item">
      <img src="img/sopor.png" class="d-block w-100" alt="..." width="50" height="420">
      <div class="carousel-caption d-md-block text-white" >
        <h5>Tech&Service ofrece servicio de soporte presencial y asesoramiento tecnico en linea</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/contac.png" class="d-block w-100" alt="..." width="50" height="420">
      <div class="carousel-caption d-md-block text-white" >
        <h5>Contactanos por nuestras redes sociales y correo, eres nuestra prioridad</h5>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselEx" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselEx" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
        </div> 
        
         <main class="container">
        <div class="row pt-3" id="texto">
            <div class="col-12">
                <div class="row">
                <div class="col-12 border col-md-12 col-lg-12 col-xxl-12 bg-primary"> <h1>Productos</h1></div>
               </div>
               <div class="row">
                    <div class="col-12 col-md-8 bg-white" id="precio"> <p><b>Laptop Gamer Dell G5 5530 15.6" Full HD, Intel Core i7-13650HX 3.60GHz,
                                16GB, 512GB SSD, NVIDIA GeForce RTX 4050, Windows 11 Home 64-bit, Español, Gris</b> </p>
                 <ul>
                 <li>Familia de procesador: Intel® Core™ i7</li>
                 <li>Diagonal de la pantalla: 39,6 cm (15.6")</li>
                 <li>Memoria interna: 16 GB</li>
                <li>Capacidad total de almacenaje: 512 GB</li>
                <li>Tarjeta de Video: GeForce RTX 4050 </li>
                <li>Sistema operativo instalado: Windows 11 Home</li>
                <li>Idioma del teclado: Español</li>
                </ul>
                <h5> A solo $23,009 pesos</h5>
                <h4> <a href="productos.html">Ver mas</a></h4>
                    </div>
                    <div class="col-12 col-md-4 bg-info"> 
                    <img src="img/lap1.jpg" class="d-block w-100 img-fluid" width="380" height="80">
                    
                    </div>
               </div>
                  <div class="row">
                    <div class="col-12  col-md-8 bg-white" id="precio"> <p><b>Laptop HP 250 G8 15.6" Full HD, Intel Core i5-1135G7 2.40GHz, 16GB, 256GB SSD,
                      Windows 11 Pro 64-bit, Español, Gris</b> </p>
                 <ul>
                     <li>Familia de procesador: <b>Intel® Core™ i5-11xxx</b></li>
                 <li>Diagonal de la pantalla: 39,6 cm (15.6")</li>
                 <li>Memoria interna: 16 GB</li>
                <li>Capacidad total de almacenaje: 256 GB</li>
                <li>Sistema operativo instalado: Windows 11 Pro</li>
                <li>Idioma del teclado: Español</li>
                </ul>
                <h5> A solo $11,659.00 pesos</h5>   
                <h4> <a href="productos.html">Ver mas</a></h4>
                    </div>
                    <div class="col-12 border col-md-4 bg-info"> 
                    <img src="img/lap2.png" class="d-block w-100 img-fluid" width="380" height="80">
                    
                    </div>
               </div>
           </div>
        </div>  
          </main>
        
         <main class="container">
       
        <div class="row pt-5" id="texto">
            <div class="row">
                <div class="col-12 border col-md-12 col-lg-12 col-xxl-12 bg-primary"> <h1>Soporte</h1></div>
               </div>
            
            <div  class="col-4 col-md-4 mb-4"> 
            <img src="img/soport2.jpg" class="d-block w-100 img-fluid" width="580" height="80">
            </div>
            <div class="col-8 bg-white text-black" id="precio" >
                <p><b>El mejor sitio para dar mantenimiento a tu equipo lo encuentras con nosotros.</b>
                <br>Aqui podras solicitar información sobre el mantenimiento preventivo y correctivo que ofrecemos, 
                así dando el servicio de manera presencial. 
                Contamos con un apartado <b>Asesoramiento Técnico</b> donde podrás recibir recomendaciones, 
                soluciones o tips que pueden ser desde selección de hardware hasta actualizaciones y mejoras en tu equipo.</p>
                <h4> <a href="soporte.html">Para mas informacion</a></h4>
            
            </div>
        </div>    
          
          </main>
            
          </body>
            
       
         

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

</html>

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
$sql = "SELECT nombre FROM empleado WHERE id = '$usuId' ";
$result = $conexion->query($sql);
?>
<html>
    <head>
        <link rel="shortcut icon" href="img/iconos.png" type="icono">
        <title>Tech&Service</title>
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
                <h2><b>VENTAS</b></h2>
            </div>
            </div>
            <ul class="nav-list">
                <li><a href="Carni.php">Home</a></li>
                <li><a href="Qsom.php"><strong>Ventas</strong></a></li>
                <li class="nav-item dropdown">
                <a class=" d-lg-inline dropdown-toggle" data-bs-toggle="dropdown" href="productos.php" role="button" aria-expanded="false">Ventas del dia</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item " href="">Laptops</a></li>
                <li><a class="dropdown-item" href="">Componentes y piezas</a></li>
                </ul>
                </li>
                <li><a href="Pedido.php">Pedidos</a></li>

                <div class="d-lg-inline btn-group" role="group">
                <button type="button" class="d-lg-inline btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <?php 
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
            </ul>
        </nav>
         </div>
 </header>     
         
        <main class="container">
        <div class="row pt-5" id="texto">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xxl-12 "> <h1>MISION</h1></div>
               </div>
            <div class="col-6 col-md-8 col-lg-8 col-xxl-8 bg-white text-black" id="quien" >
                 <p>Proporcionar servicios de mantenimiento de computadoras excepcionales y productos de última generación
              que optimicen el rendimiento y la eficiencia de su labor de nuestros clientes  </p>
            </div>
            <div  class="col-6 col-md-4 col-lg-4 col-xxl-4 "> 
            <img src="img/mision.jpg" class="d-block w-100 img-fluid" width="550" height="80">
            </div>
        </div>    
          
          <div class="row pt-5" id="texto">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xxl-12 "> <h1>VISION</h1></div>
            </div> 
            <div  class="col-6 col-md-4 col-lg-4 col-xxl-4 "> 
            <img src="img/vision.jpg" class="d-block w-100 img-fluid" width="580" height="20">
            </div>
            <div class="col-6 col-md-8 col-lg-8 col-xxl-8 bg-white text-black" id="quien" >
                 <p>Ser líderes en la industria de servicios de tecnología y ventas de productos informáticos, 
                     reconocidos por nuestra innovación constante, compromiso con la satisfacción del cliente 
                     y un impacto positivo en la comunidad  </p>
            </div>
        </div>    
        </main>
         <main class="container">
            <div class="row pt-5" id="texto">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xxl-12 "> <h1>VALORES</h1></div>
            </div> 
            <div  class="row " id="valor">
                <div class="col-12 border col-md-4 bg-success" > <h1> Excelencia</h1>
                    <img src="img/exce.png" class="d-block img-fluid" width="280" height="20">
                    <p>Estamos comprometidos en atender a nuestros clientes de la manera mas diligente
                        y con altos estandares de calidad y de seguridad, trabajando de forma eficiente y eficaz</p>
                    </div>
                <div class="col-12 border col-md-4 bg-light"> <h1>Integridad</h1>
                <img src="img/integridad.png" class="d-block img-fluid" width="280" height="20">
                    <p>Trabajamos de forma legal y ética, en cualquier ubicación y en todo lo que hacemos</p>
                
                </div>
                    <div class="col-12 border col-md-4 bg-info"> <h1>Confianza</h1>
                <img src="img/confi.png" class="d-block img-fluid" width="280" height="20">
                    <p>Tenemos palabra en lo que decimos es cierto y sincero, no sólo técnicamente correcto. 
                        Somos abiertos y transparentes en nuestra comunicación mutua y con respecto al desempeño comercial.</p> </div>
              
            </div>
            <div  class="row " id="valor">
                <div class="col-12 border col-md-4 bg-info" > <h1> Compromiso</h1>
                    <img src="img/compro.png" class="d-block img-fluid" width="280" height="20">
                    <p>Mantenemos nuestro compromiso mutuo y con las partes interesadas. Hacemos lo correcto sin compromiso alguno. 
                       Incluso evitamos todo aquello que parezca incorrecto.</p>
                    </div>
                <div class="col-12 border col-md-4 bg-light"> <h1>Conocimiento tecnico</h1>
                <img src="img/conoc.png" class="d-block img-fluid" width="280" height="20">
                    <p>Contamos con personal altamente calificado y especializado en la atencion, asesoramiento y soporte tecnico 
                    ofreciendo un servicio de calidad y aportando valor que nos diferencia de la competencia
                    </p>
                
                </div>
                    <div class="col-12 border col-md-4 bg-success"> <h1>Responsabilidad</h1>
                <img src="img/respo.png" class=" img-fluid" width="180" height="20">
                    <p>Aceptamos las consecuencias de nuestras acciones. 
                    No tomamos represalias contra quienes intentan hacer lo correcto al formular preguntas o plantear preocupaciones.</p> </div>
              
            </div>
        </div> 
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
  <img src="log.png" alt="alt" class="img-fluid w-50" width="50" height="25">
  <p align ="center">&copy; 2024 Carniceria Guadalupe</p>   
  </div>
</div>   
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script><!-- comment -->    
<script src="Animation.js" ></script>
</body>
</html>

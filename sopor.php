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
<html>

<head>
    <link rel="shortcut icon" href="log.png" type="icono">
    <title>Carniceria Guadalupe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo3tab.css">
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
    <?php
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
    $sql = "SELECT * FROM empleado WHERE 1=1 $where LIMIT $inicio, $limite";
    $result = $conexion->query($sql);

    // Consulta para contar el total de registros
    $sql_total = "SELECT COUNT(id) AS total FROM empleado WHERE 1=1 $where";
    $result_total = $conexion->query($sql_total);
    $row_total = $result_total->fetch_assoc();
    $total_registros = $row_total['total'];
    $total_paginas = ceil($total_registros / $limite);
    ?>


    <section class="m-auto w-75" id="tabla">
        <div class="row pt-3" id="texto">
            <div class="col-12 col-md-12 col-lg-12 col-xxl-12">
                <p>Se muestran a los empleados que cuenta el negocio actualmente. Los datos pueden ser actualizados o eliminados.</p>
            </div>
        </div>
        <section id="productos" class="w-100 m-50 pb-4 pt-2">
            <a href="insertarP.php" class="d-md-inline mb-2 mt-1 pt-2 btn-lg btn btn-primary" role="button" aria-disabled="true">Agregar empleado</a>
            <form method="POST" class="d-md-inline pb-2" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="opcion">Limite:</label>
                <select name="opcion" id="opcion">
                    <option value="0">Selecciona</option>
                    <option value="2">2</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="50">50</option>
                </select>
                <input type="submit" value="Visualizar" class="mb-2 mt-1 btn-hover btn btn-success">
                <label for="columna">Buscar por:</label>
                <select name="columna" id="columna">
                    <option value="nombre">Nombre</option>
                    <option value="alias">Usuario</option>
                    <option value="apellidop">Primer apellido</option>
                    <option value="apellido_m">Segundo apellido</option>
                </select>
                <label for="dato">Ingresa el dato:</label>
                <input type="text" name="dato" id="dato">
                <input type="submit" value="Obtener" class="mb-2 mt-1 btn-hover btn btn-success">
            </form>
        </section>
        <div class='row w-100 m-auto pb-3'>
            <article class='d-none d-md-block col-md-2 no-wrap border'>
                <p><strong>Nombre de usuario</strong></p>
            </article>
            <article class='d-none d-md-block col-md-1 no-wrap border'>
                <p><strong>Nombre</strong></p>
            </article>
            <article class='d-none d-md-block col-md-1 border'>
                <p><strong>Primer apellido</strong></p>
            </article>
            <article class='d-none d-md-block col-md-1 border'>
                <p><strong>Segundo apellido</strong></p>
            </article>
            <article class='d-none d-md-block col-md-1 border'>
                <p><strong>Telefono</strong></p>
            </article>
            <article class='d-none d-md-block col-md-1 border'>
                <p><strong>Genero</strong></p>
            </article>
            <article class='d-none d-md-block col-md-2 border'>
                <p><strong>Puesto</strong></p>
            </article>
            
            <article class='d-none d-md-block col-md-2 border'>
                <p><strong>Acciones</strong></p>
            </article>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <article class='col-4 border d-md-none pt-1'>
                        <p><strong>Nombre de usuario</strong></p>
                    </article>
                    <article class='col-8 d-md-block col-md-2 border'>
                        <p>{$row['alias']}</p>
                    </article>
                    <article class='col-4 border d-md-none pt-1'>
                        <p><strong>Nombre</strong></p>
                    </article>
                    <article class='col-8 d-md-block col-md-1 border'>
                        <p>{$row['nombre']}</p>
                    </article>
                    <article class='col-4 border d-md-none'>
                        <p><strong>Primer apellido</strong></p>
                    </article>
                    <article class='col-8 d-md-block col-md-1 border'>
                        <p>{$row['apellidop']}</p>
                    </article>
                    <article class='col-4 border d-md-none'>
                        <p><strong>Segundo apellido</strong></p>
                    </article>
                    <article class='col-8 d-md-block col-md-1 border'>
                        <p>{$row['apellido_m']}</p>
                    </article>
                    <article class='col-4 border d-md-none'>
                        <p><strong>Telefono</strong></p>
                    </article>
                    <article class='col-8 d-md-block col-md-1 border'>
                        <p>{$row['telefono']}</p>
                    </article>
                    <article class='col-4 border d-md-none'>
                        <p><strong>Genero</strong></p>
                    </article>
                    <article class='col-8 d-md-block col-md-1 border'>
                        <p>{$row['genero']}</p>
                    </article>
                    <article class='col-4 border d-md-none'>
                        <p><strong>Puesto</strong></p>
                    </article>
                    <article class='col-8 d-md-block col-md-2 border'>
                        <p>{$row['puesto']}</p>
                    </article>
                    

                  <article class='col-8 border d-md-none'>
                  <p class='text-center'><strong>Editar</strong></p>
                  </article>
                  <article class='col-8 d-sm-block d-md-block col-md-2 border'>
                  <button type='button' onclick='redirigirEdit({$row['id']})' class='mb-2 mt-1 btn-hover btn btn btn-success' style=' --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .15rem;'>
                  <span class= 'd-md-none d-lg-inline text-center'><small> Editar</small></span>
                  <span >  <i class='bi bi-pencil-fill '></i></span>
                  </button>

                 <article class='col-4 border d-md-none'> 
                 <p><strong>Eliminar</strong></p>
                 </article>
                 <button type='button' onclick=\"elimMsj({$row['id']})\" class='mb-2 mt-1 btn-hover btn btn btn-danger' style=' --bs-btn-padding-y: .12rem; --bs-btn-padding-x: .18rem;'>
                 <span class= 'd-md-none d-lg-inline text-center'><small> Eliminar</small></span>
                 <span> <i class='bi bi-trash '></i></span>
                 </button>
                 </article>
                ";
                }
            } else {
                echo "<article class='col-12 pb-5'><p><h3>No se encontró ningún resultado</h3></p></article>";
            }
            ?>
        </div>

        <!-- Paginación -->
        <div aria-label="Page navigation example w-75">
            <div class="row w-100">
                <ul class="pagination justify-content-end">

                    <?php if ($pagina > 1) { ?>
                        <li class="page-item">
                            <a class="page-link" href="sopor.php?page=<?php echo $pagina - 1 ?>  ">
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
                            <a class="page-link" href="sopor.php?page=<?php echo $pagina + 1 ?>  ">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>

    <script>
        //Funcion para editar los datos de un empleado
        function redirigirEdit(Id) {
            window.location.href = 'editar_p.php?empleado=' + Id;
        }

        function elimMsj(Id) {
            // Realiza una solicitud AJAX para eliminar el empleado
            var confirmar = confirm("¿Estás seguro de que deseas eliminar este empleado?");
            // Si el usuario hace clic en "Aceptar"
            if (confirmar) {
                $.ajax({
                    type: 'POST',
                    url: 'eliminarMensaje.php', // Crea este archivo para manejar la solicitud
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
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="log.png" type="icono">
    <title>Login y Register</title>
    <link rel="stylesheet" href="estilo2.css">
</head>
<body>

        <main>

            <div class="contenedor__todo">
            <div id="titulo" class="txtmov">
                <h2>¡Bienvenido al sistema!</h2>
                </div>

                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                    <img src="log.png" alt="Logo de la empresa" class="logo">
                    </div>
                </div>
                

                <!--Formulario de Login y registro-->
                <div class="contenedor__login-register">
                    <!--Login-->
                    <form method="POST" action="usuario_login.php" class="formulario__login">
                        <h2>Acceso al sistema</h2>
                        <label>Nombre de usuario:</label>
                        <input type="text" name="alias" id="nombre" placeholder="Usuario" onchange="validarNombre()" required>
                        <br>
                        <br>
                        <label>Contraseña:</label>
                        <input type="password" name="txtcontrasena" id="contrasena"  onchange="validarContrasena()" placeholder="Contraseña" required>
                        <button>Iniciar sesion</button>
                    </form>

                    <!--Register-->
                   
                </div>

                

            </div>

        </main>

        <script src="scripts1.js"></script> 
</body>
</html>
//Ejecutando funciones
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPage);

//Declarando variables
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

    //FUNCIONES

function anchoPage(){

    if (window.innerWidth > 850){
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    }else{
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";   
    }
}

anchoPage();


    function iniciarSesion(){
        if (window.innerWidth > 850){
            formulario_login.style.display = "block";
            contenedor_login_register.style.left = "10px";
            formulario_register.style.display = "none";
            caja_trasera_register.style.opacity = "1";
            caja_trasera_login.style.opacity = "0";
        }else{
            formulario_login.style.display = "block";
            contenedor_login_register.style.left = "0px";
            formulario_register.style.display = "none";
            caja_trasera_register.style.display = "block";
            caja_trasera_login.style.display = "none";
        }
    }

    function register(){
        if (window.innerWidth > 850){
            formulario_register.style.display = "block";
            contenedor_login_register.style.left = "410px";
            formulario_login.style.display = "none";
            caja_trasera_register.style.opacity = "0";
            caja_trasera_login.style.opacity = "1";
        }else{
            formulario_register.style.display = "block";
            contenedor_login_register.style.left = "0px";
            formulario_login.style.display = "none";
            caja_trasera_register.style.display = "none";
            caja_trasera_login.style.display = "block";
            caja_trasera_login.style.opacity = "1";
        }
}
function validarNombre() {
    var t = document.getElementById('nombre');
    var nombre = document.getElementById('nombre').value;
    var patron = /^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ0-11]$/;
    var pal= patron.test(nombre);
    var mayu= nombre.charAt(0) !== nombre.charAt(0).toUpperCase();
    if (!pal  && mayu) { 
        t.value="";
        alert('Nombre no válido. Ingresa letras en minusculas o mayusculas con numeros');
    }
}  
function validarContrasena() {
    var c = document.getElementById('contrasena');
    var contrasena = document.getElementById('contrasena').value;
    var expresionRegular = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,15}$/;
    if (!expresionRegular.test(contrasena)) {
        c.value="";
        alert('Contraseña no válida. Debe contener entre 8 y 15 caracteres, letras y números');
    }
}

function nombreH() {
        var t = document.getElementById('txtnombre');
        var n = document.getElementById('txtnombre').value;
        var patron = /^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]+[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]$/;
        var pal= patron.test(n);
        var mayu= n.charAt(0) !== n.charAt(0).toUpperCase();
        if (!pal && mayu) {
            t.value="";
            alert('Nombre no válido. debe ser completo');
        }
}
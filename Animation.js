/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Call carousel manually
  document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("usuariom").addEventListener('submit', validar); });
  
  //Funcion que valida al dar submit al boton enviar, verifica que todo sea correcto y sino muestra un mensaje en cada campo de que 
function validar(evento) {
    evento.preventDefault();
    
    var nombre = document.getElementById("nombres").value;
    var r= document.getElementById("nombres");
    var patronm = /^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]{4,}$/;
    var nomVal = patronm.test(nombre);
    nomb(r,nomVal);
    
    var emails = document.getElementById("correos").value;
    var emailse= document.getElementById("correos");
    var patron = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{3,}(\.[a-zA-Z]{1,3})?$/;
    var emailVal = patron.test(emails);
    correo(emailse, emailVal);
    
    var comenta = document.getElementById("mensajes").value;
    var comet = document.getElementById("mensajes");
    var comVal = comenta.length >=1 && comenta.length <=500;
    comen(comet, comVal);
  
  function nomb(campo, Val){
    var text;
      if (!Val){
        text= "El campo es obligatorio, ingresa letras";
        campo.value="";
        campo.style.border = '1px solid red';
        document.getElementById("msj").innerHTML=text;
       return;
       }else{
        text="Listo";
        campo.style.border = '1px solid #11F934'; 
        document.getElementById("msj").innerHTML=text;
         return;
       } 
      
  }
    
     function correo(campo, Val){
    if (!Val) {
        var tex;
        tex= "Campo obligatorio";
        campo.value="";
        campo.style.border = '1px solid red';
        document.getElementById("msj4").innerHTML=tex;
        return;
        }else{
        tex="Correcto";
        campo.style.border = '1px solid #11F934';
        document.getElementById("msj4").innerHTML=tex;
        return;
        }        
    }
      function comen(campo, Val){
    if (!Val) {
        var tex;
        tex= "Campo obligatorio, debe contener al menos una palabra y no deben exceder los 50 caracteres";
        campo.value="";
        campo.style.border = '1px solid red';
        document.getElementById("msj6").innerHTML=tex;
        return;
        }else{
        tex="Correcto";
        campo.style.border = '1px solid #11F934';
        document.getElementById("msj6").innerHTML=tex;
        return;
        }        
    }
    
    if(!nomVal || !emailVal || !comVal ){  
            swal ( "Oops" ,  "Rellena todos los campos o los faltantes!" ,  "" );
      
        return;
    }else if (nomVal===true && emailVal=== true && comVal===true){
        var t="Es correcto todos los campos";
        document.querySelectorAll("p").innerHTML="";
        this.submit();        
    }
   

}

 function nomb1(){
        var x, t;
        var patrone = /^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]{4,}$/;
        t=document.getElementById("nombres");
        x=document.getElementById("nombres").value;
        var valn= patrone.test(x);
        
        if (!valn){
            var tex;
            tex= "Campo obligatorio, ingresa letras";
            t.value="";
            t.style.border = '1px solid red';
            document.getElementById("msj").innerHTML=tex;
        }else{
            t.style.border = '1px solid #11F934';
            tex= "";
            document.getElementById("msj").innerHTML=tex;
        }
        }
   function comenta(){
        var x,t;
        t=document.getElementById("mensajes"); 
        x=document.getElementById("mensajes").value;
        var comVal = x.length >=1 && x.length <=500;
       
        if (!comVal){
            var tex;
            tex= "Campo obligatorio, ingresa letras maximo 500 letras";
            t.value="";
            t.style.border = '1px solid red';
            document.getElementById("msj1").innerHTML=tex;
        }else{
           t.style.border = '1px solid #11F934';
           tex= "";
           document.getElementById("msj1").innerHTML=tex;
        }
    } 
     function correos(){
        var x,t;
        t=document.getElementById("correos"); 
        x=document.getElementById("correos").value;  
        var patron = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{3,}(\.[a-zA-Z]{1,3})?$/;
        var emailVal = patron.test(x);
              
        if (!emailVal){
            var tex;
            tex= "El correo no debe estar vacio";
            t.value="";
            t.style.border = '1px solid red';  
            document.getElementById("msj2").innerHTML=tex;
        }else{
           t.style.border = '1px solid #11F934';
           tex= "";
           document.getElementById("msj2").innerHTML=tex;
        }
    }
    function telefono(){
        var x, t,rang;
        var patron = /^[1-9]\d*$/;
        t= document.getElementById("telef");
        x=document.getElementById("telef").value;
        var tele = patron.test(x);  
        rang= x>=13;
        if (!tele || !rang ){
            var tex;
            tex= "No debe estar vacio, ingresa 10 digitos (9511238799)";  
            t.value="";
            t.style.border = '1px solid red';
            document.getElementById("msj3").innerHTML=tex;
        }else{
           t.style.border = '1px solid #11F934';
           tex= "";
           document.getElementById("msj3").innerHTML=tex;
        }
    }
     function saltarCampo(event, siguienteCampoID) {
      if (event.key === "Enter") {
        event.preventDefault(); // Evitar que se envíe el formulario por defecto
        document.getElementById(siguienteCampoID).focus();
      }
    }
    function categoria(){
        var x, t;
        var patrone = /^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]{4,}$/;
        t=document.getElementById("categoria");
        x=document.getElementById("categoria").value;
        var valn= patrone.test(x);
        
        if (!valn){
            var tex;
            tex= "Campo obligatorio, ingresa letras";
            t.value="";
            t.style.border = '1px solid red';
            document.getElementById("txt4").innerHTML=tex;
        }else{
            t.style.border = '1px solid #11F934';
            tex= "";
            document.getElementById("txt4").innerHTML=tex;
        }
        }
function hazclic() {
       document.getElementById("nombres").addEventListener('blur',nomb1);
       document.getElementById("mensajes").addEventListener('blur',comenta);
       document.getElementById("correos").addEventListener('blur',correos);
       document.getElementById("telef").addEventListener('blur',telefono);
       document.getElementById("categoria").addEventListener('blur',categoria);
}

window.addEventListener("load", hazclic);
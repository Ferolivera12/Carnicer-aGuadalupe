    function nombre(){
    var x, t;
    var patrone =/^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]$/;
    t=document.getElementById("nombres"); 
    x=document.getElementById("nombres").value;
    var valn= patrone.test(x);
    var mayu= x.charAt(0) !== x.charAt(0).toUpperCase();
    if (!valn && mayu){
        var tex;
        tex= "Campo obligatorio, ingresa letras con la primera letra en mayusycula";
        t.value.replace(/[^a-zA-Z\s]/g, '');
        t.value="";
        t.style.border = '1px solid red';
        document.getElementById("txt1").innerHTML=tex;
    }else{
        t.style.border = '1px solid #C0F3EF';
        tex= "";
        document.getElementById("txt1").innerHTML=tex;
    }
    }
    function eliminarNumeros() {
        var inp = document.getElementById("nombres");
        inp.value = inp.value.replace(/[^a-zA-ZáéíóúüÁÉÍÓÚÜñÑ]/g, '');
    }
    function elimNum() {
        var ina = document.getElementById("apellido");
        ina.value = ina.value.replace(/[^a-zA-ZáéíóúüÁÉÍÓÚÜñÑ]/g, '');
    }
    function eliNum() {
        var iap = document.getElementById("apells");
        iap.value = iap.value.replace(/[^a-zA-ZáéíóúüÁÉÍÓÚÜñÑ]/g, '');
    }
    function eliLetras() {
        var iap = document.getElementById("telef");
        iap.value = iap.value.replace(/[^\d]/g, '');
    }
    function Contra() {
        var iap = document.getElementById("contra");
        iap.value = iap.value.replace(/[^A-Za-z0-9]/g, '');
    }

    function apellido(){
    var x, t;
    var patrone =/^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]$/;
    t=document.getElementById("apellido"); 
    x=document.getElementById("apellido").value;
    var valn= patrone.test(x);
    var mayu= x.charAt(0) !== x.charAt(0).toUpperCase();
    if (!valn && mayu){
        var tex;
        tex= "Campo obligatorio, ingresa letras con la primera letra en mayusycula";
        t.value="";
        t.style.border = '1px solid red';
        document.getElementById("txt12").innerHTML=tex;
    }else{
        t.style.border = '1px solid #C0F3EF';
        tex= "";
        document.getElementById("txt12").innerHTML=tex;
    }
    }
    function apellidos(){
        var x, t;
        var patrone =/^[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]$/;
        t=document.getElementById("apells"); 
        x=document.getElementById("apells").value;
        var valn= patrone.test(x);
        var mayu= x.charAt(0) !== x.charAt(0).toUpperCase();
        if (!valn && mayu){
            var tex;
            tex= "Campo obligatorio, ingresa letras con la primera letra en mayusycula";
            t.value="";
            t.style.border = '1px solid red';
            document.getElementById("txt13").innerHTML=tex;
        }else{
            t.style.border = '1px solid #C0F3EF';
            tex= "";
            document.getElementById("txt13").innerHTML=tex;
        }
    }

    function telefono(){
        var x, t,rang;
        var patron = /^[0-9]{10}\d*$/;
        t= document.getElementById("telef");
        x=document.getElementById("telef").value;
        var tele = patron.test(x);  
        rang= x>=1 ;
        if (!tele || !rang ){
            var tex;
            tex= "Ingresa 10 numeros, campo obligatorio";  
            t.value="";
            t.style.border = '1px solid red';
            document.getElementById("txt2").innerHTML=tex;
        }else{
           t.style.border = '1px solid #C0F3EF';
           tex= "";
           document.getElementById("txt2").innerHTML=tex;
        }
    }
    function contraseña(){
        var x, t;
        var patron = /^[A-Za-z0-9]{8,}$/;
        t= document.getElementById("contra");
        x=document.getElementById("contra").value;
        var prec = patron.test(x);
        if (!prec){
            var tex;
            tex= "Ingresa como minimo 8 o maximo 15 numeros y letras, campo obligatorio";  
            t.value="";
            t.style.border = '1px solid red';
            document.getElementById("txt3").innerHTML=tex;
        }else{
           t.style.border = '1px solid #C0F3EF';
           tex= "";
           document.getElementById("txt3").innerHTML=tex;
        }
    }
    
    
    
function hazclic() {
   document.getElementById("nombres").addEventListener('blur',nombre);
   document.getElementById("apellido").addEventListener('blur',apellido);
   document.getElementById("apells").addEventListener('blur',apellidos);
   document.getElementById("telef").addEventListener('blur',telefono);
   document.getElementById("contra").addEventListener('blur',contraseña);
}

window.addEventListener("load", hazclic);
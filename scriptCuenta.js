function validarCorreo() {
    var correo = document.getElementById('correo').value;
    var expresionRegular = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!expresionRegular.test(correo)) {
      alert('Correo electrónico no válido. Por favor, ingrese un correo válido.');
    }
}
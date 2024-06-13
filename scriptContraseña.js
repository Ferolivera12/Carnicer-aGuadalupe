function validarContrasena() {
    var contrasena = document.getElementById('contrasena').value;
    var expresionRegular = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/;

    if (!expresionRegular.test(contrasena)) {
      alert('Contraseña no válida. Debe contener entre 8 y 15 caracteres, letras, números y un carácter especial (@$!%*?&).');
    }
  }
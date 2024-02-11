document.addEventListener("DOMContentLoaded", function () {
    
        Swal.fire({
            icon: "error",
            title: "¡Error de Usuario!",
            text: "El Usuario Introducido no está Registrado",
            showConfirmButton: false,
            showCloseButton: true,
            toast: true,
            padding: '1rem',
            timer:'5000',
            timerProgressBar: true
          });
    
});
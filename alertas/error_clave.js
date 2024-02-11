document.addEventListener("DOMContentLoaded", function () {
    
        Swal.fire({
            icon: "error",
            title: "¡Error de Contraseña!",
            text: "La Contraseña Introducida es Incorrecta",
            showConfirmButton: false,
            showCloseButton: true,
            toast: true,
            padding: '1rem',
            timer:'5000',
            timerProgressBar: true
          });

});
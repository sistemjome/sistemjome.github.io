document.addEventListener("DOMContentLoaded", function () {
    
    Swal.fire({
        icon: "error",
        title: "¡Error de Curso!",
        text: "El curso introducido ya existe",
        showConfirmButton: false,
        showCloseButton: true,
        toast: true,
        padding: '1rem',
        timer:'5000',
        timerProgressBar: true
      });

});
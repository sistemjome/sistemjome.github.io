
//Notificación de Error
$("#error").click(function(){
    Swal.fire({
        icon: "error",
        title: "Error...",
        text: "No se ha podido acceder al sistema!",
        showConfirmButton: false,
        showCloseButton: true,
        footer: '<a href="#">información del error!</a>',
        toast: true,
        padding: '1rem'
      });
}); 

//Notificación de Información
$("#info").click(function(){
    Swal.fire({
        title: "Tienes Internet?",
        text: "El sistema se está cargando lento",
        icon: "question",
        toast: true,
        padding: '1rem'
      });
});

//Notificación de Registrado
$("#registrado").click(function(){
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Registrado",
        showConfirmButton: false,
        timer: 2000,
        toast: true,
        padding: '1rem'
      });
});

//Notificación de Eliminar
$("#eliminar").click(function(){
    Swal.fire({
        title: "En verdad desea borrar?",
        showDenyButton: true,
        showCancelButton: false,
        icon: "info",
        toast: true,
        padding: '1rem',
        confirmButtonText: "Sí, borrar",
        denyButtonText: `No`
      }).then((result) => {
        /* comparamos las opciones */
        if (result.isConfirmed) {
            Swal.fire({
                icon: "success",
                title: "Eliminado",
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                toast: true,
                padding: '1rem'
              });
        }
      });
});

//Notificación de Visitar una Página Web
$("#visitar").click(function(){
    Swal.fire({
        html: 'visita mi página web <a href = "https://elbuenpintor.github.io"> EL BUEN PINTOR & ASOCIADOS</a>',
        confirmButtonText: 'Visitar!',
        showDenyButton: true,
        toast: true,
        icon: 'info',
        denyButtonText: `Cancelar`,
        padding: '1rem'
      }).then((result) => {
        /* comparamos las opciones */
        if (result.isConfirmed) {
          window.location = "https://elbuenpintor.github.io";
        }
      })
});

//Notificación Cargar Página
$("#cargar").click(function(){
    Swal.fire({
        html: 'Iniciando Sesión!',
        toast: true,
        icon: 'success',
        showConfirmButton: false,
        padding: '1rem',
        position: 'top-right',
        timer:'3000',
        timerProgressBar: true
      });
});
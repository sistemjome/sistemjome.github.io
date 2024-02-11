<?php include('../.././base_datos/bd.php');

//Generar la clave de verificación
$chars = "1A2B3C4D5E6F7G8H9I10J11K12M13N14L15O16P1abcdefghijkmnlopqurstvwxyz";
$longitud = 6;
$clave_verificacion = substr(str_shuffle($chars), 0, $longitud);


if($_POST) {

    //Recolectamos los datos del método POST
    $email_usuario = (isset($_POST["email_usuario"])?$_POST["email_usuario"]:"");
    
//listar la información de la base de datos (para saber si el usuario existe)
$sentencia = $conexion->prepare("SELECT email_usuario FROM usuarios
WHERE email_usuario = :email_usuario");
$sentencia->bindParam(":email_usuario",$email_usuario);
$sentencia->execute();
$lista_usuario = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($lista_usuario as $usuario);

if(!empty($usuario['email_usuario'])) {

    //Preparamos la inserción de los datos
    try {
        $sentencia = $conexion->prepare("UPDATE usuarios
        SET codigo_usuario = :codigo_usuario
        WHERE email_usuario = :email_usuario");

    //Asignamos los valores que vienen del método POST (los que vienen del formulario)
    $sentencia->bindParam(":codigo_usuario",$clave_verificacion);
    $sentencia->bindParam(":email_usuario",$email_usuario);
    $sentencia->execute();

?><script>
    alert("Verifique la cuenta");
    window.location = "claveverificacion.php?email=<?php echo $email_usuario; ?>";
 </script><?php
   
    } catch(Exception $ex) {

    ?><script>
        alert("Error: no se ha podido realizar la operación");
    </script><?php
    }

} else {

    ?><script>
        alert("Error: el email introducido no existe");
    </script><?php

}

}

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Recuperar Contraseña</title>
    <meta http-equiv="og:image" content="../../../../assets/img/fotos/altaeducacion.png">
    <meta property="og:description" content="Aplicación Web de Gestión de Clases Particulares">
    <meta name="description" content="Aplicación Web encargada de llevar a cabo la Gestión de una Agencia cualquiera de Clases Particulares">
    <meta property="og:image" content="../../../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="../../assets/img/fotos/altaeducacion.png">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arbutus+Slab">
    <link rel="stylesheet" href="../../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../assets/css/Animated-Text-Background.css">
    <link rel="stylesheet" href="../../assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="../../assets/css/best-carousel-slide.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="../../assets/css/Pricing-Free-Paid-badges.css">
    <link rel="stylesheet" href="../../assets/css/Pricing-Free-Paid-icons.css">
    <link rel="stylesheet" href="../../assets/css/responsive-blog-card-slider.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-password-image" style="background: url(&quot;../../assets/img/fotos/altaeducacion.png&quot;) center / cover;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-2">¿Olvidaste la Contraseña?</h4>
                                        <p class="mb-4">Para restaurar la contraseña, por favor, introduzca su correo electrónico</p>
                                    </div>
                                    <form method="post" class="user">
                                        <div class="mb-3">
                                        <input class="form-control form-control-user" type="email" id="email_usuario" aria-describedby="emailHelp" placeholder="Digite su correo electrónico" name="email_usuario" required></div>
                                        <button class="btn btn-primary d-block btn-user w-100" type="submit" role="button" >Restaurar Contraseña</button>
                                    </form>
                                    <div class="text-center">
                                        <hr><a class="small" href="../../SinCuenta.php">¡Crear una Cuenta!</a>
                                    </div>
                                    <div class="text-center"><a class="small" href="../../index.php">¿ya tienes una cuenta? Iniciar Sesión!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © JOME <?php echo date("Y"); ?></span></div>
        </div>
    </footer>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="../../assets/js/Animated-Text-Background.js"></script>
    <script src="../../assets/js/responsive-blog-card-slider-1.js"></script>
    <script src="../../assets/js/responsive-blog-card-slider.js"></script>
    <script src="../../assets/js/theme.js"></script>
</body>

</html>
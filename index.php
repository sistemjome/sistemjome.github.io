<?php

session_start();

if($_POST) {

$email_usuario = (isset($_POST["email_usuario"])?$_POST["email_usuario"]:"");
$clave_usuario = (isset($_POST["clave_usuario"])?$_POST["clave_usuario"]:"");

include('./base_datos/bd.php');
//listar la información de la base de datos (para obtener el usuario)
    $sentencia = $conexion->prepare("SELECT email_usuario, clave_usuario, rol_usuario, codigo_usuario FROM usuarios
    WHERE email_usuario = :email_usuario");
    $sentencia->bindParam(":email_usuario",$email_usuario);
    $dameClave = $clave_usuario;
    $dameClave = hash('sha512', $dameClave);
    $sentencia->execute();
    $lista_usuario = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach($lista_usuario as $registro);

//listar la información de la base de datos (para obtener la agencia)
    $sentencia = $conexion->prepare("SELECT id_agencia FROM agencias
    WHERE paquete = :email_usuario");
    $sentencia->bindParam(":email_usuario",$email_usuario);
    $sentencia->execute();
    $lista_agencia = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach($lista_agencia as $agencia);

    if(!empty($registro['email_usuario'])) {
    
    $cero = 0;
    $clave = $registro['clave_usuario'];
    $rol= $registro['rol_usuario'];
    $activacion = $registro['codigo_usuario'];
    $id = $email_usuario;

        if($dameClave==$clave) {

            if($activacion!=$cero) {

                header("Location: verificacion.php?txtID=".$id); 
        
            } else {

if($rol=="ADMINISTRADOR") {

    if(!empty($agencia['id_agencia'])) {

    //Asignamos la sesión a través del metodo nativo ($_SESSION) para obtener el usuario y su rol
    $_SESSION['email_usuario'] = $email_usuario;
    $_SESSION['rol_usuario'] = $rol;

?><script>
window.location = "bloques/admin/inicio.php?email=<?php echo $email_usuario; ?>&agencia=<?php echo $agencia['id_agencia']; ?>";
</script><?php

} else {


?><script>
    alert("Tienes que terminar con la configuración de la cuenta");
    window.location = "bloques/admin/cuenta/configurarAgencia.php?email=<?php echo $email_usuario; ?>";
</script><?php

}

    } else if($rol=="ROOT") {

    //Asignamos la sesión a través del metodo nativo ($_SESSION) para obtener el usuario y su rol
    $_SESSION['email_usuario'] = $email_usuario;
    $_SESSION['rol_usuario'] = $rol;
    header("Location: bloques/root/inicioRoot.php");
     
    } else if($rol=="PROFESOR") {
    
    //Asignamos la sesión a través del metodo nativo ($_SESSION) para obtener el usuario y su rol
    $_SESSION['email_usuario'] = $email_usuario;
    $_SESSION['rol_usuario'] = $rol;
    header("Location: bloques/profesor/perfil.php");
                
    } else {

    //Asignamos la sesión a través del metodo nativo ($_SESSION) para obtener el usuario y su rol
    $_SESSION['email_usuario'] = $email_usuario;
    $_SESSION['rol_usuario'] = $rol;
    header("Location: bloques/estudiante/perfil.php");
                   
    }
}
   } else { 
    
?><script
src = "alertas/error_clave.js">
</script><?php

    }
} else {

?><script
src = "alertas/error_user.js">
</script><?php

}

}

?>

<!DOCTYPE html>
<html>

<head>

<!-- sweetalert2 (css) -->
<link rel="stylesheet" href="./librerias/sweetalert2/sweetalert2.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>JOME</title>
    <meta http-equiv="og:image" content="../../../../assets/img/fotos/altaeducacion.png">
    <meta property="og:description" content="Aplicación Web de Gestión de Clases Particulares">
    <meta name="description" content="Aplicación Web encargada de llevar a cabo la Gestión de una Agencia cualquiera de Clases Particulares">
    <meta property="og:image" content="../../../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="assets/img/fotos/altaeducacion.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arbutus+Slab">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Animated-Text-Background.css">
    <link rel="stylesheet" href="assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="assets/css/best-carousel-slide.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/Pricing-Free-Paid-badges.css">
    <link rel="stylesheet" href="assets/css/Pricing-Free-Paid-icons.css">
    <link rel="stylesheet" href="assets/css/responsive-blog-card-slider.css">
</head>

<body class="bg-gradient-primary" style="background: url(&quot;assets/img/fotos/educacion-formacion-estudios.jpg&quot;) bottom / cover;overflow: visible;transform: perspective(0px);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background: url(&quot;assets/img/fotos/altaeducacion.png&quot;) center / contain;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Inicio de Sesión!</h4>
                                    </div>
                                    <form id="formulario" class="user" method="post">
                                        <div class="mb-3">
                                        <input class="form-control form-control-user" type="email" id="email_usuario" aria-describedby="emailHelp" placeholder="Correo electrónico..." name="email_usuario" required></div>
                                        <div class="mb-3">
                                        <input class="form-control form-control-user" type="password" id="clave_usuario" placeholder="Contraseña..." name="clave_usuario" required></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small"></div>
                                        </div>
                                    <button class="btn btn-outline-primary d-block btn-user w-100" role="button" type="input" style="margin-bottom: 7px;" >Iniciar</button>
                                    <center><a class="small" href="SinCuenta.php" style="margin-left: 0px;">¡No tienes una cuenta!</a></center>
                                    <hr>
                                    </form>
                                    <div class="text-center">
                                    <center><a class="small" href="info.php">¡Información sobre la APP!</a></div></center>
                                    <center><a class="small" href="bloques/respaldo/recuperarclave.php" style="margin-top: -3px;margin-bottom: 0px;margin-left: 0px;">¿Has olvidado la clave?</a></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Animated-Text-Background.js"></script>
    <script src="assets/js/responsive-blog-card-slider-1.js"></script>
    <script src="assets/js/responsive-blog-card-slider.js"></script>
    <script src="assets/js/theme.js"></script>

<!-- popper (js) -->
<script src = "./librerias/popper/js/popper.min.js"></script>
<!-- jquery (js) -->
<script src = "./librerias/jquery/jquery-3.7.1.min.js"></script>
<!-- sweetalert2 (js) -->
<script src = "./librerias/sweetalert2/sweetalert2.all.min.js"></script>

</body>

</html>
<?php $txtEmail = $_GET['email'];

include('../.././base_datos/bd.php');


if($_POST) {

    //Recolectamos los datos del método POST
    $clave_usuario1 = (isset($_POST["clave_usuario1"])?$_POST["clave_usuario1"]:"");
    $clave_usuario2 = (isset($_POST["clave_usuario2"])?$_POST["clave_usuario2"]:"");
    $email_paquete = $txtEmail;
    

    if($clave_usuario1==$clave_usuario2) {
        ?><script>
        <?php

        //Cifrar la contraseña
        $dameClave = $clave_usuario1;
        $dameClave = hash('sha512', $dameClave);

        $sentencia = $conexion->prepare("UPDATE usuarios
        SET clave_usuario = :dameClave
        WHERE email_usuario = :email_paquete"); 
        $sentencia->bindParam(":dameClave",$dameClave);
        $sentencia->bindParam(":email_paquete",$email_paquete);
        $sentencia->execute();?>
        </script><?php
        
        ?><script>
        alert("Clave Modificada");
        window.location = "../../index.php";
         </script><?php

    } else {

        ?><script>
            alert("Error: la contraseña no coincide con la anterior");
        </script><?php

    }

}

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Nueva Contraseña</title>
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
                                        <h4 class="text-dark mb-2">Nueva Contraseña</h4>
                                    </div>
                                    <form method="post" class="user">
                                        <div class="mb-3">
                                        <input class="form-control form-control-user" type="password" id="clave_usuario1" aria-describedby="emailHelp" placeholder="Digite la nueva contraseña" name="clave_usuario1" required>
                                        <input class="form-control form-control-user" type="password" id="clave_usuario2" aria-describedby="emailHelp" placeholder="Confirme la contraseña" name="clave_usuario2" style="margin-top: 5px;" required></div>
                                        <button class="btn btn-primary d-block btn-user w-100" type="submit" role="button">Restaurar</button>
                                    </form>
                                    <div class="text-center">
                                        <hr>
                                    </div>
                                    <div class="text-center"></div>
                                    <div class="text-center"><a class="small" href="../../index.php"></a></div>
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
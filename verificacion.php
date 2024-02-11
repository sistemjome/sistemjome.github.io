<?php $txtID = $_GET['txtID'];

include('./base_datos/bd.php');

if($_POST) {

    //Recolectamos los datos del método POST
    $codigo_usuario = (isset($_POST["codigo_usuario"])?$_POST["codigo_usuario"]:"");
    $email_paquete = $txtID;
    $cero = 0;
    //listar la información de la base de datos (obtener la clave de verificacion en la BD)
    $sentencia = $conexion->prepare("SELECT codigo_usuario FROM usuarios
    WHERE email_usuario = :email_paquete");
    $sentencia->bindParam(":email_paquete",$email_paquete);
    $sentencia->execute();
    $lista_codigo = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    foreach($lista_codigo as $registro);
    $cod = $registro['codigo_usuario'];

    if($cod==$codigo_usuario) {
        
        $sentencia = $conexion->prepare("UPDATE usuarios set codigo_usuario = :cero
        WHERE email_usuario = :email_paquete"); 
        $sentencia->bindParam(":email_paquete",$email_paquete);
        $sentencia->bindParam(":cero",$cero);
        $sentencia->execute();
 
?><script>
    alert("Configure los datos de su Agencia de Clases Particulares");
    window.location = "bloques/admin/cuenta/configurarAgencia.php?email=<?php echo $email_paquete; ?>";
</script><?php

    } else {

?><script>
    alert("ERROR: la clave de verificación no es correcta");
    alert("Por favor, revise su correo electrónico");
</script><?php

    }

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Verificacion</title>
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

<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-password-image" style="background: url(&quot;assets/img/fotos/altaeducacion.png&quot;) center / cover;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-2">Código de Verificación</h4>
                                        <div class="alert alert-success" role="alert"><span><strong>Revise su correo electrónico, </strong>se ha enviado el código a <strong> <?php echo($txtID); ?>&nbsp;</strong><br></span></div>
                                    </div>
                                    <form method="post" class="user">
                                        <div class="mb-3">
                                        <input class="form-control form-control-user" type="text" id="codigo_usuario" aria-describedby="emailHelp" placeholder="Digite la clave de verificación" name="codigo_usuario" required></div>
                                        <button class="btn btn-primary d-block btn-user w-100" type="input" role="button" >Acceder</button>
                                    </form>
                                    <div class="text-center"></div>
                                    <div class="text-center"><a class="small" href="index.html"></a></div>
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Animated-Text-Background.js"></script>
    <script src="assets/js/responsive-blog-card-slider-1.js"></script>
    <script src="assets/js/responsive-blog-card-slider.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
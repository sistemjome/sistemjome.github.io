<?php include('./base_datos/bd.php');

//Configurar el email (para enviar el código)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

//Generar la clave de verificación
$chars = "1A2B3C4D5E6F7G8H9I10J11K12M13N14L15O16P1abcdefghijkmnlopqurstvwxyz";
$longitud = 6;
$clave_verificacion = substr(str_shuffle($chars), 0, $longitud);


//Registrar la INFORMACION (Paquete_Usuario)
if($_POST) {

//listar la información de la base de datos (para obtener el email)
$email = $_POST["email_paquete"];
$sentencia = $conexion->prepare("SELECT email_paquete FROM paquetes
WHERE email_paquete = :email_usuario");
$sentencia->bindParam(":email_usuario",$email);
$sentencia->execute();
$listar_email = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($listar_email as $listar);

    //Recolectamos los datos del método POST
    $nombre_paquete = (isset($_POST["nombre_paquete"])?$_POST["nombre_paquete"]:"");
    $email_paquete = (isset($_POST["email_paquete"])?$_POST["email_paquete"]:"");
    $clave_paquete = (isset($_POST["clave_paquete"])?$_POST["clave_paquete"]:"");
    //cifrar la contraseña
    $dameClave = $clave_paquete;
    $dameClave = hash('sha512', $dameClave);
    //Valores Predefinidos (PAQUETES)
    $fecha_inicio = date("y-m-d");
    $contador_paquete = 0;
    $tipo_paquete = "FREE";
    $duracion_contador = 90;
    //Valores Predefinidos (USUARIOS)
    $codigo_usuario = $clave_verificacion;
    $estado_usuario = "CONECTADO";
    $rol_usuario = "ADMINISTRADOR";

    //Preparamos la inserción de los datos
    if(empty($listar['email_paquete'])) {
    try {

    $sentencia = $conexion->prepare("INSERT INTO paquetes
            VALUES(:email_paquete, :nombre_paquete, :fecha_inicio, :contador_paquete, :tipo_paquete, :duracion_contador);
            INSERT INTO usuarios
            VALUES(null, :nombre_paquete, :email_paquete, :dameClave, :codigo_usuario, :estado_usuario, :rol_usuario)");
    //Asignamos los valores que vienen del método POST (los que vienen del formulario)
    //PAQUETE
    $sentencia->bindParam(":email_paquete",$email_paquete);
    $sentencia->bindParam(":nombre_paquete",$nombre_paquete);
    $sentencia->bindparam(":fecha_inicio",$fecha_inicio);
    $sentencia->bindParam(":contador_paquete",$contador_paquete);
    $sentencia->bindParam(":tipo_paquete",$tipo_paquete);
    $sentencia->bindParam(":duracion_contador",$duracion_contador);
    $sentencia->bindParam(":verificacion",$verificacion);
    //USUARIO
    $sentencia->bindParam(":nombre_paquete",$nombre_paquete);
    $sentencia->bindParam(":email_paquete",$email_paquete);
    $sentencia->bindparam(":dameClave",$dameClave);
    $sentencia->bindParam(":codigo_usuario",$codigo_usuario);
    $sentencia->bindParam(":estado_usuario",$estado_usuario);
    $sentencia->bindParam(":rol_usuario",$rol_usuario);

    
    //Enviar la clave de verificacion al correo electrónico

   $mail = new PHPMailer(true);

    //Servidor
    $mail->SMTPDebug = 1;                      //Mostrar la comunicacion SERVIDOR-CLIENTE (1-solo error/2-todo/0-nada)
    $mail->isSMTP();                                            //Habilitar el protocolo SMTP
    $mail->Host       = 'smtp.hostinger.com';                   //Host de Hostinger
    $mail->SMTPAuth   = true;                                   //Activiar la autentificación de la cuenta (SMTP)
    $mail->Username   = 'info@edmupgroup.com';                 //Usuario
    $mail->Password   = 'Edmup@2024';                      //Contraseña
    $mail->SMTPSecure = 'tls';                                  //Tipo de Incriptación SSL
    $mail->Port       = 587;                                    //Puerto de incriptación SSL

    //Receptor
    $mail->setFrom('info@edmupgroup.com', 'System JOME');
    $mail->addAddress($email_paquete, $nombre_paquete);    //La persona a la que se le envía el Email
    $mail->addReplyTo('juanondo011099@gmail.com', 'System JOME');  //Habilitar la obción de responder al mail recibido

    //Contenido
    $mail->isHTML(true);                                 
    $mail->Subject = 'Activar Cuenta';
    $mail->Body    = 'La plataforma JOME le ha asignado la siguiente clave de verificación: <b><?php echo ($codigo_usuario); ?></b>';
    $mail->AltBody = 'Código de verificación';

    //Adicional
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'quoted-printable';

    $mail->smtpConnect([
        'ssl' => [
             'verify_peer' => true,
             'verify_peer_name' => true,
             'allow_self_signed' => true
         ]
     ]);

    $mail->send();
    
    //Ejecutar el Insert Into
   /* $sentencia->execute();

//Redireccionar
?><script>
    alert("Verifique la cuenta");
    window.location = "verificacion.php?txtID=<?php echo $email_paquete; ?>";
 </script><?php */
 

    } catch(Exception $ex) { 

?><script>
    alert("ERROR: no se ha podido completar la operación");
</script><?php
}
    
    } else {
?> <script>
    alert("ERROR: el email introducido ya existe");
</script><?php
    }

}


?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="librerias/sweetalert2/sweetalert2.min.css">

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

<body style="background: url(&quot;assets/img/fotos/altaeducacion.png&quot;) center / cover;">
    <section class="position-relative py-4 py-xl-5">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card mb-5">
                        <div class="card-body p-sm-5">
                            <h2 class="text-center mb-4">Crear una Cuenta Fre!</h2>
                            <form method="post">
                            <div class="mb-3">
                                <input class="form-control" type="text" id="nombre_paquete" name="nombre_paquete" placeholder="Nombre y Apellidos" required>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="email" id="email_paquete" name="email_paquete" placeholder="Correo Electrónico" required>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="password" id="clave_paquete" name="clave_paquete" placeholder="Contraseña" style="margin-top: 12px;" required>
                            </div>
                            <div>
                                <button class="btn btn-primary  d-block w-100" type="submit" role="button" >Crear cuenta</button>
                                <a class="btn btn-danger d-block w-100" role="button" href="index.php" style="margin-top: 7px;">Cancelar</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

<script src = "librerias/popper/js/popper.min.js"></script>
<script src = "librerias/jquery/jquery-3.7.1.min.js"></script>
<script src = "librerias/sweetalert2/sweetalert2.all.min.js"></script>

</body>

</html>
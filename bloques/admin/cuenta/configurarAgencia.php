<?php
include('../../.././base_datos/bd.php');


if($_POST) {

//Datos predefinidos
$paquete = $_GET['email'];
$plataforma = 1;

//Recolectamos los datos del método POST
$nombre_agencia = (isset($_POST["nombre_agencia"])?$_POST["nombre_agencia"]:"");
$fundador_agencia = (isset($_POST["fundador_agencia"])?$_POST["fundador_agencia"]:"");
$fecha_agencia = (isset($_POST["fecha_agencia"])?$_POST["fecha_agencia"]:"");
$direccion_agencia = (isset($_POST["direccion_agencia"])?$_POST["direccion_agencia"]:"");
$web_agencia = (isset($_POST["web_agencia"])?$_POST["web_agencia"]:"");
$telefono_agencia = (isset($_POST["telefono_agencia"])?$_POST["telefono_agencia"]:"");
$email_agencia = (isset($_POST["email_agencia"])?$_POST["email_agencia"]:"");
$descripcion_agencia = (isset($_POST["descripcion_agencia"])?$_POST["descripcion_agencia"]:"");

//Datos en formato archivo (imagen o documento)
$pdf_agencia = (isset($_FILES["pdf_agencia"]['name'])?$_FILES["pdf_agencia"]['name']:"");
$logo_agencia = (isset($_FILES["logo_agencia"]['name'])?$_FILES["logo_agencia"]['name']:"");

//Datos para la notificacion
$mensaje = "Disfruta de la versión Free durante 90 días, vencido ese tiempo, tendrá que adquirir la versión de pago (Pro o Pro-Emp)
para continuar disfrutando de todos los servicios que ofrece la Plataforma de JOME";
$fecha = date('y-m-d');
$estado = "Pendiente";

try {
//Preparamos la inserción de los datos
$sentencia = $conexion->prepare("INSERT INTO agencias
        VALUES(null, :nombre_agencia, :fundador_agencia, :fecha_agencia, :direccion_agencia, :web_agencia, 
        :telefono_agencia, :email_agencia, :pdf_agencia, :logo_agencia, :descripcion_agencia, :plataforma, 
        :paquete)");
//Asignamos los valores que vienen del método POST (los que vienen del formulario)
$sentencia->bindParam(":nombre_agencia",$nombre_agencia);
$sentencia->bindParam(":fundador_agencia",$fundador_agencia);
$sentencia->bindParam(":fecha_agencia",$fecha_agencia);
$sentencia->bindParam(":direccion_agencia",$direccion_agencia);
$sentencia->bindParam(":web_agencia",$web_agencia);
$sentencia->bindParam(":telefono_agencia",$telefono_agencia);
$sentencia->bindParam(":email_agencia",$email_agencia);
$sentencia->bindParam(":descripcion_agencia",$descripcion_agencia);
$sentencia->bindParam(":plataforma",$plataforma);
$sentencia->bindParam(":paquete",$paquete);

//adjuntar la foto para que se inserte en la BD (la ruta)
$fecha_foto = new DateTime();
$nombreArchivo_foto = ($logo_agencia!='')?$fecha_foto->getTimestamp()."_".$_FILES["logo_agencia"]['name']:"";
$tmp_foto = $_FILES["logo_agencia"]['tmp_name'];
if($tmp_foto!='') {
move_uploaded_file($tmp_foto, "./".$nombreArchivo_foto);
}
$sentencia->bindParam(":logo_agencia",$nombreArchivo_foto);

//adjuntar el pdf para que se inserte en la BD (la ruta)
$fecha_cv = new DateTime();
$nombreArchivo_cv= ($pdf_agencia!='')?$fecha_cv->getTimestamp()."_".$_FILES["pdf_agencia"]['name']:"";
$tmp_cv = $_FILES["pdf_agencia"]['tmp_name'];
if($tmp_cv!='') {
move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);
}
$sentencia->bindParam(":pdf_agencia",$nombreArchivo_cv);
$sentencia->execute();

//Datos para la notificacion
$mensaje = "Disfruta de la versión Free durante 90 días, vencido ese tiempo, tendrá que adquirir la versión de pago (Pro o Pro-Emp)
para continuar disfrutando de todos los servicios que ofrece la Plataforma de JOME";
$mj = "Disfruta de la versión Free durante 90 días, vencido ese tiempo, tendrá que adquirir la versión de pago (Pro o Pro-Emp)
para continuar disfrutando de todos los servicios que ofrece la Plataforma de JOME";
$longitud = 30;
$mensajeR = substr(($mj), 0, $longitud);
$mensaje_resumido = $mensajeR."...";
$fecha = date('y-m-d');
$estado = "Pendiente";
//Optenemos el codigo de la agencia en la BD
$sentencia = $conexion->prepare("SELECT id_agencia FROM agencias
WHERE paquete = :email_usuario");
$sentencia->bindParam(":email_usuario",$paquete);
$sentencia->execute();
$lista_clave = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($lista_clave as $notificacion);
$agenciaClave = $notificacion['id_agencia'];

//Preparamos la inserción de los datos
$sentencia = $conexion->prepare("INSERT INTO notificaciones
        VALUES(null, :mensaje, :fecha, :estado, :agenciaClave, :mensaje_resumido)");
//Asignamos los valores que vienen del método POST (los que vienen del formulario)
$sentencia->bindParam(":mensaje",$mensaje);
$sentencia->bindParam(":fecha",$fecha);
$sentencia->bindParam(":estado",$estado);
$sentencia->bindParam(":agenciaClave",$agenciaClave);
$sentencia->bindParam(":mensaje_resumido",$mensaje_resumido);
$sentencia->execute();

?><script>
    alert("Felicidades, Registro completado con éxito!");
    window.location = "../../../index.php";
</script><?php

} catch(Exception $ex) {

?><script>
    alert("ERROR: no se ha podido registrar la información");
    alert("Revise su conexion a internet");
</script><?php

}


}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>JOME</title>
    <meta http-equiv="og:image" content="../../../assets/img/fotos/altaeducacion.png">
    <meta property="og:description" content="Aplicación Web de Gestión de Clases Particulares">
    <meta name="description" content="Aplicación Web encargada de llevar a cabo la Gestión de una Agencia cualquiera de Clases Particulares">
    <meta property="og:image" content="../../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="../../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="../../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="../../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="../../../assets/img/fotos/altaeducacion.png">
    <link rel="icon" type="image/png" sizes="750x719" href="../../../assets/img/fotos/altaeducacion.png">
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arbutus+Slab">
    <link rel="stylesheet" href="../../../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../../assets/css/Animated-Text-Background.css">
    <link rel="stylesheet" href="../../../assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="../../../assets/css/best-carousel-slide.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="../../../assets/css/Pricing-Free-Paid-badges.css">
    <link rel="stylesheet" href="../../../assets/css/Pricing-Free-Paid-icons.css">
    <link rel="stylesheet" href="../../../assets/css/responsive-blog-card-slider.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid"> <br>
                    <h3 class="text-dark mb-4">Configuración de la Agencia de Clases Particulares</h3>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row mb-3 d-none">
                                <div class="col">
                                    <div class="card text-white bg-primary shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card text-white bg-success shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Datos de la Agencia</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Nombre</strong><br></label><input class="form-control" type="text" id="nombre_agencia" name="nombre_agencia"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Fundador</strong><br></label><input class="form-control" type="text" id="fundador_agencia" name="fundador_agencia"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Email</strong><br></label><input class="form-control" type="email" id="email_agencia" name="email_agencia"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Teléfono</strong><br></label><input class="form-control" type="tel" id="telefono_agencia" name="telefono_agencia"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Otros Datos</p>
                                        </div>
                                        <div class="card-body">
                                                <div class="mb-3"></div>
                                                <div class="mb-3"><label class="form-label"><strong>Ubicación</strong><br></label></div><input class="form-control" type="text" id="direccion_agencia" name="direccion_agencia" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;">
                                                <div class="mb-3"><label class="form-label"><strong>Página Web</strong><br></label></div><input class="form-control" type="text" id="web_agencia" name="web_agencia" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label"><strong>Fecha de Fundación</strong><br></label>
                                                            <input class="form-control" type="date" id="fecha_agencia" name="fecha_agencia">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Archivo Adicional (formato PDF)</p>
                        </div>
                        <div class="card-body"><input type="file" style="margin-top: 24px;" id="pdf_agencia" name="pdf_agencia" accept=".pdf"></div>
                    </div>
                    <div class="card shadow mb-5" style="margin-top: -25px;margin-bottom: 36px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Logo</p>
                        </div>
                        <div class="card-body">
                            <input type="file" style="margin-top: 24px;" id="logo_agencia" name="logo_agencia" accept="image/*"></div>
                    </div>
                    <div class="card shadow mb-5" style="margin-top: -26px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Descripción</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                        <div class="mb-3"><textarea class="form-control" rows="5" id="descripcion_agencia" name="descripcion_agencia"></textarea></div>
                                        <div class="mb-3"><button class="btn btn-success btn-sm" type="submit" style="color: var(--bs-card-bg);">Registrar</button></div>
                                        <div class="mb-3"></div>
                                    </form>
                                </div>
                            </div>
                            <p class="m-0 fw-bold" style="text-align: justify;font-size: 16px;"><span style="color: rgb(194, 9, 9);">NB: si su Agencia carece de algún que otra información, puedes dejar ese campo vacío.</span></p>
                            <p class="m-0 fw-bold" style="text-align: justify;font-size: 16px;"><span style="color: rgb(194, 9, 9);">Cabe resaltar que la información introducida se podrá modificar después.</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © JOME 2024</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="../../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="../../../assets/js/Animated-Text-Background.js"></script>
    <script src="../../../assets/js/responsive-blog-card-slider-1.js"></script>
    <script src="../../../assets/js/responsive-blog-card-slider.js"></script>
    <script src="../../../assets/js/theme.js"></script>
</body>

</html>
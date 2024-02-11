<?PHP
session_start();

//Habilitar el acceso sólo para los administradores
if($_SESSION['rol_usuario']=='ADMINISTRADOR'){

$idAgencia = $_GET['agencia'];

include ('../../../base_datos/bd.php');

//Coger los campos a mostrar en la BD
if(isset($_GET['email'])) {

//listar la información de la base de datos (para obtener la información de la agencia)
$email = $_GET['email'];
$sentencia = $conexion->prepare("SELECT * FROM agencias 
WHERE paquete = :email");
$sentencia->bindParam(":email",$email);
$sentencia->execute();
$lista_agencia = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($lista_agencia as $agencia);


if($_POST) {

//Recolectamos los datos del método POST
$nombre_agencia = (isset($_POST["nombre_agencia"])?$_POST["nombre_agencia"]:"");
$fundador_agencia = (isset($_POST["fundador_agencia"])?$_POST["fundador_agencia"]:"");
$fecha_agencia = (isset($_POST["fecha_agencia"])?$_POST["fecha_agencia"]:"");
$direccion_agencia = (isset($_POST["direccion_agencia"])?$_POST["direccion_agencia"]:"");
$web_agencia = (isset($_POST["web_agencia"])?$_POST["web_agencia"]:"");
$telefono_agencia = (isset($_POST["telefono_agencia"])?$_POST["telefono_agencia"]:"");
$email_agencia = (isset($_POST["email_agencia"])?$_POST["email_agencia"]:"");
$descripcion_agencia = (isset($_POST["descripcion_agencia"])?$_POST["descripcion_agencia"]:"");

try {
    //Preparamos la inserción de los datos
    $sentencia = $conexion->prepare("UPDATE agencias
            SET nombre_agencia = :nombre_agencia, fundador_agencia = :fundador_agencia, fecha_agencia = :fecha_agencia, 
            direccion_agencia = :direccion_agencia, web_agencia = :web_agencia, telefono_agencia = :telefono_agencia, email_agencia = :email_agencia, 
            descripcion_agencia = :descripcion_agencia 
            WHERE id_agencia = :id");
    //Asignamos los valores que vienen del método POST (los que vienen del formulario)
    $sentencia->bindParam(":nombre_agencia",$nombre_agencia);
    $sentencia->bindParam(":fundador_agencia",$fundador_agencia);
    $sentencia->bindParam(":fecha_agencia",$fecha_agencia);
    $sentencia->bindParam(":direccion_agencia",$direccion_agencia);
    $sentencia->bindParam(":web_agencia",$web_agencia);
    $sentencia->bindParam(":telefono_agencia",$telefono_agencia);
    $sentencia->bindParam(":email_agencia",$email_agencia);
    $sentencia->bindParam(":descripcion_agencia",$descripcion_agencia);
    $sentencia->bindParam(":id",$agencia['id_agencia']);
    $sentencia->execute();

    //Datos de la foto (actualizar)
    $logo_agencia = (isset($_FILES["logo_agencia"]['name'])?$_FILES["logo_agencia"]['name']:"");
    $fecha_foto = new DateTime();
    $nombreArchivo_foto = ($logo_agencia!='')?$fecha_foto->getTimestamp()."_".$_FILES["logo_agencia"]['name']:"";
    $tmp_foto = $_FILES["logo_agencia"]['tmp_name'];
    
    if($tmp_foto!='') {
    
        move_uploaded_file($tmp_foto, "./".$nombreArchivo_foto);

    //buscar el archivo relacionado con el empleado (imagen)
    $sentencia = $conexion->prepare("SELECT logo_agencia FROM agencias
    WHERE id_agencia = :id");
    $sentencia->bindParam(":id",$agencia['id_agencia']);
    $sentencia->execute();
    $listar_logo = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach($listar_logo as $registro_recuperado);

    if(isset($registro_recuperado["logo_agencia"]) && $registro_recuperado["logo_agencia"]!="") {

        if(file_exists("./".$registro_recuperado["logo_agencia"])) {
            unlink("./".$registro_recuperado["logo_agencia"]);
        }

    }

    //Actualizamos la foto
    $sentencia = $conexion->prepare("UPDATE agencias 
    SET logo_agencia = :logo_agencia
    WHERE id_agencia = :id");
    $sentencia->bindParam(":logo_agencia",$nombreArchivo_foto);
    $sentencia->bindParam(":id",$agencia['id_agencia']);
    $sentencia->execute();
}

    //Datos del archivo (actualizar)
    $pdf_agencia = (isset($_FILES["pdf_agencia"]['name'])?$_FILES["pdf_agencia"]['name']:"");
    $fecha_cv = new DateTime();
    $nombreArchivo_cv = ($pdf_agencia!='')?$fecha_cv->getTimestamp()."_".$_FILES["pdf_agencia"]['name']:"";
    $tmp_cv = $_FILES["pdf_agencia"]['tmp_name'];
    
    if($tmp_cv!='') {
    
        move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);

    //buscar el archivo relacionado con el empleado (documento)
    $sentencia = $conexion->prepare("SELECT pdf_agencia 
    FROM agencias
    WHERE id_agencia = :id");
    $sentencia->bindParam(":id",$agencia['id_agencia']);
    $sentencia->execute();
    $listar_pdf = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach($listar_pdf as $registro_recuperado);

    if(isset($registro_recuperado["pdf_agencia"]) && $registro_recuperado["pdf_agencia"]!="") {

        if(file_exists("./".$registro_recuperado["pdf_agencia"])) {
            unlink("./".$registro_recuperado["pdf_agencia"]);
        }

    }

    //Actualizamos el archivo
    $sentencia = $conexion->prepare("UPDATE agencias 
    SET pdf_agencia = :pdf_agencia 
    WHERE id_agencia = :id");
    $sentencia->bindParam(":pdf_agencia",$nombreArchivo_cv);
    $sentencia->bindParam(":id",$agencia['id_agencia']);
    $sentencia->execute();
}
   
$volver = $agencia['paquete']."&agencia=".$idAgencia;

?><script>
   alert("Información Modificada");
   window.location = "../inicio.php?email=<?php echo($volver); ?>";
</script><?php

} catch(Exception $ex) {

?><script>
    alert("ERROR: no se ha podido registrar la información");
    alert("Revise su conexion a internet");
</script><?php

}

}

}

//Nueva SECCION (cabezado y pie integrado)
$url_base = "http://localhost/JOME/";
$txtAgencia = $_GET['agencia'];
$url_fin = "?email=".$_GET['email']."&agencia=".$txtAgencia;

$txtUsuario = $_GET['email'];

//listar la información de la base de datos (Logo y Nombre de la Agencia)
$sentencia = $conexion->prepare("SELECT logo_agencia, nombre_agencia FROM agencias
WHERE paquete = :email");
$sentencia->bindParam(":email",$txtUsuario);
$sentencia->execute();
$listar_consulta = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($listar_consulta as $registro);

//listar la información de la base de datos (para las nuevas notificaciones)
$estado = "Pendiente";
$sentencia = $conexion->prepare("SELECT mensaje_notificacion FROM notificaciones 
WHERE estado_notificacion = :estado
AND agencia = :agencia");
$sentencia->bindParam(":estado",$estado);
$sentencia->bindParam(":agencia",$txtAgencia);
$sentencia->execute();
$lista_Agencia = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//listar el conteo de las notificaciones pendientes
$pendiente = "Pendiente";
$sentencia = $conexion->prepare("SELECT COUNT('id_notificacion') as cantidad FROM notificaciones 
WHERE estado_notificacion = :estado 
AND agencia = :agencia");
$sentencia->bindParam(":agencia",$txtAgencia);
$sentencia->bindParam(":estado",$pendiente);
$sentencia->execute();
$listarInfo = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($listarInfo as $conteo);

?>


<!DOCTYPE html>
<html>

<head>

<!-- DataTable (css) -->
<link rel="stylesheet" href="../../../librerias/jquery/jquery.dataTables.css">
<!-- sweetalert2 (css) -->
<link rel="stylesheet" href="../../../librerias/sweetalert2/sweetalert2.min.css">


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
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" >
                    <div class="sidebar-brand-icon rotate-n-15"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 37px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M0 219.2v212.5c0 14.25 11.62 26.25 26.5 27C75.32 461.2 180.2 471.3 240 511.9V245.2C181.4 205.5 79.99 194.8 29.84 192C13.59 191.1 0 203.6 0 219.2zM482.2 192c-50.09 2.848-151.3 13.47-209.1 53.09C272.1 245.2 272 245.3 272 245.5v266.5c60.04-40.39 164.7-50.76 213.5-53.28C500.4 457.9 512 445.9 512 431.7V219.2C512 203.6 498.4 191.1 482.2 192zM352 96c0-53-43-96-96-96S160 43 160 96s43 96 96 96S352 149 352 96z"></path>
                        </svg></div>
                    <div class="sidebar-brand-text mx-3"><span>&nbsp;JOME</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar-1">
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>bloques/admin/inicio.php<?php echo ($url_fin);?>"><i class="fas fa-tachometer-alt"></i><span>Registro</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>bloques/admin/modulos/profesores/profesores.php<?php echo ($url_fin);?>"><i class="fas fa-user-secret"></i><span>Profesores</span></a>
                    <a class="nav-link" href="<?php echo $url_base;?>bloques/admin/modulos/estudiantes/estudiantes.php<?php echo ($url_fin);?>"><i class="fas fa-user-graduate"></i><span>Estudiantes</span></a>
                    <a class="nav-link" href="<?php echo $url_base;?>bloques/admin/modulos/cursos/cursos.php<?php echo ($url_fin);?>"><i class="fas fa-archway"></i><span>Cursos</span></a>
                    <a class="nav-link" href="<?php echo $url_base;?>bloques/admin/modulos/materiales/meterias.php<?php echo ($url_fin);?>"><i class="fas fa-book"></i><span>Materias</span></a>
                    <a class="nav-link" href="<?php echo $url_base;?>bloques/admin/modulos/asignaciones/asignaciones.php<?php echo ($url_fin);?>"><i class="fas fa-list-ul"></i>Asignaciones</a>
                    <a class="nav-link" href="<?php echo $url_base;?>bloques/admin/modulos/horarios/horarios.php<?php echo ($url_fin);?>"><i class="far fa-calendar-alt"></i>Horarios</a>
                    <a class="nav-link" href="<?php echo $url_base;?>bloques/admin/reportes.php<?php echo ($url_fin);?>"><i class="fas fa-chart-pie"></i>Reportes</a></li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>bloques/admin/modulos/usuarios/usuarios.php<?php echo ($url_fin);?>"><i class="far fa-user-circle"></i><span>Usuarios</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle-1" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button><a class="btn btn-dark disabled btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" href="#" title="Visitas"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-eye-fill text-white">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path>
                            </svg></a><span class="badge bg-danger badge-counter" style="margin-top: 1px;margin-bottom: 0px;margin-left: 2px;">132</span>
                        <div class="d-none d-sm-block topbar-divider"></div><span class="d-none d-lg-inline me-2 text-gray-600 small" style="margin-left: 0px;">Plataforma de Clases Particulares JOME</span><span class="d-none d-lg-inline me-2 text-gray-600 small"></span>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter"><?php echo($conteo['cantidad']) ?></span><i class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-list dropdown-menu-end animated--grow-in">
                                        <h6 class="dropdown-header">NOTIFICACIONES</h6>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr></tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($lista_Agencia as $lista) { ?>
                                                    <tr>
                                                        <td><?php echo ($lista['mensaje_notificacion']) ?></td>
                                                    </tr>
                                                </tbody>
                                                <?php } ?>
                                            </table>
                                        </div>
                                        <a class="text-center dropdown-item small text-gray-500" href="<?php echo $url_base;?>bloques/admin/notificaciones.php<?php echo ($url_fin);?>">Ver todas las notificaciones!</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                    <span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo($registro['nombre_agencia']); ?></span>
                                    <img class="rounded-circle mb-3 mt-4" src="./<?php echo $registro['logo_agencia']; ?>" width="45" height="45" style="margin-left: 1px;margin-bottom: 45px;margin-top: 46px;"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="<?php echo $url_base;?>bloques/admin/perfil.php<?php echo $url_fin;?>"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Perfil</a>
                                    <a class="dropdown-item" href="<?php echo $url_base;?>bloques/admin/cuenta/modificarPerfil.php<?php echo $url_fin;?>"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Ajustes</a>
                                    <a class="dropdown-item" href="<?php echo $url_base;?>bloques/admin/infoAdmin.php<?php echo $url_fin; ?>"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Info!</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../../../cerrar_sesion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Cerrar sesión!</a>
                                </div>
                            </div>
                            </li>
                        </ul>
                    </div>
                </nav>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid"><br>
                    <h3 class="text-dark mb-4">Modificar Perfil</h3>
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
                                        <img class="rounded-circle mb-3 mt-4" src="./<?php echo $agencia['logo_agencia']; ?>" width="160" height="160" style="margin-left: 1px;margin-bottom: 45px;margin-top: 46px;">
                                        <p class="text-primary m-0 fw-bold" style="margin-top: -23px;margin-bottom: -36px;padding-top: 24px;">Datos</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Nombre de la Agencia</strong><br></label><input class="form-control" type="text" id="nombre_agencia" name="nombre_agencia" value="<?php echo $agencia['nombre_agencia']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Fundador</strong><br></label><input class="form-control" type="text" id="fundador_agencia" name="fundador_agencia" value="<?php echo $agencia['fundador_agencia']; ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label"><strong>Fecha de Fundación</strong><br></label>
                                                            <input class="form-control" type="date" id="fecha_agencia" value="<?php echo $agencia['fecha_agencia']; ?>" name="fecha_agencia">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Dirección</strong><br></label><input class="form-control" type="text" id="direccion_agencia" name="direccion_agencia" value="<?php echo $agencia['direccion_agencia']; ?>"></div>
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
                                                <div class="mb-3"><label class="form-label"><strong>Página Web</strong><br></label></div><input class="form-control" type="text" id="web_agencia" name="web_agencia" value="<?php echo $agencia['web_agencia']; ?>" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Teléfono</strong><br></label><input class="form-control" type="tel" id="telefono_agencia" name="telefono_agencia" value="<?php echo $agencia['telefono_agencia']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Email</strong><br></label><input class="form-control" type="email" id="email_agencia" name="email_agencia" value="<?php echo $agencia['email_agencia']; ?>"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Modificar Logo</p>
                        </div>
                        <div class="card-body">
                        <input type="file" style="margin-top: 24px;" id="logo_agencia" name="logo_agencia" accept="image/*"></div>
                    </div>
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Modificar el Archivo Adjuntado</p>
                        </div>
                        <div class="card-body"><label class="form-label"><strong>Archivo:&nbsp; &nbsp;</strong></label>
                        <label class="form-label" for="city"><strong>
                        <a href="./<?php echo $agencia['pdf_agencia'];?>" target="_blank" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i>
                        </a></div>
                        <div class="card-body">
                        <input type="file" style="margin-top: 24px;" id="pdf_agencia" name="pdf_agencia" accept=".pdf">
                        </div><br>
                    </div>
                    <div class="card shadow mb-3" style="margin-top: -26px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Descripción</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                        <div class="mb-3">
                                            <input class="form-control" id="descripcion_agencia" rows="5" name="descripcion_agencia" value="<?php echo $agencia['descripcion_agencia']; ?>"></input></div><br>
                                            <button class="btn btn-success btn-sm" type="submit" style="color: var(--bs-card-bg);">Modificar</button>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
</div>
<footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © JOME <?php echo date("Y"); ?></span></div>
                </div>
            </footer>
        </div>
    </div>
    <script src="../../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="../../../assets/js/Animated-Text-Background.js"></script>
    <script src="../../../assets/js/responsive-blog-card-slider-1.js"></script>
    <script src="../../../assets/js/responsive-blog-card-slider.js"></script>
    <script src="../../../assets/js/theme.js"></script>

    <!-- jquery (js) -->
<script src = "../../../librerias/jquery/jquery-3.7.1.min.js"></script>
<!-- DataTable (js) -->
<script src = "../../../librerias/jquery/jquery.dataTables.js"></script>
<!-- popper (js) -->
<script src = "../../../librerias/popper/js/popper.min.js"></script>
<!-- sweetalert2 (js) -->
<script src = "../../../librerias/sweetalert2/sweetalert2.all.min.js"></script>
<!-- incluimos el scripts de las alertas personalizadas-->
<script src = "../../../librerias/codigo_alertas.js"></script>

</body>

</html>
<?php } else {

header('location: ../../../index.php');

}
?>
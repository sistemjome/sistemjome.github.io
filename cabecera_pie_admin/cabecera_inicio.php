<?PHP
session_start();

//Habilitar el acceso sólo para los administradores
if($_SESSION['rol_usuario']=='ADMINISTRADOR'){
$txtAgencia = $_GET['agencia'];

$url_base = "http://localhost/JOME/";
$url_fin = "?email=".$_GET['email']."&agencia=".$txtAgencia;


include('../../base_datos/bd.php');

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
<link rel="stylesheet" href="../../librerias/jquery/jquery.dataTables.css">
<!-- sweetalert2 (css) -->
<link rel="stylesheet" href="../../librerias/sweetalert2/sweetalert2.min.css">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>JOME</title>
    <meta http-equiv="og:image" content="../../assets/img/fotos/altaeducacion.png">
    <meta property="og:description" content="Aplicación Web de Gestión de Clases Particulares">
    <meta name="description" content="Aplicación Web encargada de llevar a cabo la Gestión de una Agencia cualquiera de Clases Particulares">
    <meta property="og:image" content="../../assets/img/fotos/altaeducacion.png">
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
                                    <img class="rounded-circle mb-3 mt-4" src="cuenta/./<?php echo $registro['logo_agencia']; ?>" width="45" height="45" style="margin-left: 1px;margin-bottom: 45px;margin-top: 46px;"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="<?php echo $url_base;?>bloques/admin/perfil.php<?php echo $url_fin;?>"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Perfil</a>
                                    <a class="dropdown-item" href="<?php echo $url_base;?>bloques/admin/cuenta/modificarPerfil.php<?php echo $url_fin;?>"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Ajustes</a>
                                    <a class="dropdown-item" href="<?php echo $url_base;?>bloques/admin/infoAdmin.php<?php echo $url_fin; ?>"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Info!</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../../cerrar_sesion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Cerrar sesión!</a>
                                </div>
                            </div>
                            </li>
                        </ul>
                    </div>
                </nav>
<?php } else {

header('location: ../../index.php');

}
?>
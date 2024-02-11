<?php 
$url_base = "http://localhost/JOME/";
$agencia = $_GET['agencia'];
$mensaje = $_GET['mensaje'];
$url_fin = "?email=".$_GET['email']."&agencia=".$agencia;
include('../../base_datos/bd.php');


//Modificar el estado de la notificacion (de Pendiente a Visto)
$visto = "Visto";
$sentencia = $conexion->prepare("UPDATE notificaciones SET estado_notificacion = :estado 
WHERE mensaje_resumido = :notificacion");
$sentencia->bindParam(":notificacion",$mensaje);
$sentencia->bindParam(":estado",$visto);
$sentencia->execute();

//listar la información de la base de datos (para obtener id de agencia)
$sentencia = $conexion->prepare("SELECT mensaje_notificacion FROM notificaciones 
WHERE mensaje_resumido = :mensaje_resumido");
$sentencia->bindParam(":mensaje_resumido",$mensaje);
$sentencia->execute();
$listar = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($listar as $notificacion);


?>


<?php include("../../cabecera_pie_admin/cabecera_inicio.php"); ?>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                 <div class="text-uppercase text-warning fw-bold text-xs mb-1"><h3>Notificacion</h3></div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div><span style="font-size: 18px;"><span style="font-weight: normal !important; font-style: normal !important;"><?php echo $notificacion['mensaje_notificacion'] ?></span><br></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<a class="border rounded d-inline scroll-to-top" href="<?php echo($url_base); ?>bloques/admin/notificaciones.php<?php echo($url_fin); ?>"><i class="fas fa-angle-left"></i></a>
<?php include("../../cabecera_pie_admin/pie_inicio.php"); ?>
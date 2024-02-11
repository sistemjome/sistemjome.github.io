<?php
$email = $_GET['email'];
$agencia = $_GET['agencia'];
include('../../base_datos/bd.php');

//listar la información de la base de datos (para obtener las notificaciones)
$sentencia = $conexion->prepare("SELECT * FROM notificaciones 
WHERE agencia = :agencia
ORDER BY fecha_notificacion ASC");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->execute();
$lista_notificaciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);



include("../../cabecera_pie_admin/cabecera_inicio.php"); ?>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">NOTIFICACIONES</h3>
                    <div class="card shadow">
                        <div class="card-header py-3"></div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="tabla_id">
                                    <thead>
                                        <tr>
                                            <th style="margin-right: 0px;padding-right: 0px;">Mensaje</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach($lista_notificaciones as $noti) { ?>
                                        <tr>
                                            <td><span style="font-weight: normal !important; font-style: normal !important;"><?php echo($noti['mensaje_resumido']); ?></span><br></td>
                                            <td><?php echo($noti['fecha_notificacion']); ?></td>
                                            <td><?php echo($noti['estado_notificacion']); ?></td>
                                            <td><a class="btn btn-info btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="right" href="vernotificaciones.php?email=<?php echo($email); ?>&agencia=<?php echo($agencia) ?>&mensaje=<?php echo($noti['mensaje_resumido']); ?>" title="Abrir"><i class="fas fa-eye text-white"></i></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../../cabecera_pie_admin/pie_inicio.php"); ?>
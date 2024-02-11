<?php 
include('../../../../base_datos/bd.php');
include('eliminarProfesor.php');
$url_base = "http://localhost/";
$agencia = $_GET['agencia'];
$url_fin = "?email=".$_GET['email']."&agencia=".$agencia;
$rol = "Profesor";



//listar la información de la base de datos (para obtener a los profesores registrados)
$sentencia = $conexion->prepare("SELECT * FROM personal
WHERE agencia = :agencia
AND rol_personal = :rol");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->bindParam(":rol",$rol);
$sentencia->execute();
$lista_personal = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../../../cabecera_pie_admin/cabecera.php");?>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Listado de los Profesores</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                        <a class="btn btn-primary btn-icon-split" role="button" href="<?php echo($url_base); ?>bloques/admin/modulos/profesores/registrarProfesor.php<?php echo($url_fin); ?>"><span class="text-white-50 icon"><i class="fas fa-save"></i></span><span class="text-white text">Registrar</span></a></div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="tabla_id">
                                    <thead>
                                        <tr>
                                            <th style="margin-right: 0px;padding-right: 0px;">Foto</th>
                                            <th>Nombre Completo</th>
                                            <th>Dirección</th>
                                            <th>Teléfono</th>
                                            <th>Email</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($lista_personal as $personal)  { $borrar = $url_fin."&id=".$personal['email_personal']; ?>
                                        <tr>
                                            <td><img class="rounded-circle me-2" width="30" height="30" src="./<?php echo $personal['foto_personal']; ?>"></td>
 
                                            <td><?php $nombre_completo = $personal['nombre_personal']." ".$personal['apellidos_personal']; echo($nombre_completo); ?></td>
                                            <td><?php echo($personal['barrio_personal']); ?></td>
                                            <td><?php echo($personal['telefono_personal']); ?></td>
                                            <td><?php echo($personal['email_personal']); ?></td>
                                            <td>
                                            <a href="perfilrProfesor.php<?php echo $borrar; ?>" class="btn btn-success btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" title="Perfil"><i class="fas fa-check text-white"></i></a>
                                            <a href="editarProfesor.php<?php echo $borrar; ?>" class="btn btn-warning btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" title="Modificar"><i class="fas fa-exclamation-triangle text-white"></i></a>
                                            <a href="profesores.php<?php echo $borrar; ?>"  class="btn btn-danger btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" title="Eliminar"><i class="fas fa-trash text-white"></i></a>
                                            </td>
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
<?php include("../../../../cabecera_pie_admin/pie.php");?>
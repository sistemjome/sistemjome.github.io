<?php 
include('../../../../base_datos/bd.php');
include('eliminarCurso.php');
$url_base = "http://localhost/";
$agencia = $_GET['agencia'];
$url_fin = "?email=".$_GET['email']."&agencia=".$agencia;


//listar la información de la base de datos
$sentencia = $conexion->prepare("SELECT * FROM cursos
WHERE agencia = :agencia");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->execute();
$lista_cursos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include("../../../../cabecera_pie_admin/cabecera.php");?>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Listado de los Cursos</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <a class="btn btn-primary btn-icon-split" role="button" href="registrarCurso.php<?php echo($url_fin); ?>"><span class="text-white-50 icon"><i class="fas fa-save"></i></span><span class="text-white text">Registrar</span></a></div>
                            <br/>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="tabla_id">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($lista_cursos as $curso)  { $borrar = $url_fin."&id=".$curso['id_curso']; ?>
                                        <tr>
                                            <td><?php echo($curso['nombre_curso']); ?></td>
                                            <td>
                                                <a class="btn btn-success btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" href="perfilCurso.php<?php echo $borrar; ?>" title="Perfil"><i class="fas fa-check text-white"></i></a>
                                                <a class="btn btn-warning btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" href="editarCurso.php<?php echo $borrar; ?>" title="Modificar"><i class="fas fa-exclamation-triangle text-white"></i></a>
                                                <a class="btn btn-danger btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" href="cursos.php<?php echo $borrar; ?>" title="Eliminar"><i class="fas fa-trash text-white"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                            <a class="btn btn-primary" role="button" href="duracionCurso.php<?php echo($url_fin); ?>"><i class="fas"></i><span class="text-white text">Duración del curso</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../../../../cabecera_pie_admin/pie.php");?>
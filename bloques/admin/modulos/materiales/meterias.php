<?php 
include('../../../../base_datos/bd.php');
include('eliminarMateria.php');
$url_base = "http://localhost/";
$agencia = $_GET['agencia'];
$url_fin = "?email=".$_GET['email']."&agencia=".$agencia;

//listar la información de la base de datos
$sentencia = $conexion->prepare("SELECT nombre_materia, id_materia, nombre_curso 
FROM materias M, cursos C
WHERE C.id_curso = M.curso
AND C.agencia = :agencia");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->execute();
$lista_materias = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../../../cabecera_pie_admin/cabecera.php");?>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Listado de las Materias</h3>
                    <div class="card shadow">
                        <div class="card-header py-3"><a class="btn btn-primary btn-icon-split" role="button" href="registrarMateria.php<?php echo($url_fin); ?>"><span class="text-white-50 icon"><i class="fas fa-save"></i></span><span class="text-white text">Registrar</span></a></div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="tabla_id">
                                    <thead>
                                        <tr>
                                            <th>Materias</th>
                                            <th>Cursos</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($lista_materias as $materia)  { $borrar = $url_fin."&id=".$materia['id_materia']; ?>
                                        <tr>
                                            <td><?php echo($materia['nombre_materia']); ?></td>
                                            <td><?php echo($materia['nombre_curso']); ?></td>
                                        <td>
                                            <a class="btn btn-success btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" href="perfilMateria.php<?php echo $borrar; ?>" title="Perfil"><i class="fas fa-check text-white"></i></a>
                                            <a class="btn btn-warning btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" href="editarMateria.php<?php echo $borrar; ?>" title="Modificar"><i class="fas fa-exclamation-triangle text-white"></i></a>
                                            <a class="btn btn-danger btn-circle ms-1"  role="button" data-bs-toggle="tooltip" data-bss-tooltip="" href="meterias.php<?php echo $borrar; ?>" title="Eliminar"><i class="fas fa-trash text-white"></i></a>
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
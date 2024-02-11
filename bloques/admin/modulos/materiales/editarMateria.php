<?php
include('../../../../base_datos/bd.php');
$agencia = $_GET['agencia'];
$id = $_GET['id'];
$url_fin = "?email=".$_GET['email']."&agencia=".$agencia;

//listar la información de la base de datos
$sentencia = $conexion->prepare("SELECT * FROM materias 
WHERE id_materia = :id
AND agencia = :agencia");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->bindParam(":id",$id);
$sentencia->execute();
$listar_materia = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($listar_materia as $materia);
$id_curso = $materia['curso'];

if($_POST) {

//Recolectamos los datos del método POST
$nombre_materia = (isset($_POST["nombre_materia"])?$_POST["nombre_materia"]:"");
$curso = (isset($_POST["curso"])?$_POST["curso"]:"");

//listar la información de la base de datos para evitar que se repita la informacin
$sentencia = $conexion->prepare("SELECT nombre_materia, id_curso 
FROM materias M, cursos C
WHERE C.id_curso = M.curso
AND M.agencia = :agencia
AND M.nombre_materia = :materia
AND C.id_curso = :curso");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->bindParam(":materia",$_POST["nombre_materia"]);
$sentencia->bindParam(":curso",$_POST["curso"]);
$sentencia->execute();
$listar = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($listar as $list);

if($listar){

    ?><script
    src = "../../../.././alertas/existenteMateria.js">
    </script><?php
    
    } else {

        
try {
    //Preparamos la inserción de los datos
    $sentencia = $conexion->prepare("UPDATE materias 
    SET nombre_materia = :nombre
    WHERE id_materia = :id
    AND agencia = :agencia");
    //Asignamos los valores que vienen del método POST (los que vienen del formulario)
    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":nombre",$nombre_materia);
    $sentencia->bindParam(":agencia",$agencia);
    $sentencia->execute();
    
?><script>
window.location = "cursos.php<?php echo $volver; ?>";
</script><?php
        
        } catch(Exception $ex) {
        
        ?><script>
            alert("ERROR: no se ha podido registrar la información");
            alert("Verifique su conexión a internet");
        </script><?php
        
        }
    
    }
}

//listar la información de la base de datos (para optener los cursos)
$sentencia = $conexion->prepare("SELECT * FROM cursos 
WHERE agencia = :agencia");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->execute();
$lista_cursos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../../../cabecera_pie_admin/cabecera.php");?>


                <div class="container-fluid">
                <h3 class="text-danger mb-4 fw-bold">Modificar <?php echo($materia['nombre_materia']); ?></h3>
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
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <form method="post">
                                                <div class="mb-3"><label class="form-label"><strong>Nombre de la materia</strong><br></label></div>
                                                <input class="form-control" type="text" name="nombre_materia" value="<?php echo($materia['nombre_materia']); ?>" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body" style="padding-bottom: 22px;">
                                                <div class="mb-3"><label class="form-label"><br>
                                                <select class="form-select" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="right" name="curso">
                                                <?php foreach($lista_cursos as $cursos) { ?>
                                                        <option <?php echo ($cursos['id_curso']==$id_curso)?"selected":"";?> value="<?php echo $cursos['id_curso']?>">
                                                <?php echo $cursos['nombre_curso']?> </option> <?php } ?> 
                                                </select></label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5" style="margin-top: -6px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                        <div class="mb-3"></div>
                                        <div class="mb-3">
                                        <button class="btn btn-success btn-sm" type="submit" style="color: var(--bs-card-bg);">Modificar</button>
                                        <a class="btn btn-danger btn-sm" role="button" style="margin-left: 11px;" href="meterias.php<?php echo($url_fin) ?>">Cancelar</a></div>
                                        <div class="mb-3"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include("../../../../cabecera_pie_admin/pie.php");?>
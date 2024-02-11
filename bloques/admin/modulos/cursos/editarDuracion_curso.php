<?php

include ('../../../../base_datos/bd.php');

//Coger los campos a mostrar en la BD
if(isset($_GET['email'])) {

$agencia = $_GET['agencia'];
$id = $_GET['id'];
$sesion = $_GET['email'];
$volver = "?email=".$sesion."&agencia=".$agencia;

//listar la información de la base de datos
$sentencia = $conexion->prepare("SELECT * FROM duracion_cursos 
WHERE id_duracion = :id
AND agencia = :agencia");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->bindParam(":id",$id);
$sentencia->execute();
$lista_duracion = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($lista_duracion as $curso);

if($_POST) {

    //Recolectamos los datos del método POST
    $nombre_curso = (isset($_POST["nombre_curso"])?$_POST["nombre_curso"]:"");
    
    //listar la información de la base de datos para evitar que se repita la duración de los cursos
    $sentencia = $conexion->prepare("SELECT duracion FROM duracion_cursos
    WHERE agencia = :agencia
    AND duracion = :duracion");
    $sentencia->bindParam(":agencia",$agencia);
    $sentencia->bindParam(":duracion",$_POST["nombre_curso"]);
    $sentencia->execute();
    $listar = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach($listar as $duracionCurso);
    
    if($listar){
    
    ?><script
    src = "../../../.././alertas/existenteDuracion.js">
    </script><?php
    
    } else {

    try {
            //Preparamos la inserción de los datos
            $sentencia = $conexion->prepare("UPDATE duracion_cursos
                    SET duracion = :duracion 
                    WHERE id_duracion = :id
                    AND agencia = :agencia");
            //Asignamos los valores que vienen del método POST (los que vienen del formulario)
            $sentencia->bindParam(":duracion",$nombre_curso);
            $sentencia->bindParam(":id",$id);
            $sentencia->bindParam(":agencia",$agencia);
            $sentencia->execute();

?><script>
    window.location = "duracionCurso.php<?php echo $volver; ?>";
</script><?php

} catch(Exception $ex) {
echo($ex->getMessage());
?><script>
    alert("ERROR: no se ha podido registrar la información");
    alert("Revise su conexion a internet");
</script><?php

} 
}
}
}

?>


<?php include("../../../../cabecera_pie_admin/cabecera.php");?>
                <div class="container-fluid">
                <h3 class="text-danger mb-4 fw-bold">Modificar <?php echo($curso['duracion']); ?></h3>
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
                                                <div class="mb-3"><label class="form-label"><strong>Duración del Curso</strong><br></label></div><input class="form-control" type="text" value="<?php echo($curso['duracion']); ?>" name="nombre_curso" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5" style="margin-top: -26px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                        <div class="mb-3"></div>
                                        <div class="mb-3">
                                        <button class="btn btn-success btn-sm" type="submit" style="color: var(--bs-card-bg);">Modificar</button>
                                        <a class="btn btn-danger btn-sm" role="button" style="margin-left: 11px;" href="duracionCurso.php<?php echo($volver); ?>">Cancelar</a></div>
                                        <div class="mb-3"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include("../../../../cabecera_pie_admin/pie.php");?>
<?php

include ('../../../../base_datos/bd.php');

//Coger los campos a mostrar en la BD
if(isset($_GET['email'])) {

$agencia = $_GET['agencia'];
$id = $_GET['id'];
$sesion = $_GET['email'];
$volver = "?email=".$sesion."&agencia=".$agencia;

//listar la información de la base de datos 
$sentencia = $conexion->prepare("SELECT * FROM personal 
WHERE email_personal = :id
AND agencia = :agencia");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->bindParam(":id",$id);
$sentencia->execute();
$lista_estudiantes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($lista_estudiantes as $estudiante);
$id_curso = $estudiante['curso'];
$id_duracion = $estudiante['duracion_personal'];


if($_POST) {

//Recolectamos los datos del método POST

$nombre_personal = (isset($_POST["nombre_personal"])?$_POST["nombre_personal"]:"");
$apellidos_personal = (isset($_POST["apellidos_personal"])?$_POST["apellidos_personal"]:"");
$telefono_personal = (isset($_POST["telefono_personal"])?$_POST["telefono_personal"]:"");
$edad_personal = (isset($_POST["edad_personal"])?$_POST["edad_personal"]:"");
$nombre_tutor = (isset($_POST["nombre_tutor"])?$_POST["nombre_tutor"]:"");
$email_tutor = (isset($_POST["email_tutor"])?$_POST["email_tutor"]:"");
$telefono_tutor = (isset($_POST["telefono_tutor"])?$_POST["telefono_tutor"]:"");
$direccion_tutor = (isset($_POST["direccion_tutor"])?$_POST["direccion_tutor"]:"");
$ingreso_personal = (isset($_POST["ingreso_personal"])?$_POST["ingreso_personal"]:"");
$mensualidad_personal = (isset($_POST["mensualidad_personal"])?$_POST["mensualidad_personal"]:"");
$barrio_personal = (isset($_POST["barrio_personal"])?$_POST["barrio_personal"]:"");
$curso = (isset($_POST["curso"])?$_POST["curso"]:"");
$duracion_personal = (isset($_POST["duracion_personal"])?$_POST["duracion_personal"]:"");
$instituto_personal = (isset($_POST["instituto_personal"])?$_POST["instituto_personal"]:"");
$ciudad_personal = (isset($_POST["ciudad_personal"])?$_POST["ciudad_personal"]:"");

try {
    //Preparamos la inserción de los datos
    $sentencia = $conexion->prepare("UPDATE personal
            SET nombre_personal = :nombre_personal, apellidos_personal = :apellidos_personal, 
            telefono_personal = :telefono_personal, edad_personal = :edad_personal, nombre_tutor = :nombre_tutor, email_tutor = :email_tutor, 
            telefono_tutor = :telefono_tutor, direccion_tutor = :direccion_tutor, ingreso_personal = :ingreso_personal, 
            mensualidad_personal = :mensualidad_personal, barrio_personal = :barrio_personal, curso = :curso, 
            duracion_personal = :duracion_personal, instituto_personal = :instituto_personal, ciudad_personal = :ciudad_personal
            WHERE email_personal = :id
            AND agencia = :agencia");
    //Asignamos los valores que vienen del método POST (los que vienen del formulario)
    $sentencia->bindParam(":nombre_personal",$nombre_personal);
    $sentencia->bindParam(":apellidos_personal",$apellidos_personal);
    $sentencia->bindParam(":telefono_personal",$telefono_personal);
    $sentencia->bindParam(":edad_personal",$edad_personal);
    $sentencia->bindParam(":nombre_tutor",$nombre_tutor);
    $sentencia->bindParam(":email_tutor",$email_tutor);
    $sentencia->bindParam(":telefono_tutor",$telefono_tutor);
    $sentencia->bindParam(":direccion_tutor",$direccion_tutor);
    $sentencia->bindParam(":ingreso_personal",$ingreso_personal);
    $sentencia->bindParam(":mensualidad_personal",$mensualidad_personal);
    $sentencia->bindParam(":barrio_personal",$barrio_personal);
    $sentencia->bindParam(":curso",$curso);
    $sentencia->bindParam(":duracion_personal",$duracion_personal);
    $sentencia->bindParam(":instituto_personal",$instituto_personal);
    $sentencia->bindParam(":ciudad_personal",$ciudad_personal);
    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":agencia",$agencia);
    $sentencia->execute();

    //Datos de la foto (actualizar)
    $foto_personal = (isset($_FILES["foto_personal"]['name'])?$_FILES["foto_personal"]['name']:"");
    $fecha_foto = new DateTime();
    $nombreArchivo_foto = ($foto_personal!='')?$fecha_foto->getTimestamp()."_".$_FILES["foto_personal"]['name']:"";
    $tmp_foto = $_FILES["foto_personal"]['tmp_name'];
    
    if($tmp_foto!='') {
    
        move_uploaded_file($tmp_foto, "./".$nombreArchivo_foto);

    //buscar el archivo relacionado con el empleado (imagen)
    $sentencia = $conexion->prepare("SELECT foto_personal FROM personal
    WHERE email_personal = :id
    AND agencia = :agencia");
    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":agencia",$agencia);
    $sentencia->execute();
    $listar_logo = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach($listar_logo as $registro_recuperado);

    if(isset($registro_recuperado["foto_personal"]) && $registro_recuperado["foto_personal"]!="") {

        if(file_exists("./".$registro_recuperado["foto_personal"])) {
            unlink("./".$registro_recuperado["foto_personal"]);
        }

    }

    //Actualizamos la foto
    $sentencia = $conexion->prepare("UPDATE personal 
    SET foto_personal = :foto_personal
    WHERE email_personal = :id
    AND agencia = :agencia");
    $sentencia->bindParam(":foto_personal",$nombreArchivo_foto);
    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":agencia",$agencia);
    $sentencia->execute();
}

?><script>
    window.location = "estudiantes.php<?php echo $volver; ?>";
</script><?php

} catch(Exception $ex) {

?><script>
    alert("ERROR: no se ha podido registrar la información");
    alert("Revise su conexion a internet");
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

//listar la información de la base de datos (para optener la duración de los cursos)
$sentencia = $conexion->prepare("SELECT * FROM duracion_cursos 
WHERE agencia = :agencia");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->execute();
$lista_duracion = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>


<?php include("../../../../cabecera_pie_admin/cabecera.php");?>
                <div class="container-fluid">
                <h3 class="text-danger mb-4 fw-bold">Modificar la información de <?php echo($estudiante['nombre_personal']." ".$estudiante['apellidos_personal']); ?></h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                <img class="rounded-circle mb-3 mt-4" src="./<?php echo $estudiante['foto_personal']; ?>" width="180" height="180">
                                    <div class="mb-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
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
                                            <p class="text-primary m-0 fw-bold">Datos Personales</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Nombre</strong><br></label><input class="form-control" type="text" value="<?php echo($estudiante['nombre_personal']); ?>" name="nombre_personal"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Apellidos</strong><br></label><input class="form-control" type="text" value="<?php echo($estudiante['apellidos_personal']); ?>" name="apellidos_personal"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Teléfono</strong><br></label><input class="form-control" type="tel" value="<?php echo($estudiante['telefono_personal']); ?>" name="telefono_personal"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Edad</strong><br></label><input class="form-control" type="number" value="<?php echo($estudiante['edad_personal']); ?>" name="edad_personal"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Datos del Tutor</p>
                                        </div>
                                        <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Nombre del Tutor</strong><br></label><input class="form-control" type="text" value="<?php echo($estudiante['nombre_tutor']); ?>" name="nombre_tutor"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Email del Tutor</strong><br></label><input class="form-control" type="email" value="<?php echo($estudiante['email_tutor']); ?>" name="email_tutor"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Teléfono del Tutor</strong><br></label><input class="form-control" type="tel" value="<?php echo($estudiante['telefono_tutor']); ?>" name="telefono_tutor"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Dirección del Tutor</strong><br></label><input class="form-control" type="text" value="<?php echo($estudiante['direccion_tutor']); ?>" name="direccion_tutor"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Tasa de la Matrícula</p>
                                        </div>
                                        <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Ingreso</strong><br></label><input class="form-control" type="number" value="<?php echo($estudiante['ingreso_personal']); ?>" name="ingreso_personal"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Mensualidad</strong><br></label><input class="form-control" type="number" value="<?php echo($estudiante['mensualidad_personal']); ?>" name="mensualidad_personal"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Otros Datos</p>
                                        </div>
                                        <div class="card-body">
                                                <div class="mb-3"><label class="form-label"><strong>Barrio</strong><br></label></div><input class="form-control" type="text" value="<?php echo($estudiante['barrio_personal']); ?>" name="barrio_personal" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;">
                                                <div class="mb-3"><label class="form-label"><strong>Seleccione un curso</strong><br></label>
                                                 <select class="form-select" name="curso">
                                                <?php foreach($lista_cursos as $cursos) { ?>
                                                        <option <?php echo ($cursos['id_curso']==$id_curso)?"selected":"";?> value="<?php echo $cursos['id_curso']?>">
                                                <?php echo $cursos['nombre_curso']?> </option> <?php } ?> 
                                                    </select></div>
                                                <div class="mb-3"><label class="form-label"><strong>Seleccione la duración del curso</strong><br></label>
                                                <select class="form-select" name="duracion_personal">
                                                <?php foreach($lista_duracion as $duracion) { ?>
                                                        <option <?php echo ($duracion['id_duracion']==$id_duracion)?"selected":"";?>  value="<?php echo $duracion['id_duracion']?>">
                                                <?php echo $duracion['duracion']?> </option> <?php } ?>
                                                    </select></div>
                                                <div class="mb-3"><label class="form-label"><strong>Instituto</strong><br></label></div><input class="form-control" type="text" value="<?php echo($estudiante['instituto_personal']); ?>" name="instituto_personal" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Ciudad</strong></label><input class="form-control" type="text" value="<?php echo($estudiante['ciudad_personal']); ?>" name="ciudad_personal"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5" style="margin-bottom: 36px;margin-top: 0px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Foto (tamaño carnet)</p>
                        </div>
                        <div class="card-body"><label class="form-label"><strong>Foto&nbsp; &nbsp; &nbsp;&nbsp;</strong></label><input type="file" style="margin-top: 24px;" name="foto_personal" accept="image/*"></div>
                    </div>
                    <div class="card shadow mb-5" style="margin-top: -26px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                        <div class="mb-3"></div>
                                        <div class="mb-3">
                                        <button class="btn btn-success btn-sm" type="submit" style="color: var(--bs-card-bg);">Modificar</button>
                                        <a class="btn btn-danger btn-sm" role="button" style="margin-left: 11px;" href="estudiantes.php<?php echo $volver; ?>">Cancelar</a></div>
                                        <div class="mb-3"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include("../../../../cabecera_pie_admin/pie.php");?>
<?php

include ('../../../../base_datos/bd.php');

//Coger los campos a mostrar en la BD
if(isset($_GET['email'])) {

$agencia = $_GET['agencia'];
$id = $_GET['id'];
$sesion = $_GET['email'];
$volver = "?email=".$sesion."&agencia=".$agencia;

//listar la información de la base de datos (para obtener la información de la agencia)
$sentencia = $conexion->prepare("SELECT * FROM personal 
WHERE email_personal = :id
AND agencia = :agencia");
$sentencia->bindParam(":agencia",$agencia);
$sentencia->bindParam(":id",$id);
$sentencia->execute();
$lista_profesor = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($lista_profesor as $profesor);


if($_POST) {

//Recolectamos los datos del método POST

$nombre_personal = (isset($_POST["nombre_personal"])?$_POST["nombre_personal"]:"");
$apellidos_personal = (isset($_POST["apellidos_personal"])?$_POST["apellidos_personal"]:"");
$edad_personal = (isset($_POST["edad_personal"])?$_POST["edad_personal"]:"");
$barrio_personal = (isset($_POST["barrio_personal"])?$_POST["barrio_personal"]:"");
$ciudad_personal = (isset($_POST["ciudad_personal"])?$_POST["ciudad_personal"]:"");
$telefono_personal = (isset($_POST["telefono_personal"])?$_POST["telefono_personal"]:"");
$observacion_personal = (isset($_POST["observacion_personal"])?$_POST["observacion_personal"]:"");

try {
    //Preparamos la inserción de los datos
    $sentencia = $conexion->prepare("UPDATE personal
            SET nombre_personal = :nombre_personal, apellidos_personal = :apellidos_personal, 
            edad_personal = :edad_personal, barrio_personal = :barrio_personal, ciudad_personal = :ciudad_personal, telefono_personal = :telefono_personal, 
            observacion_personal = :observacion_personal 
            WHERE email_personal = :id
            AND agencia = :agencia");
    //Asignamos los valores que vienen del método POST (los que vienen del formulario)
    $sentencia->bindParam(":nombre_personal",$nombre_personal);
    $sentencia->bindParam(":apellidos_personal",$apellidos_personal);
    $sentencia->bindParam(":edad_personal",$edad_personal);
    $sentencia->bindParam(":barrio_personal",$barrio_personal);
    $sentencia->bindParam(":ciudad_personal",$ciudad_personal);
    $sentencia->bindParam(":telefono_personal",$telefono_personal);
    $sentencia->bindParam(":observacion_personal",$observacion_personal);
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

    //Datos del archivo (actualizar)
    $pdf_personal = (isset($_FILES["pdf_personal"]['name'])?$_FILES["pdf_personal"]['name']:"");
    $fecha_cv = new DateTime();
    $nombreArchivo_cv = ($pdf_personal!='')?$fecha_cv->getTimestamp()."_".$_FILES["pdf_personal"]['name']:"";
    $tmp_cv = $_FILES["pdf_personal"]['tmp_name'];
    
    if($tmp_cv!='') {
    
        move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);

    //buscar el archivo relacionado con el empleado (documento)
    $sentencia = $conexion->prepare("SELECT pdf_personal 
    FROM personal
    WHERE email_personal = :id 
    AND agencia = :agencia");
    $sentencia->bindParam(":agencia",$agencia);
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $listar_pdf = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach($listar_pdf as $registro_recuperado);

    if(isset($registro_recuperado["pdf_personal"]) && $registro_recuperado["pdf_personal"]!="") {

        if(file_exists("./".$registro_recuperado["pdf_personal"])) {
            unlink("./".$registro_recuperado["pdf_personal"]);
        }

    }

    //Actualizamos el archivo
    $sentencia = $conexion->prepare("UPDATE personal 
    SET pdf_personal = :pdf_personal 
    WHERE email_personal = :id
    AND agencia = :agencia");
    $sentencia->bindParam(":pdf_personal",$nombreArchivo_cv);
    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":agencia",$agencia);
    $sentencia->execute();
}

?><script>
    window.location = "profesores.php<?php echo $volver; ?>";
</script><?php

} catch(Exception $ex) {

?><script>
    alert("ERROR: no se ha podido registrar la información");
    alert("Revise su conexion a internet");
</script><?php

}

}

}


?>


<?php include("../../../../cabecera_pie_admin/cabecera.php");?>
                <div class="container-fluid">
                    <h3 class="text-danger mb-4 fw-bold">Modificar la información de <?php echo($profesor['nombre_personal']." ".$profesor['apellidos_personal']); ?></h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                    <img class="rounded-circle mb-3 mt-4" src="./<?php echo $profesor['foto_personal']; ?>" width="180" height="180">
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
                                                        <div class="mb-3"><label class="form-label"><strong>Nombre</strong><br></label><input class="form-control" type="text" name="nombre_personal" value="<?php echo($profesor['nombre_personal']); ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Apellidos</strong><br></label><input class="form-control" type="text" name="apellidos_personal" value="<?php echo($profesor['apellidos_personal']); ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Email</strong><br></label><input class="form-control" type="email" name="email_personal" value="<?php echo($profesor['email_personal']); ?>" disabled=""></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Edad</strong><br></label><input class="form-control" type="number" name="edad_personal" value="<?php echo($profesor['edad_personal']); ?>"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Otros Datos</p>
                                        </div>
                                        <div class="card-body">
                                                <div class="mb-3"><label class="form-label"><strong>Barrio</strong><br></label></div><input class="form-control" type="text" name="barrio_personal" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;" value="<?php echo($profesor['barrio_personal']); ?>">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Ciudad</strong></label><input class="form-control" type="text" name="ciudad_personal" value="<?php echo($profesor['ciudad_personal']); ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Teléfono</strong><br></label><input class="form-control" type="tel" name="telefono_personal" value="<?php echo($profesor['telefono_personal']); ?>"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Modificar el Archivo Adjuntado</p>
                        </div>
                        <div class="card-body"><label class="form-label"><strong>Archivo:&nbsp; &nbsp;</strong></label>
                        <label class="form-label" for="city"><strong>
                        <a href="./<?php echo $profesor['pdf_personal'];?>" target="_blank" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                        <div class="card-body">
                        <input type="file" style="margin-top: 24px;" id="pdf_agencia" name="pdf_personal" accept=".pdf">
                        </div><br>
                    </div>
                    <div class="card shadow mb-5" style="margin-top: -25px;margin-bottom: 36px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Modificar Foto</p>
                        </div>
                        <div class="card-body"><input type="file" style="margin-top: 24px;" name="foto_personal" accept="image/*"></div>
                    </div>
                    <div class="card shadow mb-5" style="margin-top: -26px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Observación</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                        <div class="mb-3">
                                            <input class="form-control" name="observacion_personal" value="<?php echo($profesor['observacion_personal']); ?>"></input>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-success btn-sm" type="submit" style="color: var(--bs-card-bg);">Modificar</button>
                                            <a class="btn btn-danger btn-sm" role="button" style="margin-left: 11px;" href="profesores.php<?php echo $volver; ?>">Cancelar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include("../../../../cabecera_pie_admin/pie.php");?>
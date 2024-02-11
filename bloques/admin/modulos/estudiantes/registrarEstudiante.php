<?php
include('../../../../base_datos/bd.php');
$agencia = $_GET['agencia'];
$url_fin = "?email=".$_GET['email']."&agencia=".$agencia;

if($_POST) {


//Recolectamos los datos del método POST
$fecha_personal = date('y-m-d');
$hora_personal = date('h:i:s');
$rol_personal = 'Estudiante';
$nombre_personal = (isset($_POST["nombre_personal"])?$_POST["nombre_personal"]:"");
$apellidos_personal = (isset($_POST["apellidos_personal"])?$_POST["apellidos_personal"]:"");    
$email_personal = (isset($_POST["email_personal"])?$_POST["email_personal"]:"");    
$edad_personal = (isset($_POST["edad_personal"])?$_POST["edad_personal"]:"");  
$barrio_personal = (isset($_POST["barrio_personal"])?$_POST["barrio_personal"]:"");    
$ciudad_personal = (isset($_POST["ciudad_personal"])?$_POST["ciudad_personal"]:"");    
$telefono_personal = (isset($_POST["telefono_personal"])?$_POST["telefono_personal"]:"");    
$ingreso_personal = (isset($_POST["ingreso_personal"])?$_POST["ingreso_personal"]:"");    
$mensualidad_personal = (isset($_POST["mensualidad_personal"])?$_POST["mensualidad_personal"]:"");    
$nombre_tutor = (isset($_POST["nombre_tutor"])?$_POST["nombre_tutor"]:"");  
$email_tutor = (isset($_POST["email_tutor"])?$_POST["email_tutor"]:"");  
$telefono_tutor = (isset($_POST["telefono_tutor"])?$_POST["telefono_tutor"]:"");  
$direccion_tutor = (isset($_POST["direccion_tutor"])?$_POST["direccion_tutor"]:"");    
$instituto_personal = (isset($_POST["instituto_personal"])?$_POST["instituto_personal"]:"");    
$curso = (isset($_POST["curso"])?$_POST["curso"]:"");    
$duracion_personal = (isset($_POST["duracion_personal"])?$_POST["duracion_personal"]:"");    

//Datos en formato archivo (imagen o documento)
$foto_personal = (isset($_FILES["foto_personal"]['name'])?$_FILES["foto_personal"]['name']:"");


try {
    //Preparamos la inserción de los datos
    $sentencia = $conexion->prepare("INSERT INTO personal
            VALUES(:nombre_personal, :apellidos_personal, :email_personal, :foto_personal, :edad_personal, 
            '-', :barrio_personal, :ciudad_personal, :telefono_personal, '-', '-',
            :ingreso_personal, :mensualidad_personal, :nombre_tutor, :email_tutor, :telefono_tutor, :direccion_tutor, 
            :instituto_personal, :curso, :duracion_personal, :rol_personal, :fecha_personal, :hora_personal, :agencia)");
    //Asignamos los valores que vienen del método POST (los que vienen del formulario)
    $sentencia->bindParam(":nombre_personal",$nombre_personal);
    $sentencia->bindParam(":apellidos_personal",$apellidos_personal);
    $sentencia->bindParam(":email_personal",$email_personal);
    $sentencia->bindParam(":edad_personal",$edad_personal);
    $sentencia->bindParam(":barrio_personal",$barrio_personal);
    $sentencia->bindParam(":ciudad_personal",$ciudad_personal);
    $sentencia->bindParam(":telefono_personal",$telefono_personal);
    $sentencia->bindParam(":ingreso_personal",$ingreso_personal);
    $sentencia->bindParam(":mensualidad_personal",$mensualidad_personal);
    $sentencia->bindParam(":nombre_tutor",$nombre_tutor);
    $sentencia->bindParam(":email_tutor",$email_tutor);
    $sentencia->bindParam(":telefono_tutor",$telefono_tutor);
    $sentencia->bindParam(":direccion_tutor",$direccion_tutor);
    $sentencia->bindParam(":instituto_personal",$instituto_personal);
    $sentencia->bindParam(":curso",$curso);
    $sentencia->bindParam(":duracion_personal",$duracion_personal);
    $sentencia->bindParam(":fecha_personal",$fecha_personal);
    $sentencia->bindParam(":hora_personal",$hora_personal);
    $sentencia->bindParam(":rol_personal",$rol_personal);
    $sentencia->bindParam(":agencia",$agencia);
    
    //adjuntar la foto para que se inserte en la BD (la ruta)
    $fecha_foto = new DateTime();
    $nombreArchivo_foto = ($foto_personal!='')?$fecha_foto->getTimestamp()."_".$_FILES["foto_personal"]['name']:"";
    $tmp_foto = $_FILES["foto_personal"]['tmp_name'];
    if($tmp_foto!='') {
    move_uploaded_file($tmp_foto, "./".$nombreArchivo_foto);
    }
    $sentencia->bindParam(":foto_personal",$nombreArchivo_foto);
    $sentencia->execute();
    
?><script
src = "../../../.././alertas/registrado.js">
</script><?php
    
    } catch(Exception $ex) {
    
    ?><script>
        alert("ERROR: no se ha podido registrar la información");
        alert("Verifique su conexión a internet");
    </script><?php
    
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
                    <h3 class="text-dark mb-4">Añadir un nuevo Estudiante</h3>
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
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Datos Personales</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Nombre</strong><br></label><input class="form-control" type="text" name="nombre_personal" required=""></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Apellidos</strong><br></label><input class="form-control" type="text" name="apellidos_personal" required=""></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Edad</strong><br></label><input class="form-control" type="number" name="edad_personal" required=""></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Email</strong><br></label><input class="form-control" type="email" name="email_personal" required=""></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Complete los siguientes campos sólo si el Estudiante es menor de edad</p>
                                        </div>
                                        <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Nombre del Tutor</strong><br></label><input class="form-control" type="text" name="nombre_tutor"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Email del Tutor</strong><br></label><input class="form-control" type="email" name="email_tutor"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Teléfono del Tutor</strong><br></label><input class="form-control" type="tel" name="telefono_tutor"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Dirección del Tutor</strong><br></label><input class="form-control" type="text" name="direccion_tutor"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Tasa de Matrícula</p>
                                        </div>
                                        <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Ingreso&nbsp;</strong><br></label><input class="form-control" type="number" name="ingreso_personal" required=""></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Mensualidad (XAF)</strong><br></label><input class="form-control" type="number" name="mensualidad_personal" required=""></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Otros Datos</p>
                                        </div>
                                        <div class="card-body">
                                                <div class="mb-3"><label class="form-label"><strong>Teléfono</strong><br></label></div><input class="form-control" type="number" name="telefono_personal" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;">
                                                <div class="mb-3"><label class="form-label"><strong>Barrio</strong><br></label></div><input class="form-control" type="text" name="barrio_personal" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;" required="">
                                                <div class="mb-3"><label class="form-label"><strong>Instituto</strong><br></label></div><input class="form-control" type="text" name="instituto_personal" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;" required="">
                                                <div class="mb-3"><label class="form-label"><strong>Seleccione la duración del curso</strong><br></label>
                                                 <select class="form-select" name="duracion_personal" required="">
                                                 <?php foreach($lista_duracion as $duracion) { ?>
                                                          <option value="<?php echo $duracion['id_duracion']?>">
                                                <?php echo $duracion['duracion']?> </option> <?php } ?>
                                                 </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Ciudad</strong></label><input class="form-control" type="text" name="ciudad_personal" required=""></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Seleccione un curso</strong><br></label>
                                                        <select class="form-select" name="curso" required="">
                                                        <?php foreach($lista_cursos as $cursos) { ?>
                                                          <option value="<?php echo $cursos['id_curso']?>">
                                                        <?php echo $cursos['nombre_curso']?> </option> <?php } ?>  
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5" style="margin-bottom: 36px;margin-top: -2px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Foto</p>
                        </div>
                        <div class="card-body"><input type="file" style="margin-top: 24px;" name="foto_personal" required="" accept="image/*"></div>
                    </div>
                    <div class="card shadow mb-5" style="margin-top: -26px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                        <div class="mb-3"></div>
                                        <div class="mb-3">
                                        <button class="btn btn-success btn-sm" type="submit" style="color: var(--bs-card-bg);">Registrar</button>
                                        <a class="btn btn-danger btn-sm" role="button" style="margin-left: 11px;"  href="estudiantes.php<?php echo($url_fin) ?>">Cancelar</a></div>
                                        <div class="mb-3"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 <?php include("../../../../cabecera_pie_admin/pie.php");?>
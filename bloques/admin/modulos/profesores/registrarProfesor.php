<?php
include('../../../../base_datos/bd.php');
$agencia = $_GET['agencia'];
$url_fin = "?email=".$_GET['email']."&agencia=".$agencia;

if($_POST) {


//Recolectamos los datos del método POST
$fecha_personal = date('y-m-d');
$hora_personal = date('h:i:s');
$rol_personal = 'Profesor';
$nombre_personal = (isset($_POST["nombre_personal"])?$_POST["nombre_personal"]:"");
$apellidos_personal = (isset($_POST["apellidos_personal"])?$_POST["apellidos_personal"]:"");    
$email_personal = (isset($_POST["email_personal"])?$_POST["email_personal"]:"");    
$edad_personal = (isset($_POST["edad_personal"])?$_POST["edad_personal"]:"");    
$salario_personal = (isset($_POST["salario_personal"])?$_POST["salario_personal"]:"");    
$barrio_personal = (isset($_POST["barrio_personal"])?$_POST["barrio_personal"]:"");    
$ciudad_personal = (isset($_POST["ciudad_personal"])?$_POST["ciudad_personal"]:"");    
$telefono_personal = (isset($_POST["telefono_personal"])?$_POST["telefono_personal"]:"");    
$observacion_personal = (isset($_POST["observacion_personal"])?$_POST["observacion_personal"]:"");    

//Datos en formato archivo (imagen o documento)
$foto_personal = (isset($_FILES["foto_personal"]['name'])?$_FILES["foto_personal"]['name']:"");
$pdf_personal = (isset($_FILES["pdf_personal"]['name'])?$_FILES["pdf_personal"]['name']:"");


try {
    //Preparamos la inserción de los datos
    $sentencia = $conexion->prepare("INSERT INTO personal
            VALUES(:nombre_personal, :apellidos_personal, :email_personal, :foto_personal, :edad_personal, 
            :salario_personal, :barrio_personal, :ciudad_personal, :telefono_personal, :pdf_personal, :observacion_personal,
            '0', '0', '-', '-', '-', '-', '-', '-', '-', :rol_personal, :fecha_personal, :hora_personal, :agencia)");
    //Asignamos los valores que vienen del método POST (los que vienen del formulario)
    $sentencia->bindParam(":nombre_personal",$nombre_personal);
    $sentencia->bindParam(":apellidos_personal",$apellidos_personal);
    $sentencia->bindParam(":email_personal",$email_personal);
    $sentencia->bindParam(":edad_personal",$edad_personal);
    $sentencia->bindParam(":salario_personal",$salario_personal);
    $sentencia->bindParam(":barrio_personal",$barrio_personal);
    $sentencia->bindParam(":ciudad_personal",$ciudad_personal);
    $sentencia->bindParam(":telefono_personal",$telefono_personal);
    $sentencia->bindParam(":observacion_personal",$observacion_personal);
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
    
    //adjuntar el pdf para que se inserte en la BD (la ruta)
    $fecha_cv = new DateTime();
    $nombreArchivo_cv= ($pdf_personal!='')?$fecha_cv->getTimestamp()."_".$_FILES["pdf_personal"]['name']:"";
    $tmp_cv = $_FILES["pdf_personal"]['tmp_name'];
    if($tmp_cv!='') {
    move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);
    }
    $sentencia->bindParam(":pdf_personal",$nombreArchivo_cv);
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

?>

<?php include("../../../../cabecera_pie_admin/cabecera.php");?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Añadir un nuevo Profesor</h3>
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
                                                        <div class="mb-3"><label class="form-label"><strong>Nombre</strong><br></label><input class="form-control" type="text" id="nombre_personal" name="nombre_personal" required=""></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Apellidos</strong><br></label><input class="form-control" type="text" id="apellidos_personal" name="apellidos_personal" required=""></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Email</strong><br></label><input class="form-control" type="email" id="email_personal" name="email_personal" required=""></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Edad</strong><br></label><input class="form-control" type="number" id="edad_personal" name="edad_personal" required=""></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Otros Datos</p>
                                        </div>
                                        <div class="card-body">
                                                <div class="mb-3"></div>
                                                <div class="mb-3">
                                                <label class="form-label"><strong>Barrio</strong><br></label>
                                              </div>
                                              <input class="form-control" type="text" id="barrio_personal" name="barrio_personal" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;" required="">
                                              <div class="mb-3">
                                                <label class="form-label"><strong>Salario</strong><br></label>
                                              </div>
                                              <input class="form-control" type="number" id="salario_personal" name="salario_personal" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;" required="">
                                                
                                              <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Ciudad</strong></label><input class="form-control" type="text" id="ciudad_personal" name="ciudad_personal" required=""></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Teléfono</strong><br></label><input class="form-control" type="tel" id="telefono_personal" name="telefono_personal" required=""></div>
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
                            <p class="text-primary m-0 fw-bold">Archivo Adicional (formato PDF)</p>
                        </div>
                        <div class="card-body">
                        <input type="file" style="margin-top: 24px;" id="pdf_personal" name="pdf_personal" accept=".pdf" required="">
                    </div>
                    </div>
                    <div class="card shadow mb-5" style="margin-top: -25px;margin-bottom: 36px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Foto</p>
                        </div>
                        <div class="card-body"><input type="file" style="margin-top: 24px;" id="foto_personal" name="foto_personal" required="" accept="image/*"></div>
                    </div>
                    <div class="card shadow mb-5" style="margin-top: -26px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Observación</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                        <div class="mb-3"><textarea class="form-control" id="observacion_personal" rows="5" name="observacion_personal"></textarea></div>
                                        <div class="mb-3">
                                        <button class="btn btn-success btn-sm" type="submit" style="color: var(--bs-card-bg);">Registrar</button>
                                        <a class="btn btn-danger btn-sm" role="button" style="margin-left: 11px;" href="profesores.php<?php echo($url_fin) ?>">Cancelar</a></div>
                                        <div class="mb-3"></div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include("../../../../cabecera_pie_admin/pie.php");?>
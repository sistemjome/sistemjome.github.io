<?php

include ('../../base_datos/bd.php');

//Coger los campos a mostrar en la BD
if(isset($_GET['email'])) {

//listar la información de la base de datos (para obtener la información de la agencia)
$email = $_GET['email'];
$sentencia = $conexion->prepare("SELECT * FROM agencias 
WHERE paquete = :email");
$sentencia->bindParam(":email",$email);
$sentencia->execute();
$lista_agencia = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($lista_agencia as $agencia);

}

?>


<?php include("../../cabecera_pie_admin/cabecera_inicio.php"); ?>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid"><br>
                    <h3 class="text-dark mb-4">Perfil de la Agencia</h3>
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
                                        <img class="rounded-circle mb-3 mt-4" src="cuenta/<?php echo $agencia['logo_agencia']; ?>" width="160" height="160" style="margin-left: 1px;margin-bottom: 45px;margin-top: 46px;">
                                        <p class="text-primary m-0 fw-bold" style="margin-top: -23px;margin-bottom: -36px;padding-top: 24px;">Datos</p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Nombre de la Agencia</strong><br></label><input class="form-control" type="text" id="nombre_agencia" name="nombre_agencia" value="<?php echo $agencia['nombre_agencia']; ?>" disabled=""></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Fundador</strong><br></label><input class="form-control" type="text" id="fundador_agencia" name="fundador_agencia" value="<?php echo $agencia['fundador_agencia']; ?>" disabled=""></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Fecha de Fundación</strong><br></label><input class="form-control" id="fecha_agencia" name="fecha_agencia" value="<?php echo $agencia['fecha_agencia']; ?>" disabled=""></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Dirección</strong><br></label><input class="form-control" type="text" id="direccion_agencia" name="direccion_agencia" value="<?php echo $agencia['direccion_agencia']; ?>" disabled=""></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Otros Datos</p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3"></div>
                                                <div class="mb-3"><label class="form-label"><strong>Página Web</strong><br></label></div><input class="form-control" type="text" id="web_agencia" name="web_agencia" value="<?php echo $agencia['web_agencia']; ?>" style="padding-right: 12px;margin-right: -13px;margin-bottom: 5px;margin-top: -12px;" disabled="">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Teléfono</strong><br></label><input class="form-control" type="tel" id="telefono_agencia" name="telefono_agencia" value="<?php echo $agencia['telefono_agencia']; ?>" disabled=""></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"><strong>Email</strong><br></label><input class="form-control" type="email" id="email_agencia" name="email_agencia" minlength="9" maxlength="9" value="<?php echo $agencia['email_agencia']; ?>" disabled=""></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Archivo Adjuntado</p>
                        </div>
                        <div class="card-body"><label class="form-label" for="city"><strong>Archivo:&nbsp; &nbsp;</strong></label><label class="form-label" for="city"><strong>
                        <a href="cuenta/./<?php echo $agencia['pdf_agencia'];?>" target="_blank" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i>
                        </a></div><br>
                    <div class="card shadow mb-5" style="margin-top: -26px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Descripción</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <form>
                                        <div class="mb-3">
                                            <input class="form-control" id="descripcion_agencia" rows="5" name="descripcion_agencia" value="<?php echo $agencia['descripcion_agencia']; ?>" disabled=""></input></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
</div>
<?php include("../../cabecera_pie_admin/pie_inicio.php"); ?>
<?php include("../../cabecera_pie_admin/cabecera_inicio.php"); ?>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">REGISTRO</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generar PDF</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><a href="../../bloques/admin/modulos/profesores/profesores.html" > TOTAL DE PROFESORES</a></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span style="color: var(--bs-blue);">40,000</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-alt fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><a href="../../bloques/admin/modulos/estudiantes/estudiantes.html" >TOTAL DE ESTUDIANTES</a></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span style="color: var(--bs-teal);">215,000</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-book-reader fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><a href="../../bloques/admin/modulos/cursos/cursos.html">TOTAL DE CURSOS</a></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span style="color: var(--bs-pink);">12</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><a href="../../bloques/admin/modulos/materiales/meterias.html">TOTAL DE MATERIAS</a></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span style="color: var(--bs-gray-800);">120</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-book fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-stack-overflow" style="font-size: 23px;">
                                            <path d="M12.412 14.572V10.29h1.428V16H1v-5.71h1.428v4.282h9.984z"></path>
                                            <path d="M3.857 13.145h7.137v-1.428H3.857v1.428zM10.254 0 9.108.852l4.26 5.727 1.146-.852L10.254 0zm-3.54 3.377 5.484 4.567.913-1.097L7.627 2.28l-.914 1.097zM4.922 6.55l6.47 3.013.603-1.294-6.47-3.013-.603 1.294zm-.925 3.344 6.985 1.469.294-1.398-6.985-1.468-.294 1.397z"></path>
                                        </svg>&nbsp;ACCESOS AL SISTEMA</h6>
                                    <div class="alert alert-warning" role="alert" style="margin-top: 8px;"><span><strong>Fecha:&nbsp;</strong></span><span><strong>&nbsp;&nbsp;</strong><input type="date" name="fechaactual" style="color: var(--bs-danger);border-style: inherit;"><strong>&nbsp;&nbsp;</strong></span><a class="btn btn-light btn-icon-split" role="button"><span class="text-black-50 icon"><i class="fas fa-arrow-right"></i></span><span class="text-dark text">Filtrar</span></a></div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col">
                                                <div class="table-responsive">
                                                    <table  class="table" id="tabla_id">
                                                        <thead>
                                                            <tr>
                                                                <th>Usuarios</th>
                                                                <th>Rol</th>
                                                                <th>Visitas</th>
                                                                <th>Fecha</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Isabel Bikie</td>
                                                                <td>Profesor</td>
                                                                <td>32</td>
                                                                <td>04/08/2021</td>
                                                            </tr>
                                                            <tr></tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <div class="card text-white bg-primary shadow">
                                        <div class="card-body"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include("../../cabecera_pie_admin/pie_inicio.php"); ?>
<?php include("../../../../cabecera_pie_admin/cabecera.php");?>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Horarios de las asignaciones de los Cursos</h3>
                    <div class="card shadow">
                        <div class="card-header py-3"></div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="margin-right: 0px;padding-right: 0px;">Código</th>
                                            <th>Estudiante</th>
                                            <th>Profesor</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>HR34</td>
                                            <td>María Flores</td>
                                            <td>Juan Ondó</td>
                                            <td><a class="btn btn-secondary btn-icon-split" role="button" href="registrarHorario.html"><span class="text-white-50 icon"><i class="far fa-calendar"></i></span><span class="text-white text">Horario</span></a><a class="btn btn-danger btn-circle ms-1" role="button" data-bs-toggle="tooltip" data-bss-tooltip="" title="Eliminar"><i class="fas fa-trash text-white"></i></a></td>
                                        </tr>
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
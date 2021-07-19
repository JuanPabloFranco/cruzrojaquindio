<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] >= 0)) {
    include_once '../../Vista/layouts/header.php'
?>
    <title>Adm | Reportes Visitas</title>
    <?php
    include_once '../../Vista/layouts/nav.php';
    ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/table2excel@1.0.4/dist/table2excel.min.js"></script>
    <!-- Modal -->
    <script src="../../Recursos/js/reportes visitas.js"></script>
    <form action="../../Recursos/xls/excelUsuarios.php" method="post" role="form" id="formExcel">
        <input type="hidden" id="txtId_usuario" value="<?php echo $_SESSION['id_user']; ?>">
        <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>" name="id_tipo">
        <input type="hidden" id="txtAccion" name="accion">
    </form>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Reportes Visitas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Reportes Visitas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 id="h3Registrados"></h3>
                                <p>Registradas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-thumbtack"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 id="h3Pasadia"></h3>
                                <p>Pasadias</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-street-view"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3 id="h3Camp"></h3>
                                <p>Camping</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-campground"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 id="h3Quindio"></h3>
                                <p>Quindio</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3 id="h3Other"></h3>
                                <p>Otros departamentos</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3 id="h3Extranjero"></h3>
                                <p>Extranjeros</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-globe-americas"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="card card-success">
                    <!-- <div class="modal-header notiHeader">
                        <h3 class="card-title">Tipo de lista</h3>
                        <div class="input-group">
                            <select name="" id="selTipoReporte" class="form-control float-left">
                                <option value="General">General</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-success" id="exportar"><i class="excel fas fa-file-excel"></i></button>
                            </div>
                        </div>
                    </div> -->
                    <div class="card-body pb-0 table-responsive">
                        <table id="tablaUsuarios" class="display" style="width:100%" class="table table-hover text-nowrap">
                            <thead class="notiHeader">
                                <tr>
                                    <th>Tipo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Visitante</th>
                                    <th>Nacionalidad</th>
                                    <th>Municipio</th>
                                    <th>Departamento</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody style="font-family: Sans-serif; font-size: 13px;"></tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
<?php
    include_once '../../Vista/layouts/footer.php';
} else {
    header('Location: ../../index.php');
}
?>
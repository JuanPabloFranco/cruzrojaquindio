<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] >= 0)) {
    include_once '../Vista/layouts/header.php'
?>
    <title>Adm | Reportes</title>
    <?php
    include_once '../Vista/layouts/nav.php';
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
    <script src="../Recursos/js/reportes incidentes.js"></script>
    <form action="../Recursos/xls/excelIncidentes.php" method="post" role="form" id="formExcel">
        <input type="hidden" id="txtId_usuario" value="<?php echo $_SESSION['id_user']; ?>">
        <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>" name="id_tipo">
        <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>" name="id_cargo">
        <input type="hidden" id="txtAccion" name="accion">
        <input type="hidden" id="id_region" value="<?php echo $_SESSION['id_region']; ?>" name="id_region">
    </form>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Reportes Incidentes o novedades</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Reportes Incidentes o novedades</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="card card-success">
                <div class="modal-header notiHeader">
                    <h3 class="card-title">Tipo de lista</h3>
                    <div class="input-group">
                        <select name="" id="selTipoReporte" class="form-control float-left">
                            <option value="all">Todos los registros</option>
                            <option value="new">Nuevos</option>
                            <option value="verify">Verificados</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-success" id="exportar"><i class="excel fas fa-file-excel"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-primary">
                            <div class="info-box-content">
                                <span class="info-box-text">Registrados</span>
                            </div>
                            <span class="info-box-icon" id="spanRegistrados"></i>0</span>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-warning">
                            <div class="info-box-content">
                                <span class="info-box-text">Nuevos</span>
                            </div>
                            <span class="info-box-icon" id="spanNuevos"></i>0</span>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-success">
                            <div class="info-box-content">
                                <span class="info-box-text">Verificados</span>
                            </div>
                            <span class="info-box-icon" id="spanVerificados"></i>0</span>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-purple">
                            <div class="info-box-content">
                                <span class="info-box-text">Personal ESE</span>
                            </div>
                            <span class="info-box-icon" id="spanPersonal"></i>0</span>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-gray">
                            <div class="info-box-content">
                                <span class="info-box-text">Heridos</span>
                            </div>
                            <span class="info-box-icon" id="spanHeridos"></i>0</span>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-dark">
                            <div class="info-box-content">
                                <span class="info-box-text">Desaparecidos</span>
                            </div>
                            <span class="info-box-icon" id="spanDesaparecidos"></i>0</span>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-orange">
                            <div class="info-box-content">
                                <span class="info-box-text">Lesionados</span>
                            </div>
                            <span class="info-box-icon" id="spanLesionados"></i>0</span>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-danger">
                            <div class="info-box-content">
                                <span class="info-box-text">Muertos</span>
                            </div>
                            <span class="info-box-icon" id="spanMuertos"></i>0</span>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-info">
                            <div class="info-box-content">
                                <span class="info-box-text">Viv Averiadas</span>
                            </div>
                            <span class="info-box-icon" id="spanVAveriadas"></i>0</span>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-info">
                            <div class="info-box-content">
                                <span class="info-box-text">Viv Destruidas</span>
                            </div>
                            <span class="info-box-icon" id="spanVDestruidas"></i>0</span>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="info-box mb-3 bg-info">
                            <div class="info-box-content">
                                <span class="info-box-text">Fam Afectadas</span>
                            </div>
                            <span class="info-box-icon" id="spanFam"></i>0</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <br>
                        <h3 class="card-title" style="color: #320a48;">Total registrados por regiones</h3><br>
                    </div>
                </div>
                <div class="row" id="estadisticasReg">

                </div>
            </div>
        </section>
    </div>
    </div>
    <!-- /.content-wrapper -->
<?php
    include_once '../Vista/layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
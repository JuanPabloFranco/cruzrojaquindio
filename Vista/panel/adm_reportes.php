<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] >= 0)) {
    include_once '../../Vista/layouts/header.php'
?>
    <title>Adm | Reportes</title>
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
    <script src="../../Recursos/js/reportes.js"></script>
    <form action="../../Recursos/xls/excelUsuarios.php" method="post" role="form" id="formExcel">
        <input type="hidden" id="txtId_usuario" value="<?php echo $_SESSION['id_user']; ?>">
        <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>" name="id_tipo">
        <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>" name="id_cargo">
        <input type="hidden" id="id_sede" value="<?php echo $_SESSION['id_sede']; ?>" name="id_sede">
        <input type="hidden" id="txtAccion" name="accion">
    </form>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Reportes Usuarios</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Reportes Usuarios</li>
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
                                <p>Registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 id="h3Activos"></h3>
                                <p>Activos</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3 id="h3Inactivos"></h3>
                                <p>Inactivos</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-minus"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 id="h3Faltantes"></h3>
                                <p>Campos básicos vacíos</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-tag"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Tipo de lista</h3>
                        <div class="input-group">
                            <select name="" id="selTipoReporte" class="form-control float-left">
                                <option value="General">General</option>
                                <option value="Inactivos">Usuarios Inactivos</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-success" id="exportar"><i class="excel fas fa-file-excel"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0 table-responsive">
                        <table id="tablaUsuarios" class="display" style="width:100%" class="table table-hover text-nowrap">
                            <thead class="notiHeader">
                                <tr>
                                    <th>Estado</th>
                                    <th>Sede</th>
                                    <th>Cargo</th>
                                    <th>Nombre Completo</th>
                                    <th>Documento</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Teléfono</th>
                                    <th>Celular</th>
                                    <th>Dirección</th>
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
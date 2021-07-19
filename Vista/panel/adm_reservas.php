<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] >= 2)) {
    include_once '../../Vista/layouts/header.php';
    include_once '../../Conexion/consulSQL.php';
?>
    <title>Adm | Administrar Reservas</title>
    <?php
    include_once '../../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../../Recursos/js/gestion_reservas.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
    <input type="hidden" id="fecha_hoy" value="<?php echo date('Y-m-d'); ?>">
    <input type="hidden" id="txtPage" value="adm">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestión Reservas
                            <?php
                            if ($_SESSION['type_id'] <= 2 || ($_SESSION['permisos'][0]->reservas == 'Activo' && $_SESSION['permisos'][0]->cobertura == 'Full')) {
                            ?>
                                <a href="../../Vista/panel/crear_reserva.php?modulo=reservas"><button type="button" id="btn_crear_reserva" class="btn bg-gradient-primary m-2">Registrar Reserva</button></a>
                            <?php
                            }
                            ?>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../../Vista/adm_catalogo.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Reservas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header notiHeader">
                        <h3 class="card-title" style="display: flex;">Buscar Reserva   <p class='badge badge-warning' id="liBadge"></p>
                        </h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarReserva" placeholder="Ingrese el nombre del visitante, teléfono o documento del visitante" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div id="busquedaReserva" class="row d-flex align-items-stretch"></div>

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
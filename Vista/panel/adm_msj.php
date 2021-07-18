<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['permisos'][0]->msj_contacto == 'Activo')) {
    include_once '../Vista/layouts/header.php'
?>
    <title>Adm | Mensajes de Contacto</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../Recursos/js/contactanos.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
    <input type="hidden" id="id_sede" value="<?php echo $_SESSION['id_sede']; ?>">
    <div class="modal fade" id="ver_msj" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-widget">
                    <div class="card-header notiHeader">
                        <div class="user-block">
                            <i class="fas fa-envelope" style="font-size: 40px; display: flex;"><span class="username mt-2" style="color: white;" id="spanNombre"></span></i>
                        </div>
                        <!-- /.user-block -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                                <i class="far fa-circle"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times" style="color: white;"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- post text -->
                        <p id="pFechaMsj"></p>
                        <p id="pAsuntoMsj"></p>
                        <p id="pAsuntoMsj">Mensaje:</p>
                        <!-- Attachment -->
                        <div class="attachment-block clearfix">
                            <div class="attachment-pushed">
                                <div class="attachment-text" id="divMsj">
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-success text-center" id="updateObj" style="display: none;">
                            <span><i class='fas fa-check m-1'> Mensaje Actualizado</i></span>
                        </div>
                        <div class="alert alert-danger text-center" id="noUpdateObj" style="display: none;">
                            <span><i class='fas fa-times m-1'></i></span>
                        </div>
                        <form id="form_crear_region">
                            <input type="hidden" name="funcion" id="idMsjVisto">
                            <div id="divBtn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mensajes de Contacto</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Mensajes de Contacto</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Buscar Mensaje</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarMsj" placeholder="Ingrese el nombre, email o asunto" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaMsj" class="row d-flex align-items-stretch"></div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
<?php
    include_once '../Vista/layouts/footer.php';
} else {
    header('Location: ../Vista/404.php');
}
?>
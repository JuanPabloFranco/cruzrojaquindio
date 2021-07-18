<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] >= 0)) {
    include_once '../Vista/layouts/header.php'
?>
    <title>Adm | Soporte FeseSystem</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../Recursos/js/soporte_tecnico.js"></script>
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
    <input type="hidden" id="id_region" value="<?php echo $_SESSION['id_region']; ?>">    
    <div class="modal fade" id="crear_solicitud" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Registrar Solicitud de soporte</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_soporte">
                        <div class="card-body">
                            <div class="div form-group">
                                <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
                            </div>
                            <div class="div form-group">
                                <label for="txtDescSoporte">Descripción</label>
                                <textarea id="txtDescSoporte" name="notas" rows="4" placeholder="Describe el problema a reportar, recomendación o sugerencia" class="form-control"></textarea>
                            </div>
                            <div class="alert alert-success text-center" id="divCreate" style="display: none;">
                                <span><i class='fas fa-check m-1'> Solicitud registrada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreate" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                            <button type="button" class="btn btn-outline-secondary float-right m-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="crear_respuesta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Registrar comentario</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_comentario">
                        <div class="card-body">
                            <div class="div form-group">
                                <input type="hidden" id="txtId_vol_respuesta" value="<?php echo $_SESSION['id_user']; ?>">
                            </div>
                            <div class="div form-group">
                                <label for="txtResSoporte">Comentario</label>
                                <textarea id="txtResSoporte" name="notas" rows="4" placeholder="" class="form-control"></textarea>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateRes" style="display: none;">
                                <span><i class='fas fa-check m-1'> Comentario registrada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateRes" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" id="txtIdSoporte">
                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                            <button type="button" class="btn btn-outline-secondary float-right m-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarSoporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Imagen de soporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_img_soporte" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="input-group mb-3 mt-2">
                            <input type="file" name="soporte" class='input-group' accept="image/*">
                            <input type="hidden" name="funcion" value="soporte">
                            <input type="hidden" name="id" id="txtIdSoporteImg">
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="updateSoporte" style="display: none;">
                        <span><i class='fas fa-check m-1'> Imagén Registrada</i></span>
                    </div>
                    <div class="alert alert-danger text-center" id="noUpdateSoporte" style="display: none;">
                        <span><i class='fas fa-times m-1'></i></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cambiar_estado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_estado_soporte" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="div form-group">
                            <label for="txtResSoporte">Comentario</label>
                            <select id="selEstado" class="form-control">
                                <option value="Revisado">Revisado</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="En Pruebas">En Pruebas</option>
                                <option value="Terminado">Terminado</option>
                            </select>
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="updateEstado" style="display: none;">
                        <span><i class='fas fa-check m-1'> Estado Actualizado</i></span>
                    </div>
                    <div class="alert alert-danger text-center" id="noUpdateEstado" style="display: none;">
                        <span><i class='fas fa-times m-1'></i></span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="txtIdEstadoSop">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                    </div>
                </form>
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
                        <h1>Soporte FeseSystem
                            <?php
                            if ($_SESSION['id_user'] <> 1) {
                            ?>
                                <button type="button" id="btn_crear_usuario" data-bs-toggle="modal" data-bs-target="#crear_solicitud" class="btn bg-gradient-primary m-2">Registrar Solicitud</button>
                            <?php
                            }
                            ?>
                            <a href="https://api.whatsapp.com/send?phone=+573136464151&amp;text=Hola, puedes ayudarme" target="_blank">
                                <img src="../Recursos/img/whatsapp_icon.png" alt="" width="30">
                            </a>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Soporte FeseSystem</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Buscar Solicitud</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarSolicitud" placeholder="Ingrese el texto a buscar" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaSoporte" class="row d-flex align-items-stretch"></div>
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
    header('Location: ../index.php');
}
?>
<?php
session_start();
if (isset($_SESSION['type_id']) && $_SESSION['type_id'] <= 2 || ($_SESSION['permisos'][0]->servicios == 'Activo')) {
    include_once '../Vista/layouts/header.php'
?>
    <title>Adm | Servicios</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../Recursos/js/servicios.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <div class="modal fade" id="crearServicio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Crear Servicio</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_servicio">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="txtNombreServ">Nombre del servicio</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre del servicio" id="txtNombreServ" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtDescServ">Descripción servicio</label>
                                <textarea name="" id="txtDescServ" cols="30" rows="5" placeholder="Ingresa la descripción del servicio" class="form-control"></textarea>
                            </div>
                            <div class="div form-group">
                                <label for="txtValorServ">Valor del servicio</label>
                                <input type="number" class="form-control" name="nombre" placeholder="Ingrese el valor del servicio" id="txtValorServ" required>
                            </div>
                            <div class="alert alert-success text-center" id="divCreate" style="display: none;">
                                <span><i class='fas fa-check m-1'> Servicio registrado</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreate" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="funcion" value="crearServicio">
                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                            <button type="button" class="btn btn-outline-secondary float-right m-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalEditar_servicio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header notiHeader">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
                </div>
                <form id="form_editar_servicio">
                    <div class="modal-body">
                        <div class="div form-group">
                            <label for="txtNombreServ2">Nombre del servicio</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre de la region" id="txtNombreServ2" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtDescServ2">Descripción servicio</label>
                            <textarea name="" id="txtDescServ2" cols="30" rows="5" placeholder="Ingresa la descripción del servicio" class="form-control"></textarea>
                        </div>
                        <div class="div form-group">
                                <label for="txtValorServ2">Valor del servicio</label>
                                <input type="number" class="form-control" name="nombre" placeholder="Ingrese el valor del servicio" id="txtValorServ2" required>
                            </div>
                        <div class="input-group mb-3">
                            <input type="hidden" id="txtId_ServicioEd" name="id">
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="updateObj" style="display: none;">
                        <span><i class='fas fa-check m-1'> Servicio Actualizado</i></span>
                    </div>
                    <div class="alert alert-danger text-center" id="noUpdateObj" style="display: none;">
                        <span><i class='fas fa-times m-1'></i></span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="txtId_ServicioEd">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fotosServicio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Fotos Servicio</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_foto">
                        <div class="card-body">
                            <div class="div form-group">
                                <input type="hidden" class="form-control" name="id_servicio" id="txtIdServImage" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class='fas fa-image' accept="image/*"></i></span>
                                </div>
                                <input type="file" id="txtNombImage" name="archivo" class="form-control">
                            </div>
                            <div class="div form-group">
                                <label for="txtDescServ">Descripción de la Imagén</label>
                                <textarea id="txtDescServFoto" cols="30" name="descripcion" rows="3" placeholder="Ingresa la descripción de la Foto" class="form-control"></textarea>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateFoto" style="display: none;">
                                <span><i class='fas fa-check m-1'></i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateFoto" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="funcion" value="crear_foto_servicio">
                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                            <button type="button" class="btn btn-outline-secondary float-right m-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                        <div id="divFotosServicio" class="row d-flex align-items-stretch ml-1"></div>
                    </form>
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
                        <h1>Gestión Servicios
                            <button type="button" id="btn_crear_usuario" data-bs-toggle="modal" data-bs-target="#crearServicio" class="btn bg-gradient-primary m-2">Crear Servicio</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Servicios</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Buscar Servicio</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarServicio" placeholder="Ingrese el nombre del servicio" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaServicio" class="row d-flex align-items-stretch"></div>
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
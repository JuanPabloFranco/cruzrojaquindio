<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['permisos'][0]->galeria == 'Activo')) {
    include_once '../../Vista/layouts/header.php'
?>
    <title>Adm | Galeria de Imágenes</title>
    <?php
    include_once '../../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../../Recursos/js/galeria.js"></script>
    <input type="hidden" id="txtId_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
    <input type="hidden" id="id_sede" value="<?php echo $_SESSION['id_sede']; ?>">
    <div class="modal fade" id="crearFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Subir Foto o Imagén a galería</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_foto">
                        <div class="card-body">
                            <div class="div form-group">
                                <input type="text" class="form-control" value="Sede <?php echo $_SESSION['name_sede']; ?>" readonly>
                                <input type="hidden" class="form-control" name="id_sede" value="<?php echo $_SESSION['id_sede']; ?>" id="id_region" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class='fas fa-image' accept="image/*"></i></span>
                                </div>
                                <input type="file" id="txtNombImage" name="nombre_foto" class="form-control">
                            </div>
                            <div class="div form-group">
                                <label for="txtDescServ">Descripción de la Imagén</label>
                                <textarea id="txtDescServ" cols="30" name="desc_foto" rows="5" placeholder="Ingresa la descripción de la imagén" class="form-control"></textarea>
                            </div>
                            <div class="alert alert-success text-center" id="divCreate" style="display: none;">
                                <span><i class='fas fa-check m-1'> Imagén registrada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreate" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="funcion" value="crear_foto">
                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                            <button type="button" class="btn btn-outline-secondary float-right m-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editar_foto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header notiHeader">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Foto o Imagén</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
                </div>
                <form id="form_editar_foto">
                    <div class="modal-body">
                        <div class="div form-group">
                            <img src="" id="imgFoto" style="width: 95%;">
                        </div>                        
                        <div class="div form-group">
                            <label for="txtDescServ2">Descripción de la Imagén</label>
                            <textarea id="txtDescServ2" cols="30" name="desc_foto" rows="5" placeholder="Ingresa la descripción del servicio" class="form-control"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <input type="hidden" id="txtId_fotoEd" name="id">
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="updateObj" style="display: none;">
                        <span><i class='fas fa-check m-1'> Imagén Actualizada</i></span>
                    </div>
                    <div class="alert alert-danger text-center" id="noUpdateObj" style="display: none;">
                        <span><i class='fas fa-times m-1'>Error</i></span>
                    </div>
                    <div class="modal-footer">
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
                        <h1>Gestión Galería de Imágenes
                            <button type="button" id="btn_crear_usuario" data-bs-toggle="modal" data-bs-target="#crearFoto" class="btn bg-gradient-primary m-2">Subir Imagén</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Galería de Imágenes</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Buscar Imagén en galería</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarFoto" placeholder="Ingrese texto o contenido de la descripción de la imagén" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaFoto" class="row d-flex align-items-stretch"></div>
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
    header('Location: ../../Vista/404.php');
}
?>
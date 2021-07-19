<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['permisos'][0]->noticias == 'Activo')) {
    include_once '../../Vista/layouts/header.php'
?>
    <title>Adm | Noticias</title>
    <?php
    include_once '../../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../../Recursos/js/noticia.js"></script>
    <input type="hidden" id="txtId_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
    <input type="hidden" id="id_sede" value="<?php echo $_SESSION['id_sede']; ?>">
    <div class="modal fade" id="agregarImagen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Subir Foto o Imagén a la noticia</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_agregar_imagen">
                        <div class="card-body">
                            <div class="div form-group">
                                <img style="width: 80%;" id="imgNoti">
                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class='fas fa-image' accept="image/*"></i></span>
                                </div>
                                <input type="file" id="txtImagen" name="imagen" class="form-control">
                            </div>
                            <div class="alert alert-success text-center" id="divCreate" style="display: none;">
                                <span><i class='fas fa-check m-1'> Imagén registrada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreate" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" value="agregar_imagen" name="funcion">
                            <input type="hidden" id="idNotiImg" name="id">
                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                            <button type="button" class="btn btn-outline-secondary float-right m-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="crear_noticia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header notiHeader">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Noticia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
                </div>
                <form id="form_crear_noticia">
                    <div class="modal-body">
                        <div class="div form-group">
                            <label for="txtFecha">Fecha de la noticia</label>
                            <input type="date" id="txtFecha" class="form-control" name="fecha" placeholder="Ingrese la fecha de la noticia" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtTitulo">Título</label>
                            <input type="text" id="txtTitulo" class="form-control" name="titulo" placeholder="Ingrese el título de la noticia" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtEncabezado">Encabezado</label>
                            <textarea name="encabezado" id="txtEncabezado" rows="2" class="form-control" placeholder="Ingrese un encabezado, texto corto o resumen de la noticia" required></textarea>
                        </div>
                        <div class="div form-group">
                            <label for="txtDesarrollo">Desarrollo</label>
                            <textarea name="texto" id="txtDesarrollo" rows="5" class="form-control" placeholder="Ingrese el desarrollo completo de la noticia"></textarea>
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="createObj" style="display: none;">
                        <span><i class='fas fa-check m-1'> Noticia registrada</i></span>
                    </div>
                    <div class="alert alert-danger text-center" id="noCreateObj" style="display: none;">
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

    <div class="modal fade" id="editar_noticia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header notiHeader">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Noticia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
                </div>
                <form id="form_editar_noticia">
                    <div class="modal-body">
                        <div class="div form-group">
                            <label for="txtFecha2">Fecha de la noticia</label>
                            <input type="date" id="txtFecha2" class="form-control" name="fecha" placeholder="Ingrese la fecha de la noticia" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtTitulo2">Título</label>
                            <input type="text" id="txtTitulo2" class="form-control" name="titulo" placeholder="Ingrese el título de la noticia" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtEncabezado2">Encabezado</label>
                            <textarea name="encabezado" id="txtEncabezado2" rows="2" class="form-control" placeholder="Ingrese un encabezado, texto corto o resumen de la noticia" required></textarea>
                        </div>
                        <div class="div form-group">
                            <label for="txtDesarrollo2">Desarrollo</label>
                            <textarea name="texto" id="txtDesarrollo2" rows="5" class="form-control" placeholder="Ingrese el desarrollo completo de la noticia"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <input type="hidden" id="txtId_noticia" name="id">
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="updateObj" style="display: none;">
                        <span><i class='fas fa-check m-1'> Noticia Actualizada</i></span>
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
                        <h1>Noticias
                            <button type="button" id="btn_crear_noticia" data-bs-toggle="modal" data-bs-target="#crear_noticia" class="btn bg-gradient-primary m-2">Crear Noticia</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Noticias</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Buscar noticia</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarNoticia" placeholder="Ingrese texto o contenido de la noticia" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaNoticia" class="row d-flex align-items-stretch"></div>
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
<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2)) {
    include_once '../Vista/layouts/header.php'
?>
    <title>Adm | Cargos</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../Recursos/js/configuracion.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Configurar Web</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_catalogo.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Configurar Web</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header notiHeader">
                                <h3 class="card-title">Información Básica</h3>
                            </div>
                            <div class="card-body pb-0">
                                <form id="form_datos_basicos">
                                    <div class="div form-group">
                                        <label for="txtNombre">Nombre</label>
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre de la entidad" id="txtNombreEntidad" required>
                                    </div>
                                    <div class="div form-group">
                                        <label for="txtDoc">Texto 1</label>
                                        <textarea name="" class="form-control" id="txtTexto1" rows="2" placeholder="Ingrese el texto que acompaña el nombre de la entidad" required></textarea>
                                    </div>
                                    <div class="div form-group">
                                        <label for="txtDoc">Misión</label>
                                        <textarea name="" class="form-control" id="txtMision" rows="2" placeholder="Ingrese la misión de la entidad" required></textarea>
                                    </div>
                                    <div class="div form-group">
                                        <label for="txtDoc">Visión</label>
                                        <textarea name="" class="form-control" id="txtVision" rows="2" placeholder="Ingrese la visión de la entidad" required></textarea>
                                    </div>
                                    <div class="alert alert-success text-center" id="save" style="display: none;">
                                        <span><i class='fas fa-check m-1'> Información Guardada</i></span>
                                    </div>
                                    <div class="alert alert-danger text-center" id="noSave" style="display: none;">
                                        <span><i class='fas fa-times m-1'> Error: Usuario no creado</i></span>
                                    </div>
                                    <div class="div form-group">
                                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header notiHeader">
                                <h3 class="card-title">Información Alternativa</h3>
                            </div>
                            <div class="card-body pb-0">
                                <form id="form_datos_alternativos">
                                    <div class="div form-group">
                                        <label for="txtNombre">Titulo texto alternativo</label>
                                        <input type="text" class="form-control" placeholder="Ingrese un título para el texto alternativo" id="txtTituloAlternativo">
                                    </div>
                                    <div class="div form-group">
                                        <label for="txtDoc">Texto Alternativo</label>
                                        <textarea name="" class="form-control" id="txtAlternativo" rows="5" placeholder="Este texto reemplazará la misión y visión en la pagina principal"></textarea>
                                    </div>
                                    <div class="alert alert-success text-center" id="saveA" style="display: none;">
                                        <span><i class='fas fa-check m-1'> Información Guardada</i></span>
                                    </div>
                                    <div class="alert alert-danger text-center" id="noSaveA" style="display: none;">
                                        <span><i class='fas fa-times m-1'> Error: Usuario no creado</i></span>
                                    </div>
                                    <div class="div form-group">
                                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header notiHeader">
                                <h3 class="card-title">Imagen 1</h3>
                                <button type="submit" id="btnDeleteImg1" class="btn btn-sm bg-gradient-danger float-right m-1"><i class='fas fa-trash'></i></button>
                            </div>
                            <div class="card-body pb-0">
                                <form id="form_crear_imagen1">
                                    <div class="input-group mb-3">
                                        <img id="img1" style="width: 60%;">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class='fas fa-image' accept="image/*"></i></span>
                                        </div>
                                        <input type="file" id="txtImage1" name="imagen1" class="form-control">
                                    </div>
                                    <div class="alert alert-success text-center" id="divCreateImg1" style="display: none;">
                                        <span><i class='fas fa-check m-1'> Imagén 1 registrada</i></span>
                                    </div>
                                    <div class="alert alert-danger text-center" id="divNoCreateImg1" style="display: none;">
                                        <span><i class='fas fa-times m-1'></i></span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="funcion" value="guardarImagen1">
                                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header notiHeader">
                                <h3 class="card-title">Imagen 2</h3>
                                <button type="submit" id="btnDeleteImg2" class="btn btn-sm bg-gradient-danger float-right m-1"><i class='fas fa-trash'></i></button>
                            </div>
                            <div class="card-body pb-0">
                                <form id="form_crear_imagen2">
                                    <div class="input-group mb-3">
                                        <img id="img2" style="width: 60%;">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class='fas fa-image' accept="image/*"></i></span>
                                        </div>
                                        <input type="file" id="txtImage2" name="imagen2" class="form-control">
                                    </div>
                                    <div class="alert alert-success text-center" id="divCreateImg2" style="display: none;">
                                        <span><i class='fas fa-check m-1'> Imagén 2 registrada</i></span>
                                    </div>
                                    <div class="alert alert-danger text-center" id="divNoCreateImg2" style="display: none;">
                                        <span><i class='fas fa-times m-1'></i></span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="funcion" value="guardarImagen2">
                                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo']==1)) {
    include_once '../../Vista/layouts/header.php'
?>
    <title>Adm | Sedes</title>
    <?php
    include_once '../../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../../Recursos/js/sede.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <div class="modal fade" id="crearSede" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Crear Sede</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_sede">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="txtNombreSede">Nombre de la sede</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre de la sede" id="txtNombreSede" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtCiudadSede">Ciudad</label>
                                <input type="text" class="form-control" name="ciudad_sede" placeholder="Ingrese la ciudad donde se encuentra la sede" id="txtCiudadSede" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtDirSede">Dirección</label>
                                <input type="text" class="form-control" name="direccion_sede" placeholder="Ingrese la dirección de la sede" id="txtDirSede" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtTelSede">Teléfono</label>
                                <input type="text" class="form-control" name="tel_sede" placeholder="Ingrese el teléfono de la sede" id="txtTelSede" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtEmailSede">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Ingrese el email la sede" id="txtEmailSede" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtWpSede">Whatsapp</label>
                                <input type="text" class="form-control" name="wp_sede" placeholder="Ingrese el número de Whatsapp de la sede" maxlength="12" id="txtWpSede" >
                            </div>
                            <div class="div form-group">
                                <label for="txtNitSede">Nit</label>
                                <input type="text" class="form-control" name="nit" placeholder="Ingrese el Nit de la sede" id="txtNitSede" >
                            </div>
                            <div class="div form-group">
                                <label for="txtFbSede">Facebook</label>
                                <input type="text" class="form-control" name="facebook" placeholder="Ingrese la url del Facebook de la sede" id="txtFbSede" >
                            </div>
                            <div class="div form-group">
                                <label for="txtInstagramSede">Instagram</label>
                                <input type="text" class="form-control" name="instagram" placeholder="Ingrese la url del Facebook de la sede" id="txtInstagramSede" >
                            </div>
                            <div class="div form-group">
                                <label for="txtTwitterSede">Twitter</label>
                                <input type="text" class="form-control" name="twitter" placeholder="Ingrese la url del Twitter de la sede" id="txtTwitterSede" >
                            </div>
                            <div class="div form-group">
                                <label for="txtYoutubeSede">Canal de Youtube</label>
                                <input type="text" class="form-control" name="youtube" placeholder="Ingrese la url del canal de youtube de la sede" id="txtYoutubeSede" >
                            </div>
                            <div class="alert alert-success text-center" id="divCreate" style="display: none;">
                                <span><i class='fas fa-check m-1'> Sede registrada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreate" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="funcion" value="crearSede">
                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                            <button type="button" class="btn btn-outline-secondary float-right m-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editar_region" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header notiHeader">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Sede</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
                </div>
                <form id="form_editar_sede">
                    <div class="modal-body">
                        <div class="div form-group">
                            <label for="txtNombreSede2">Nombre de la Sede</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre de la region" id="txtNombreSede2" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtCiudadSede2">Ciudad</label>
                            <input type="text" class="form-control" name="ciudad_sede" placeholder="Ingrese la ciudad donde se encuentra la sede" id="txtCiudadSede2" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtDirSede2">Dirección</label>
                            <input type="text" class="form-control" name="direccion_sede" placeholder="Ingrese la dirección de la sede" id="txtDirSede2" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtTelSede2">Teléfono</label>
                            <input type="text" class="form-control" name="tel_sede" placeholder="Ingrese el teléfono de la sede" id="txtTelSede2" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtEmailSede2">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Ingrese el email la sede" id="txtEmailSede2" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtWpSede2">Whatsapp</label>
                            <input type="text" class="form-control" name="wp_sede" placeholder="Ingrese el número de Whatsapp de la sede" id="txtWpSede2" >
                        </div>
                        <div class="div form-group">
                            <label for="txtNitSede2">Nit</label>
                            <input type="text" class="form-control" name="nit" placeholder="Ingrese el Nit de la sede" id="txtNitSede2" >
                        </div>
                        <div class="div form-group">
                            <label for="txtFbSede2">Facebook</label>
                            <input type="text" class="form-control" name="facebook" placeholder="Ingrese la url del Facebook de la sede" id="txtFbSede2" >
                        </div>
                        <div class="div form-group">
                            <label for="txtInstagramSede2">Instagram</label>
                            <input type="text" class="form-control" name="instagram" placeholder="Ingrese la url del Facebook de la sede" id="txtInstagramSede2" >
                        </div>
                        <div class="div form-group">
                            <label for="txtTwitterSede2">Twitter</label>
                            <input type="text" class="form-control" name="twitter" placeholder="Ingrese la url del Twitter de la sede" id="txtTwitterSede2" >
                        </div>
                        <div class="div form-group">
                            <label for="txtYoutubeSede2">Canal de Youtube</label>
                            <input type="text" class="form-control" name="youtube" placeholder="Ingrese la url del canal de youtube de la sede" id="txtYoutubeSede2" >
                        </div>
                        <div class="input-group mb-3">
                            <input type="hidden" id="txtId_sedeEd" name="id">
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="updateObj" style="display: none;">
                        <span><i class='fas fa-check m-1'> Sede Actualizada</i></span>
                    </div>
                    <div class="alert alert-danger text-center" id="noUpdateObj" style="display: none;">
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


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestión Sedes
                            <button type="button" data-bs-toggle="modal" data-bs-target="#crearSede" class="btn bg-gradient-primary m-2">Crear Sede</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Sedes</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Buscar Sede</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarSede" placeholder="Ingrese el nombre de la sede" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaSede" class="row d-flex align-items-stretch"></div>
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
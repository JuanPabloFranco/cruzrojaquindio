<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['permisos'][0]->sedes == 'Activo')) {
    include_once '../Vista/layouts/header.php'
?>
    <title>Adm | Sede</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../Recursos/js/sede2.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="txtIdsede" value="<?php echo $_SESSION['id_sede']; ?>">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestión Sede</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Sede</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Ingresa los datos actualizados de tu sede</h3>

                    </div>
                    <div class="card-body pb-0">
                        <form id="form_editar_sede">
                            <div class="modal-body">
                                <div class="div form-group">
                                    <label for="txtNombreSede2">Nombre de la sede</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre de la sede" id="txtNombreSede2" required>
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
                                    <label for="txtTelRSede">Teléfono</label>
                                    <input type="text" class="form-control" name="tel_region" placeholder="Ingrese el teléfono de la sede" id="txtTelSede2" required>
                                </div>
                                <div class="div form-group">
                                    <label for="txtEmailRSede">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Ingrese el email la sede" id="txtEmailSede2" required>
                                </div>
                                <div class="div form-group">
                                    <label for="txtWpRSede">Whatsapp</label>
                                    <input type="text" class="form-control" name="wp_region" placeholder="Ingrese el número de Whatsapp de la sede" id="txtWpSede2">
                                </div>
                                <div class="div form-group">
                                    <label for="txtNitRSede">Nit</label>
                                    <input type="text" class="form-control" name="nit" placeholder="Ingrese el Nit de la sede" id="txtNitSede2">
                                </div>
                                <div class="div form-group">
                                    <label for="txtFbRSede">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" placeholder="Ingrese la url del Facebook de la sede" id="txtFbSede2">
                                </div>
                                <div class="div form-group">
                                    <label for="txtInstagramSede2">Instagram</label>
                                    <input type="text" class="form-control" name="instagram" placeholder="Ingrese la url del Facebook de la sede" id="txtInstagramSede2">
                                </div>
                                <div class="div form-group">
                                    <label for="txtTwitterSede2">Twitter</label>
                                    <input type="text" class="form-control" name="twitter" placeholder="Ingrese la url del Twitter de la sede" id="txtTwitterSede2">
                                </div>
                                <div class="div form-group">
                                    <label for="txtYoutubeSede2">Canal de Youtube</label>
                                    <input type="text" class="form-control" name="youtube" placeholder="Ingrese la url del canal de youtube de la sede" id="txtYoutubeSede2">
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
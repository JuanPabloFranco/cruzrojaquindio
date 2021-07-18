<?php
session_start();
if (isset($_SESSION['type_id']) && $_SESSION['type_id'] <= 3) {
    include_once '../Vista/layouts/header.php'
?>
    <title>Adm | Editar Usuario</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../Recursos/js/usuario.js"></script>
    <div class="modal fade" id="changePass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_pass">
                    <div class="modal-body">
                        <div class="text-center">
                            <img id="avatar2" class="profile-user-img img-fluid img-circle">
                            <div class="text-center"><b><?php echo $_SESSION['name_user']; ?></b></div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class='fas fa-user'></i></span>
                            </div>
                            <input type="text" id="txtUsuarioCh" value="<?php echo $_SESSION['usuario']; ?>" class="form-control" placeholder="Ingrese un nombre de usuario">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class='fas fa-unlock-alt'></i></span>
                            </div>
                            <input type="password" id="oldPass" class="form-control" placeholder="Ingrese la contraseña actual">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class='fas fa-lock'></i></span>
                            </div>
                            <input type="text" id="newPass" class="form-control" placeholder="Ingrese la nueva contraseña">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                    </div>
                    <div class="alert alert-success text-center" id="update" style="display: none;">
                        <span><i class='fas fa-check m-1'> login Actualizado<br>Reinicie la sesión para ver los cambios</i></span>
                    </div>
                    <div class="alert alert-danger text-center" id="noUpdate" style="display: none;">
                        <span><i class='fas fa-times m-1'> </i></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="changeAvatar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Avatar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-success text-center" id="updateAvatar" style="display: none;">
                    <span><i class='fas fa-check m-1'> Avatar Actualizado</i></span>
                </div>
                <div class="alert alert-danger text-center" id="noUpdateAvatar" style="display: none;">
                    <span><i class='fas fa-times m-1'> Tipo de archivo incorrecto</i></span>
                </div>
                <form id="form_avatar" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="text-center">
                            <img id="avatar3" class="profile-user-img img-fluid img-circle">
                            <div class="text-center"><b><?php echo $_SESSION['name_user']; ?></b></div>
                        </div>
                        <div class="input-group mb-3 mt-2">
                            <input type="file" name="avatar" class='input-group' accept="image/*">
                            <input type="hidden" name="funcion" value="changeAvatar">
                        </div>
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
                        <h1>Información General</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Información General</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-success card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img id="avatar1" class="profile-user-img img-fluid img-circle">
                                    </div>
                                    <div class="text-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#changeAvatar" class="btn btn-primary btn-sm mt-1">Cambiar Avatar</button>
                                    </div>
                                    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
                                    <h3 class="profile-username text-center" style="color: #320a48;"><?php echo $_SESSION['name_user']; ?></h3>
                                    <p class="text-muted"><?php echo $_SESSION['type_user']; ?></p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item"><b style="color: #320a48;">Edad</b><a class="float-right" id="edad_usuario"></a></li>
                                        <li class="list-group-item"><b style="color: #320a48;">Documento</b><a class="float-right" id="doc_usuario"></a></li>
                                    </ul>
                                    <button data-bs-toggle="modal" data-bs-target="#changePass" type="button" class='btn btn-block btn-outline-warning btn-sm'>Cambiar Login</button>
                                </div>
                            </div>
                            <div class="card  card-success">
                                <div class="modal-header notiHeader">
                                    <h3 class="card-title">Sobre mi</h3>
                                </div>
                                <div class="card-body">
                                    <strong style="color: #320a48;"><i class='fas fa-venus-mars mr-1'></i> Género</strong>
                                    <p class="text-muted" id="genero"></p>
                                    <strong style="color: #320a48;"><i class='fas fa-calendar-alt mr-1'></i> Fecha Nacimiento</strong>
                                    <p class="text-muted" id="fecha_nac"></p>
                                    <strong style="color: #320a48;"><i class='fas fa-phone mr-1'></i> Teléfono</strong>
                                    <p class="text-muted" id="p_telefono"></p>
                                    <strong style="color: #320a48;"><i class='fas fa-mobile-alt mr-1'></i> Celular</strong>
                                    <p class="text-muted" id="p_celular"></p>
                                    <strong style="color: #320a48;"><i class='fas fa-map-marker-alt mr-1'></i> Residencia</strong>
                                    <p class="text-muted" id="p_residencia"></p>
                                    <strong style="color: #320a48;"><i class='fas fa-at mr-1'></i> Email</strong>
                                    <p class="text-muted" id="p_email"></p>
                                    <strong style="color: #320a48;"><i class='fas fa-map-marker-alt mr-1'></i> Región</strong>
                                    <p class="text-muted" id="p_region"></p>
                                    <strong style="color: #320a48;"><i class='fas fa-user-check mr-1'></i> Cargo</strong>
                                    <p class="text-muted" id="p_cargo"></p>
                                    <strong style="color: #320a48;"><i class='fas fa-user-shield mr-1'></i> Tipo Usuario</strong>
                                    <p class="text-muted" id="p_tipo"></p>
                                    <strong style="color: #320a48;"><i class='fas fa-pencil-alt mr-1'></i> Información Adicional</strong>
                                    <p class="text-muted" id="p_info"></p>
                                    <button class="edit btn btn-block bg-gradient-danger">Editar</button>
                                    <p class="text-muted">Clic en el botón para editar</p>
                                </div>
                                <div class="card-footer">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card card-success">
                                <div class="modal-header notiHeader">
                                    <h5 class="card-tittle">Editar Información General</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal" id="formEditarGeneral">
                                        <div class="form-group row">
                                            <label for="txtNombreCompleto" class="col-sm-2 col-form-label">Nombre Completo</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="txtNombreCompleto" name="nombre_completo" class='form-control'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtDoc_id" class="col-sm-2 col-form-label">No. Documento</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="txtDoc_id" name="doc_id" class='form-control'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtTecha_nac" class="col-sm-2 col-form-label">Fecha Nacimiento</label>
                                            <div class="col-sm-10">
                                                <input type="date" id="txtTecha_nac" name="fecha_nac" class='form-control'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtLugarNac" class="col-sm-2 col-form-label">Lugar de Nacimiento</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="txtLugarNac" name="lugar_nac" class='form-control'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtTelefono" class="col-sm-2 col-form-label">Sexo</label>
                                            <div class="col-sm-10">
                                                <select name="genero" id="selGenero" class="form-control">
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Femenino">Femenino</option>                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtTelefono" class="col-sm-2 col-form-label">Teléfono</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="txtTelefono" name="tel_voluntario" class='form-control'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtCelular" class="col-sm-2 col-form-label">Celular</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="txtCelular" name="cel_voluntario" class='form-control'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtDireccion" class="col-sm-2 col-form-label">Dirección de Residencia</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="txtDireccion" name="dir_voluntario" class='form-control'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="txtEmail" name="email_voluntario" class='form-control'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtTwitter" class="col-sm-2 col-form-label">Twitter</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="txtTwitter" name="twitter" class='form-control' placeholder="pega aquí la URL de tu twitter">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtFb" class="col-sm-2 col-form-label">Facebook</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="txtFb" name="facebook" class='form-control' placeholder="pega aquí la URL de tu Facebook">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtInstagram" class="col-sm-2 col-form-label">Instagram</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="txtInstagram" name="instagram" class='form-control' placeholder="pega aquí la URL de tu instagram">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="txtAdicional" class="col-sm-2 col-form-label">Información Adicional</label>
                                            <div class="col-sm-10">
                                                <textarea name="inf_usuario" id="txtAdicional" cols="30" rows="5" class='form-control'></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10 float-right">
                                                <button class="btn btn-block btn-outline-success">Guardar</button>
                                            </div>
                                        </div>
                                        <div class="alert alert-success text-center" id="editado" style="display: none;">
                                            <span><i class='fas fa-check m-1'> Actualización exitosa</i></span>
                                        </div>
                                        <div class="alert alert-danger text-center" id="noeditado" style="display: none;">
                                            <span><i class='fas fa-times m-1'> Haz clic en el botón Rojo (Editar)</i></span>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <p class="text-muted">Ingresar datos validos</p>
                                </div>
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
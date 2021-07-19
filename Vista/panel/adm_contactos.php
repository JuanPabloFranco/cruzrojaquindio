<?php
session_start();
include '../../Conexion/consulSQL.php';
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['permisos'][0]->agenda == 'Activo')) {
    include_once '../../Vista/layouts/header.php'
?>
    <title>Adm | Contactos</title>
    <?php
    include_once '../../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../../Recursos/js/contactos.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
    <input type="hidden" id="id_sede" value="<?php echo $_SESSION['id_sede']; ?>">
    <input type="hidden" id="cobertura" value="<?php echo $_SESSION['permisos'][0]->cobertura; ?>">
    <div class="modal fade" id="crear_contacto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Crear Contacto</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_contacto">
                        <div class="card-body">
                            <?php
                            if ($_SESSION['permisos'][0]->cobertura == 'Full') {
                                $resSedesCreate = ejecutarSQL::consultar("SELECT id, nombre_sede FROM sedes WHERE estado_sede='Activo'");
                            ?>
                                <div class="div form-group">
                                    <label for="selTipoCto">Sede</label>
                                    <select class="form-control" id="id_sede2">
                                        <?php
                                        while ($sedeCreate = mysqli_fetch_array($resSedesCreate)) {
                                            echo '<option value="' . $sedeCreate['id'] . '">' . $sedeCreate['nombre_sede'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="div form-group">
                                    <input type="text" class="form-control" value="<?php echo $_SESSION['name_sede']; ?>" readonly>
                                    <input type="hidden" class="form-control" name="id_region" value="<?php echo $_SESSION['id_sede']; ?>" id="id_sede2" required>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="div form-group">
                                <label for="selTipoCto">Tipo de contacto</label>
                                <select name="tipo_cto" class="form-control" id="selTipoCto">
                                    <option value="Entidad Pública">Entidad Pública</option>
                                    <option value="Entidad Privada">Entidad Privada</option>
                                    <option value="Persona Natural">Persona Natural</option>
                                </select>
                            </div>
                            <div class="div form-group">
                                <label for="txtNombreCto">Nombre del contacto</label>
                                <input type="text" class="form-control" name="nombre_cto" placeholder="Ingrese el nombre del contacto" id="txtNombreCto" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtTelCto">Teléfono</label>
                                <input type="text" class="form-control" name="tel_cto" placeholder="Ingrese el teléfono del contacto" id="txtTelCto">
                            </div>
                            <div class="div form-group">
                                <label for="txtEmailCto">Email</label>
                                <input type="email" class="form-control" name="email_cto" placeholder="Ingrese el email del contacto" id="txtEmailCto">
                            </div>
                            <div class="div form-group">
                                <label for="txtDirCto">Dirección</label>
                                <input type="text" class="form-control" name="dir_cto" placeholder="Ingrese la dirección del contacto" id="txtDirCto">
                            </div>
                            <div class="div form-group">
                                <label for="txtMunicipio">Municipio</label>
                                <input type="text" class="form-control" name="municipio" placeholder="Ingrese el municipio de ubicación" id="txtMunicipio">
                            </div>
                            <div class="div form-group">
                                <label for="txtDeptoCto">Departamento</label>
                                <input type="text" class="form-control" name="depto_cto" placeholder="Ingrese el departamento de ubicación" id="txtDeptoCto">
                            </div>
                            <div class="div form-group">
                                <label for="txtWebCtog">Página Web</label>
                                <input type="text" class="form-control" name="web_cto" placeholder="Ingrese la página web del contacto" id="txtWebCtog">
                            </div>
                            <div class="div form-group">
                                <label for="txtNotasCto">Notas</label>
                                <textarea id="txtNotasCto" name="notas" rows="3" placeholder="Ingresa alguna descripción o notas sobre el contacto" class="form-control"></textarea>
                            </div>
                            <div class="alert alert-success text-center" id="divCreate" style="display: none;">
                                <span><i class='fas fa-check m-1'> Contacto registrado</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreate" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="funcion" value="crear_contacto">
                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                            <button type="button" class="btn btn-outline-secondary float-right m-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editar_contacto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header notiHeader">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
                </div>
                <form id="form_editar_contacto">
                    <div class="modal-body">
                        <div class="div form-group">
                            <label for="selTipoCto2">Tipo de contacto</label>
                            <select name="tipo_cto" class="form-control" id="selTipoCto2">
                                <option value="Entidad Pública">Entidad Pública</option>
                                <option value="Entidad Privada">Entidad Privada</option>
                                <option value="Persona Natural">Persona Natural</option>
                            </select>
                        </div>
                        <div class="div form-group">
                            <label for="txtNombreCto2">Nombre del contacto</label>
                            <input type="text" class="form-control" name="nombre_cto" placeholder="Ingrese el nombre del contacto" id="txtNombreCto2" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtTelCto2">Teléfono</label>
                            <input type="text" class="form-control" name="tel_cto" placeholder="Ingrese el teléfono del contacto" id="txtTelCto2">
                        </div>
                        <div class="div form-group">
                            <label for="txtEmailCto2">Email</label>
                            <input type="email" class="form-control" name="email_cto" placeholder="Ingrese el email del contacto" id="txtEmailCto2">
                        </div>
                        <div class="div form-group">
                            <label for="txtDirCto2">Dirección</label>
                            <input type="text" class="form-control" name="dir_cto" placeholder="Ingrese la dirección del contacto" id="txtDirCto2">
                        </div>
                        <div class="div form-group">
                            <label for="txtMunicipio2">Municipio</label>
                            <input type="text" class="form-control" name="municipio" placeholder="Ingrese el municipio de ubicación" id="txtMunicipio2">
                        </div>
                        <div class="div form-group">
                            <label for="txtDeptoCto2">Departamento</label>
                            <input type="text" class="form-control" name="depto_cto" placeholder="Ingrese el departamento de ubicación" id="txtDeptoCto2">
                        </div>
                        <div class="div form-group">
                            <label for="txtWebCtog2">Página Web</label>
                            <input type="text" class="form-control" name="web_cto" placeholder="Ingrese la página web del contacto" id="txtWebCtog2">
                        </div>
                        <div class="div form-group">
                            <label for="txtNotasCto2">Notas</label>
                            <textarea id="txtNotasCto2" name="notas" rows="3" placeholder="Ingresa alguna descripción o notas sobre el contacto" class="form-control"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <input type="hidden" id="txtId_ctoEd" name="id">
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="updateObj" style="display: none;">
                        <span><i class='fas fa-check m-1'> Contacto Actualizado</i></span>
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
    <div class="modal fade" id="changeLogo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar imagén de contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_logoCto" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="text-center">
                            <img id="logoCtoEd" class="profile-user-img img-fluid img-circle">
                            <div class="text-center"><b id="NombreContactoImg"></b></div>
                        </div>
                        <div class="input-group mb-3 mt-2">
                            <input type="file" name="logo_cto" class='input-group' accept="image/*">
                            <input type="hidden" name="funcion" value="changeLogo">
                            <input type="hidden" name="id" id="txtIdCtoImg">
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="updateAvatar" style="display: none;">
                        <span><i class='fas fa-check m-1'> Imagén Actualizada</i></span>
                    </div>
                    <div class="alert alert-danger text-center" id="noUpdateAvatar" style="display: none;">
                        <span><i class='fas fa-times m-1'> Tipo de archivo incorrecto</i></span>
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
                        <h1>Gestión Contactos
                            <button type="button" id="btn_crear_usuario" data-bs-toggle="modal" data-bs-target="#crear_contacto" class="btn bg-gradient-primary m-2">Crear Contacto</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Contactos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Buscar Contacto</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarContacto" placeholder="Ingrese el nombre, teléfono, municipio, departamento o contenido de notas" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaContacto" class="row d-flex align-items-stretch"></div>
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
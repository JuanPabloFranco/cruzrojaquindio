<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2)) {
    include_once '../../Vista/layouts/header.php'
?>
    <title>Adm | Cargos</title>
    <?php
    include_once '../../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../../Recursos/js/cargos.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">

    <div class="modal fade" id="editar_cargo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header notiHeader">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cargo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
                </div>
                <form id="form_editar_cargo">
                    <div class="modal-body">
                        <div class="div form-group">
                            <label for="txtNombreCargo2">Nombre Cargo</label>
                            <input type="text" id="txtNombreCargo2" class="form-control" required>
                        </div>
                        <div class="div form-group">
                            <label for="selCobertura2">Cobertura</label>
                            <select name="" class="form-control" id="selCobertura2" required>
                                <option value="Full">Full</option>
                                <option value="Particular">Particular</option>
                            </select>
                        </div>
                        <div class="div form-group">
                            <textarea name="" id="txtDescCargo2" cols="30" rows="5" placeholder="Ingresa la descripción del cargo ó las funciones" class="form-control"></textarea>
                        </div>
                        <label for="selCobertura" class="text-center">Permisos</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkConfiguracion2">
                                    <label for="checkConfiguracion2">Configuración</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkSedes2">
                                    <label for="checkSedes2">Sedes</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkUsuarios2">
                                    <label for="checkUsuarios2">Usuarios</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkAgenda2">
                                    <label for="checkAgenda2">Agenda</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkMsjContacto2">
                                    <label for="checkMsjContacto2">Mensajes de contacto</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkNotas2">
                                    <label for="checkNotas2">Notas</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkServicios2">
                                    <label for="checkServicios2">Servicios</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkGaleria2">
                                    <label for="checkGaleria2">Galeria</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkEsal2">
                                    <label for="checkEsal2">Esal</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkNoticias2">
                                    <label for="checkNoticias2">Noticias</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkEventos2">
                                    <label for="checkEventos2">Eventos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="updateObj" style="display: none;">
                        <span><i class='fas fa-check m-1'> Cargo Actualizado</i></span>
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

    <div class="modal fade" id="crearCargo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header notiHeader">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Cargo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
                </div>
                <form id="form_crear_cargo">
                    <div class="modal-body">
                        <div class="div form-group">
                            <label for="txtNombreCargo">Nombre Cargo</label>
                            <input type="text" id="txtNombreCargo" class="form-control" required>
                        </div>
                        <div class="div form-group">
                            <label for="selCobertura">Cobertura</label>
                            <select name="" class="form-control" id="selCobertura" required>
                                <option value="Full">Full</option>
                                <option value="Particular">Particular</option>
                            </select>
                        </div>
                        <div class="div form-group">
                            <textarea name="" id="txtDescCargo" cols="30" rows="5" placeholder="Ingresa la descripción del cargo ó las funciones" class="form-control"></textarea>
                        </div>
                        <label for="selCobertura" class="text-center">Permisos</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkConfiguracion">
                                    <label for="checkConfiguracion">Configuración</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkSedes">
                                    <label for="checkSedes">Sedes</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkUsuarios">
                                    <label for="checkUsuarios">Usuarios</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkAgenda">
                                    <label for="checkAgenda">Agenda</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkMsjContacto">
                                    <label for="checkMsjContacto">Mensajes de contacto</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkNotas">
                                    <label for="checkNotas">Notas</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkServicios">
                                    <label for="checkServicios">Servicios</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkGaleria">
                                    <label for="checkGaleria">Galeria</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkEsal">
                                    <label for="checkEsal">Esal</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkNoticias">
                                    <label for="checkNoticias">Noticias</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="checkEventos">
                                    <label for="checkEventos">Eventos</label>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="hidden" id="txtId_CargoEd" name="id">
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="createObj" style="display: none;">
                        <span><i class='fas fa-check m-1'> Cargo Actualizado</i></span>
                    </div>
                    <div class="alert alert-danger text-center" id="noCreateObj" style="display: none;">
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
                <div class="row mb-">
                    <div class="col-sm-6">
                        <h1>Gestión Cargos
                        <button type="button" id="btn_crear_esal" data-bs-toggle="modal" data-bs-target="#crearCargo" class="btn bg-gradient-primary m-2">Crear Cargo</button>
                        </h1>
                    </div>
                    <div class="col-sm-6 ">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Cargos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Buscar Cargo</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarCargo" placeholder="Ingrese el nombre del cargo" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaCargos" class="row d-flex align-items-stretch"></div>
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
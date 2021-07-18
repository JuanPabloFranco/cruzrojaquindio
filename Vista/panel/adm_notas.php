<?php
session_start();
if (isset($_SESSION['type_id'])) {
    include_once '../Vista/layouts/header.php';
    include_once '../Conexion/consulSQL.php';
?>
    <title>Adm | Notas</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../Recursos/js/notas.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="txtId_sede" value="<?php echo $_SESSION['id_sede']; ?>">
    <div class="modal fade" id="crearNota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Crear Nota</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_nota">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="selTipoNota">Tipo de nota</label>
                                <select name="tipo_nota" id="selTipoNota" class="form-control" required>
                                    <option value="0">Seleccione una opción</option>
                                    <option value="Capacitación">Capacitación</option>
                                    <option value="Condolencia">Condolencia</option>
                                    <option value="Evento">Evento</option>
                                    <option value="Felicitación">Felicitación</option>
                                    <option value="Información Urgente">Información Urgente</option>
                                    <option value="Información">Información</option>
                                    <option value="Noticia">Noticia</option>
                                    <option value="Recordatorio">Recordatorio</option>
                                    <option value="Tarea Urgente">Tarea Urgente</option>
                                    <option value="Tarea">Tarea</option>
                                    <option value="Tip">Tip</option>
                                </select>
                            </div>
                            <div class="div form-group">
                                <label for="selDirigido">Dirigido a</label>
                                <select name="dirigido" id="selDirigido" class="form-control" required>
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    if ($_SESSION['id_cargo'] >= 2 && $_SESSION['id_cargo'] <= 7 || ($_SESSION['type_id'] <= 2)) {
                                    ?>
                                        <option value="Sede">Sede</option>
                                    <?php
                                    }
                                    ?>
                                    <option value="Cargo">Cargo</option>
                                    <option value="Usuario">Usuario</option>
                                    <option value="Todos">Todos</option>
                                </select>
                            </div>
                            <div class="div form-group" style="display: none;" id="divSede">
                                <label for="selSedeNota">Sede</label>
                                <select name="id_sede" id="selSedeNota" class="form-control">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $sqlSedes = ejecutarSQL::consultar("SELECT id, nombre_sede FROM sedes");
                                    while ($filaSede = mysqli_fetch_array($sqlSedes)) {
                                        echo '<option value="' . $filaSede['id'] . '">' . $filaSede['nombre_sede'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="div form-group" style="display: none;" id="divCargo">
                                <label for="selCargoNota">Cargo</label>
                                <select name="id_cargo" id="selCargoNota" class="form-control">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    if (($_SESSION['id_cargo'] >= 8 && $_SESSION['id_cargo'] <= 13) || $_SESSION['id_cargo'] == 1) {
                                        $sql = "SELECT id, nombre_cargo FROM cargo WHERE id<>1 AND (id>=8 AND id<=13)";
                                    }
                                    if ($_SESSION['id_cargo'] >= 2 && $_SESSION['id_cargo'] <= 7 || ($_SESSION['type_id'] <= 2)) {
                                        $sql = "SELECT id, nombre_cargo FROM cargo WHERE id<>1";
                                    }
                                    $sqlCargos = ejecutarSQL::consultar($sql);
                                    while ($filaC = mysqli_fetch_array($sqlCargos)) {
                                        echo '<option value="' . $filaC['id'] . '">' . $filaC['nombre_cargo'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="div form-group" style="display: none;" id="divUsuario">
                                <label for="selUsuario">Voluntario</label>
                                <select name="id_voluntario" id="selUsuario" class="form-control">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    if (($_SESSION['id_cargo'] >= 1 && $_SESSION['id_cargo'] <= 7) || $_SESSION['id_cargo'] == 1) {
                                        $sqlV = "SELECT V.id, V.nombre_completo, R.nombre_sede FROM usuario V JOIN sedes R ON V.id_sede=R.id WHERE V.id<>1";
                                    }
                                    if ($_SESSION['id_cargo'] >= 8 && $_SESSION['id_cargo'] <= 13 || ($_SESSION['type_id'] == 2)) {
                                        $sqlV = "SELECT V.id, V.nombre_completo, R.nombre_sede FROM usuario V JOIN sedes R ON V.id_sede=R.id WHERE V.id<>1 AND V.id_sede=" . $_SESSION['id_sede'];
                                    }
                                    $sqlV = ejecutarSQL::consultar($sqlV);
                                    while ($filaV = mysqli_fetch_array($sqlCasqlVrgos)) {
                                        echo '<option value="' . $filaV['id'] . '">' . $filaV['nombre_completo'] . " / " . $filaV['nombre_region'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="div form-group">
                                <label for="txtFechaIni">Fecha Inicial</label>
                                <input type="date" class="form-control" name="fecha_ini" placeholder="Fecha Inicio de la nota" id="txtFechaIni" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtFechaFinal">Fecha Final</label>
                                <input type="date" class="form-control" name="fecha_fin" placeholder="Fecha Final de la nota" id="txtFechaFinal" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtDescNota">Descripción Nota</label>
                                <textarea name="" id="txtDescNota" rows="5" placeholder="Ingresa la descripción o el contenido de la Nota" class="form-control"></textarea>
                            </div>
                            <div class="alert alert-success text-center" id="divCreate" style="display: none;">
                                <span><i class='fas fa-check m-1'> Nota registrada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreate" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="funcion" value="crear_nota">
                            <input type="hidden" name="id_autor" id="txtId_autor" value="<?php echo $_SESSION['id_user']; ?>">
                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                            <button type="button" class="btn btn-outline-secondary float-right m-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editar_nota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header notiHeader">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Nota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
                </div>
                <form id="form_editar_nota">
                    <div class="modal-body">
                        <div class="div form-group">
                            <label for="selTipoNota">Tipo de nota</label>
                            <select name="tipo_nota" id="selTipoNota2" class="form-control" required>
                                <option value="0">Seleccione una opción</option>
                                <option value="Capacitación">Capacitación</option>
                                <option value="Condolencia">Condolencia</option>
                                <option value="Evento">Evento</option>
                                <option value="Felicitación">Felicitación</option>
                                <option value="Información Urgente">Información Urgente</option>
                                <option value="Información">Información</option>
                                <option value="Noticia">Noticia</option>
                                <option value="Recordatorio">Recordatorio</option>
                                <option value="Tarea Urgente">Tarea Urgente</option>
                                <option value="Tarea">Tarea</option>
                                <option value="Tip">Tip</option>
                            </select>
                        </div>
                        <div class="div form-group">
                            <label for="selDirigido2">Dirigido a</label>
                            <select name="dirigido" id="selDirigido2" class="form-control" required>
                                <option value="0">Seleccione una opción</option>
                                <?php
                                if ($_SESSION['id_cargo'] >= 2 && $_SESSION['id_cargo'] <= 7 || ($_SESSION['type_id'] <= 2)) {
                                ?>
                                    <option value="Sede">Sede</option>
                                <?php
                                }
                                ?>
                                <option value="Cargo">Cargo</option>
                                <option value="Usuario">Usuario</option>
                                <option value="Todos">Todos</option>
                            </select>
                        </div>
                        <div class="div form-group" style="display: none;" id="divSede2">
                            <label for="selSedeNota2">Sede</label>
                            <select name="id_sede" id="selSedeNota2" class="form-control">
                                <option value="0">Seleccione una opción</option>
                                <?php
                                $sqlRegiones = ejecutarSQL::consultar("SELECT id, nombre_sede FROM sedes");
                                while ($filaSede = mysqli_fetch_array($sqlRegiones)) {
                                    echo '<option value="' . $filaSede['id'] . '">' . $filaSede['nombre_sede'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="div form-group" style="display: none;" id="divCargo2">
                            <label for="selCargoNota">Cargo</label>
                            <select name="id_cargo" id="selCargoNota2" class="form-control">
                                <option value="0">Seleccione una opción</option>
                                <?php
                                if (($_SESSION['id_cargo'] >= 8 && $_SESSION['id_cargo'] <= 13) || $_SESSION['id_cargo'] == 1) {
                                    $sql = "SELECT id, nombre_cargo FROM cargo WHERE id<>1 AND (id>=8 AND id<=13)";
                                }
                                if ($_SESSION['id_cargo'] >= 2 && $_SESSION['id_cargo'] <= 7 || ($_SESSION['type_id'] <= 2)) {
                                    $sql = "SELECT id, nombre_cargo FROM cargo WHERE id<>1";
                                }
                                $sqlCargos = ejecutarSQL::consultar($sql);
                                while ($filaC = mysqli_fetch_array($sqlCargos)) {
                                    echo '<option value="' . $filaC['id'] . '">' . $filaC['nombre_cargo'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="div form-group" style="display: none;" id="divUsuario2">
                            <label for="selUsuario2">Usuario</label>
                            <select name="id_usuario" id="selUsuario2" class="form-control">
                                <option value="0">Seleccione una opción</option>
                                <?php
                                if (($_SESSION['id_cargo'] >= 8 && $_SESSION['id_cargo'] <= 13) || $_SESSION['id_cargo'] == 1) {
                                    $sqlV = "SELECT V.id, V.nombre_completo, R.nombre_sede FROM usuario V JOIN sedes R ON V.id_sede=R.id WHERE V.id<>1";
                                }
                                if ($_SESSION['id_cargo'] >= 2 && $_SESSION['id_cargo'] <= 7 || ($_SESSION['type_id'] <= 2)) {
                                    $sqlV = "SELECT V.id, V.nombre_completo, R.nombre_sede FROM usuario V JOIN sedes R ON V.id_sede=R.id WHERE V.id<>1 AND V.id_sede=" . $_SESSION['id_sede'];
                                }
                                $sqlV = ejecutarSQL::consultar($sqlV);
                                while ($filaV = mysqli_fetch_array($sqlCasqlVrgos)) {
                                    echo '<option value="' . $filaV['id'] . '">' . $filaV['nombre_completo'] . " / " . $filaV['nombre_region'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="div form-group">
                            <label for="txtFechaIni">Fecha Inicial</label>
                            <input type="date" class="form-control" name="fecha_ini" placeholder="Fecha Inicio de la nota" id="txtFechaIni2" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtFechaFinal">Fecha Final</label>
                            <input type="date" class="form-control" name="fecha_fin" placeholder="Fecha Final de la nota" id="txtFechaFinal2" required>
                        </div>
                        <div class="div form-group">
                            <label for="txtDescNota">Descripción Nota</label>
                            <textarea name="" id="txtDescNota2" rows="5" placeholder="Ingresa la descripción o el contenido de la Nota" class="form-control"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <input type="hidden" id="txtId_NotaEd" name="id">
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="updateObj" style="display: none;">
                        <span><i class='fas fa-check m-1'> Nota Actualizada</i></span>
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
    <div class="modal fade" id="agregar_imagen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar imagén de nota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_img_nota" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="text-center">
                            <img id="notaImg" class="profile-user-img img-fluid">
                            <div class="text-center"><b id="txtNotaImg"></b></div>
                        </div>
                        <div class="input-group mb-3 mt-2">
                            <input type="file" name="imagen" class='input-group' accept="image/*">
                            <input type="hidden" name="funcion" value="changeImagen">
                            <input type="hidden" name="id" id="txtIdNotaImg">
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
                        <h1>Gestión Notas
                            <button type="button" id="btn_crear_notas" data-bs-toggle="modal" data-bs-target="#crearNota" class="btn bg-gradient-primary m-2">Crear Nota</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Notas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-body pb-0">
                        <div id="busquedaNota" class="row d-flex align-items-stretch"></div>
                    </div>
                    <div class="card-footer">                    
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
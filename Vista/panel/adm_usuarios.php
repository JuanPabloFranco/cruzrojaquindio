<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] >= 2)) {
    include_once '../../Vista/layouts/header.php';
    include_once '../../Conexion/consulSQL.php';
?>
    <title>Adm | Administrar Usuarios</title>
    <?php
    include_once '../../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../../Recursos/js/gestion_usuario.js"></script>

    <?php
    if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] == 1 || $_SESSION['id_cargo'] == 2 || $_SESSION['id_cargo'] == 8)) {
    ?>
        <div class="modal fade" id="confirmar_resp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header notiHeader">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="alert alert-success text-center" id="updateAsc" style="display: none;">
                        <span><i class='fas fa-check m-1'> Usuario Actualizado</i></span>
                    </div>
                    <div class="alert alert-danger text-center" id="noUpdateAsc" style="display: none;">
                        <span><i class='fas fa-times m-1'></i></span>
                    </div>
                    <form id="form_confirmar_user">
                        <span class='ml-2'>Ingresa tu password para continuar</span>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class='fas fa-unlock-alt'></i></span>
                                </div>
                                <input type="password" id="txtPass" class="form-control" placeholder="Ingrese la contraseña actual" required>
                                <input type="hidden" id="txtId_userConfirm">
                                <input type="hidden" id="txtFuncionConfirm">
                                <input type="hidden" id="txtEstadoConfirm">
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

        <div class="modal fade" id="editar_cc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header notiHeader">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Documento de identidad</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form_update_cc">
                        <div class="modal-body">
                            <div class="div form-group">
                                <label for="txtDoc2">No. Documento</label>
                                <input type="text" class="form-control" placeholder="Ingrese el documento de identidad" id="txtDoc2" required>
                            </div>
                            <?php
                            if ($_SESSION['type_id'] <= 2 || ($_SESSION['id_cargo'] == 2 && $_SESSION['id_cargo'] == 3 || $_SESSION['id_cargo'] == 7)) {
                            ?>
                                <div class="div form-group">
                                    <label for="txtSedeEd">Sede</label>
                                    <select id="txtSedeEd" class="form-control" required>
                                        <?php
                                        $sqlSedes2 = "SELECT id, nombre_sede FROM sedes";
                                        $resSede2 = ejecutarSQL::consultar($sqlSedes2);
                                        while ($sede2 = mysqli_fetch_array($resSede2)) {
                                            echo '<option value="' . $sede2['id'] . '">' . $sede2['nombre_sede'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="div form-group">
                                    <label for="txtSedeEd">Sede</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $_SESSION['name_sede']; ?>">
                                    <input type="" class="form-control" id="txtSedeEd" value="<?php echo $_SESSION['id_sede']; ?>">
                                </div>
                            <?php
                            }
                            ?>
                            <div class="div form-group">
                                <label for="selCargo">Cargo</label>
                                <select id="selCargoEd" class="form-control" required>
                                    <?php
                                    if ($_SESSION['id_cargo'] == 2) {
                                        $sqlCargo = "SELECT id, nombre_cargo FROM cargo WHERE id<>2";
                                    }
                                    if ($_SESSION['id_cargo'] == 3) {
                                        $sqlCargo = "SELECT id, nombre_cargo FROM cargo WHERE id<>2 AND id<>3";
                                    }
                                    if ($_SESSION['id_cargo'] == 8) {
                                        $sqlCargo = "SELECT id, nombre_cargo FROM cargo WHERE id=1 OR (id>=9 AND id<=13)";
                                    }
                                    if ($_SESSION['type_id'] <= 2) {
                                        $sqlCargo = "SELECT id, nombre_cargo FROM cargo";
                                    }
                                    $resCarg = ejecutarSQL::consultar($sqlCargo);
                                    while ($cargo = mysqli_fetch_array($resCarg)) {
                                        echo '<option value="' . $cargo['id'] . '">' . $cargo['nombre_cargo'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="alert alert-success text-center" id="updateCc" style="display: none;">
                            <span><i class='fas fa-check m-1'> Usuario Actualizado</i></span>
                        </div>
                        <div class="alert alert-danger text-center" id="noUpdateCc" style="display: none;">
                            <span><i class='fas fa-times m-1'></i></span>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="txtIdCc">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="crearUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header notiHeader">
                            <h3 class="card-title">Crear Usuario</h3>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form_crear_usuario">
                            <div class="card-body">
                                <div class="div form-group">
                                    <label for="txtNombreUsuario">Nombre Completo</label>
                                    <input type="text" class="form-control" placeholder="Ingrese el nombre" id="txtNombreUsuario" required>
                                </div>
                                <div class="div form-group">
                                    <label for="txtDoc">No. Documento</label>
                                    <input type="text" class="form-control" placeholder="Ingrese el documento de identidad" id="txtDoc" required>
                                </div>
                                <?php
                                if ($_SESSION['type_id'] <= 2 || ($_SESSION['id_cargo'] == 2 && $_SESSION['id_cargo'] == 3 || $_SESSION['id_cargo'] == 7)) {
                                ?>
                                    <div class="div form-group">
                                        <label for="txtSede">Sede</label>
                                        <select id="txtSede" class="form-control" required>
                                            <?php
                                            $sqlSedes = "SELECT id, nombre_sede FROM sedes";
                                            $resSede = ejecutarSQL::consultar($sqlSedes);
                                            while ($sedeCrear = mysqli_fetch_array($resSede)) {
                                                echo '<option value="' . $sedeCrear['id'] . '">' . $sedeCrear['nombre_sede'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="div form-group">
                                        <label for="txtSede">Sede</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $_SESSION['name_sede']; ?>">
                                        <input type="hidden" class="form-control" id="txtSede" value="<?php echo $_SESSION['id_sede']; ?>">
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="div form-group">
                                    <label for="selCargo">Cargo</label>
                                    <select id="selCargo" class="form-control" required>
                                        <?php
                                        if ($_SESSION['id_cargo'] == 2) {
                                            $sqlCargo = "SELECT id, nombre_cargo FROM cargo WHERE id<>2";
                                        }
                                        if ($_SESSION['id_cargo'] == 3) {
                                            $sqlCargo = "SELECT id, nombre_cargo FROM cargo WHERE id<>2 AND id<>3";
                                        }
                                        if ($_SESSION['id_cargo'] == 8) {
                                            $sqlCargo = "SELECT id, nombre_cargo FROM cargo WHERE id=1 OR (id>=9 AND id<=13)";
                                        }
                                        if ($_SESSION['type_id'] <= 2) {
                                            $sqlCargo = "SELECT id, nombre_cargo FROM cargo";
                                        }
                                        $resCarg = ejecutarSQL::consultar($sqlCargo);
                                        while ($cargo = mysqli_fetch_array($resCarg)) {
                                            echo '<option value="' . $cargo['id'] . '">' . $cargo['nombre_cargo'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="alert alert-success text-center" id="create" style="display: none;">
                                    <span><i class='fas fa-check m-1'> Usuario registrado</i></span>
                                </div>
                                <div class="alert alert-danger text-center" id="noCreate" style="display: none;">
                                    <span><i class='fas fa-times m-1'> Error: Usuario no creado</i></span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                                <button type="button" class="btn btn-outline-secondary float-right m-1" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
                        <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['type_id']; ?>">
                        <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
                        <input type="hidden" id="id_sede" value="<?php echo $_SESSION['id_sede']; ?>">
                        <h1>Gestión Usuarios
                            <?php
                            if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] == 1 || $_SESSION['id_cargo'] == 2 || $_SESSION['id_cargo'] == 8)) {
                            ?>
                                <button type="button" id="btn_crear_voluntario" data-bs-toggle="modal" data-bs-target="#crearUsuario" class="btn bg-gradient-primary m-2">Crear Usuario</button>
                            <?php
                            }
                            ?>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../../Vista/adm_catalogo.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Usuarios</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header notiHeader">
                        <h3 class="card-title">Buscar Usuario</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarUsuario" placeholder="Ingrese el nombre, teléfono o región del usuario" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaUsuario" class="row d-flex align-items-stretch"></div>
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
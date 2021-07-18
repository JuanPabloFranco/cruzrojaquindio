<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] >= 2)) {
    include_once '../Vista/layouts/header.php';
    include_once '../Conexion/consulSQL.php';
?>
    <title>Adm | Administrar Visitantes</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../Recursos/js/gestion_visitante.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
    <input type="hidden" id="id_sede" value="<?php echo $_SESSION['id_sede']; ?>">
    <input type="hidden" id="cobertura" value="<?php echo $_SESSION['permisos'][0]->cobertura; ?>">
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
                    <form id="form_update_cc_visitante">
                        <div class="modal-body">
                            <div class="div form-group">
                                <label for="txtDoc2">No. Documento</label>
                                <input type="text" class="form-control" placeholder="Ingrese el documento de identidad" id="txtDoc2" required>
                            </div>
                        </div>
                        <div class="alert alert-success text-center" id="updateCc" style="display: none;">
                            <span><i class='fas fa-check m-1'> Visitante Actualizado</i></span>
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
                            <h3 class="card-title">Crear Visitante</h3>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form_crear_visitante">
                            <div class="card-body">
                                <div class="div form-group">
                                    <label for="txtNombreUsuario">Nombre Completo</label>
                                    <input type="text" class="form-control" placeholder="Ingrese el nombre" id="txtNombreUsuario" required>
                                </div>
                                <div class="div form-group">
                                    <label for="txtDoc">No. Documento</label>
                                    <input type="text" class="form-control" placeholder="Ingrese el documento de identidad" id="txtDoc" required>
                                </div>
                                <div class="div form-group">
                                    <label for="txtTelefono">Teléfono</label>
                                    <input type="text" class="form-control" placeholder="Ingrese el teléfono del visitante" id="txtTelefono" required>
                                </div>
                                <div class="div form-group">
                                    <label for="txtEmail">Email</label>
                                    <input type="email" class="form-control" placeholder="Ingrese el documento de identidad" id="txtEmail" required>
                                </div>
                                <div class="div form-group">
                                    <label for="selNacionalidad">Nacionalidad</label>
                                    <select name="" id="selNacionalidad" class="form-control" style="width: 100%;" onchange="validarNacionalidad(this.value);">
                                        <option value="">Seleccione una opción</option>
                                        <?php
                                        $sqlNacionalidades = "SELECT id, PAIS_NAC, GENTILICIO_NAC FROM nacionalidad ORDER BY FIELD(PAIS_NAC,'Colombia')";
                                        $resNac = ejecutarSQL::consultar($sqlNacionalidades);
                                        while ($nacionalidad = mysqli_fetch_array($resNac)) {
                                            if($nacionalidad['id']==43){
                                                echo '<option value="' . $nacionalidad['id'] . '" selected>' . $nacionalidad['GENTILICIO_NAC'] . '  (' . $nacionalidad['PAIS_NAC'] . ')</option>';
                                            }else{
                                                echo '<option value="' . $nacionalidad['id'] . '">' . $nacionalidad['GENTILICIO_NAC'] . '  (' . $nacionalidad['PAIS_NAC'] . ')</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="div form-group"  id="divMunicipio" >
                                    <label for="selmunicipio">Municipio de residencia</label>
                                    <select name="" id="selmunicipio" class="form-control" style="width: 100%;">
                                        <option value="">Seleccione una opción</option>
                                        <?php
                                        $sqlMunicipios = "SELECT M.id, M.nombre AS municipio, D.nombre AS departamento  FROM municipios M JOIN departamentos D ON M.departamento_id=D.id ORDER BY D.nombre ASC";
                                        $resMunicipio = ejecutarSQL::consultar($sqlMunicipios);
                                        while ($municipio = mysqli_fetch_array($resMunicipio)) {
                                            if($municipio['id']==825){
                                                echo '<option value="' . $municipio['id'] . '" selected>' . $municipio['municipio'] . '  (' . $municipio['departamento'] . ')</option>';
                                            }else{
                                                echo '<option value="' . $municipio['id'] . '">' . $municipio['municipio'] . '  (' . $municipio['departamento'] . ')</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="alert alert-success text-center" id="create" style="display: none;">
                                    <span><i class='fas fa-check m-1'> Visitante registrado</i></span>
                                </div>
                                <div class="alert alert-danger text-center" id="noCreate" style="display: none;">
                                    <span><i class='fas fa-times m-1'> Error: Visitante no registrado</i></span>
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

                        <h1>Gestión Visitantes
                            <?php
                            if ($_SESSION['type_id'] <= 2 || ($_SESSION['permisos'][0]->visitantes == 'Activo' && $_SESSION['permisos'][0]->cobertura == 'Full')) {
                            ?>
                                <button type="button" id="btn_crear_visitante" data-bs-toggle="modal" data-bs-target="#crearUsuario" class="btn bg-gradient-primary m-2">Crear Visitante</button>
                            <?php
                            }
                            ?>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_catalogo.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Visitante</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header notiHeader">
                        <h3 class="card-title">Buscar Visitante</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarUsuario" placeholder="Ingrese el nombre, teléfono o lugar de residencia del usuario" class="form-control float-left">
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
    <script>
        $(document).ready(function() {
            $('#selNacionalidad').select2({
                dropdownParent: $('#crearUsuario')
            });
        });
        $(document).ready(function() {
            $('#selMunicipio').select2({
                dropdownParent: $('#crearUsuario')
            });
        });
    </script>
    <!-- /.content-wrapper -->
<?php
    include_once '../Vista/layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
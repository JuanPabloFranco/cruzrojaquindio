<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] >= 2)) {
    include_once '../Vista/layouts/header.php';
    include_once '../Conexion/consulSQL.php';
?>
    <title>Adm | Administrar Visitas</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../Recursos/js/gestion_visitas.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
    <input type="hidden" id="id_sede" value="<?php echo $_SESSION['id_sede']; ?>">
    <input type="hidden" id="cobertura" value="<?php echo $_SESSION['permisos'][0]->cobertura; ?>">
    <input type="hidden" id="fecha_hoy" value="<?php echo date('Y-m-d'); ?>">
    <?php
    if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['id_cargo'] == 1 || $_SESSION['id_cargo'] == 2 || $_SESSION['id_cargo'] == 8)) {
    ?>
        <div class="modal fade" id="editar_visita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header notiHeader">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Visita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form_editar_visita">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="selTipoVisitaEdit">Tipo Visita</label>
                                <select name="" id="selTipoVisitaEdit" class="form-control" style="width: 100%;" onchange="validarTipoVisita(this.value);" required>
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    $sqlServiciosE = "SELECT id, nombre_servicio, valor FROM servicios WHERE estado_servicio='Activo'";
                                    $resServicioE = ejecutarSQL::consultar($sqlServiciosE);
                                    while ($servicioE = mysqli_fetch_array($resServicioE)) {
                                        echo '<option value="' . $servicioE['id'] . '" >' . $servicioE['nombre_servicio'] . '  ($' . $servicioE['valor'] . ')</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="div form-group">
                                <label for="txtFechaInicioVisitaEdit">Fecha Inicio visita</label>
                                <input type="date" class="form-control" placeholder="Fecha inicial de la visita" id="txtFechaInicioVisitaEdit" required>
                            </div>
                            <div class="div form-group" id="divFinVisitaEdit" style="display: none;">
                                <label for="txtFechaFinVisitaEdit">Fecha Fin visita</label>
                                <input type="date" class="form-control" placeholder="Fecha final de la visita" id="txtFechaFinVisitaEdit">
                            </div>
                            <div class="alert alert-success text-center" id="edit" style="display: none;">
                                <span><i class='fas fa-check m-1'> Visita actualizada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="noEdit" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
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

        <div class="modal fade" id="crearVisita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header notiHeader">
                            <h3 class="card-title">Registrar Visita</h3>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form_crear_visita">
                            <div class="card-body">
                                <div class="div form-group">
                                    <label for="selTipoVisita">Tipo Visita</label>
                                    <select name="" id="selTipoVisita" class="form-control" style="width: 100%;" onchange="validarTipoVisita(this.value);" required>
                                        <option value="">Seleccione una opción</option>
                                        <?php
                                        $sqlServicios = "SELECT id, nombre_servicio, valor FROM servicios WHERE estado_servicio='Activo'";
                                        $resServicio = ejecutarSQL::consultar($sqlServicios);
                                        while ($servicio = mysqli_fetch_array($resServicio)) {
                                            echo '<option value="' . $servicio['id'] . '" >' . $servicio['nombre_servicio'] . '  ($' . $servicio['valor'] . ')</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="div form-group">
                                    <label for="txtFechaInicioVisita">Fecha Inicio visita</label>
                                    <input type="date" class="form-control" placeholder="Fecha inicial de la visita" id="txtFechaInicioVisita" required>
                                </div>
                                <div class="div form-group" id="divFinVisita" style="display: none;">
                                    <label for="txtFechaFinVisita">Fecha Fin visita</label>
                                    <input type="date" class="form-control" placeholder="Fecha final de la visita" id="txtFechaFinVisita">
                                </div>
                                <div class="div form-group">
                                    <label for="txtDoc">No. Documento</label>
                                    <input type="text" class="form-control" placeholder="Ingrese el documento de identidad" id="txtDoc" required>
                                </div>
                                <div class="div form-group">
                                    <label for="txtNombreUsuario">Nombre Completo</label>
                                    <input type="text" class="form-control" placeholder="Ingrese el nombre" id="txtNombreUsuario" required>
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
                                            if ($nacionalidad['id'] == 43) {
                                                echo '<option value="' . $nacionalidad['id'] . '" selected>' . $nacionalidad['GENTILICIO_NAC'] . '  (' . $nacionalidad['PAIS_NAC'] . ')</option>';
                                            } else {
                                                echo '<option value="' . $nacionalidad['id'] . '">' . $nacionalidad['GENTILICIO_NAC'] . '  (' . $nacionalidad['PAIS_NAC'] . ')</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="div form-group" id="divMunicipio">
                                    <label for="selmunicipio">Municipio de residencia</label>
                                    <select name="" id="selmunicipio" class="form-control" style="width: 100%;">
                                        <option value="">Seleccione una opción</option>
                                        <?php
                                        $sqlMunicipios = "SELECT M.id, M.nombre AS municipio, D.nombre AS departamento  FROM municipios M JOIN departamentos D ON M.departamento_id=D.id ORDER BY D.nombre ASC";
                                        $resMunicipio = ejecutarSQL::consultar($sqlMunicipios);
                                        while ($municipio = mysqli_fetch_array($resMunicipio)) {
                                            if ($municipio['id'] == 825) {
                                                echo '<option value="' . $municipio['id'] . '" selected>' . $municipio['municipio'] . '  (' . $municipio['departamento'] . ')</option>';
                                            } else {
                                                echo '<option value="' . $municipio['id'] . '">' . $municipio['municipio'] . '  (' . $municipio['departamento'] . ')</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="alert alert-success text-center" id="create" style="display: none;">
                                    <span><i class='fas fa-check m-1'> Visita registrada</i></span>
                                </div>
                                <div class="alert alert-danger text-center" id="noCreate" style="display: none;">
                                    <span><i class='fas fa-times m-1'></i></span>
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
                        <h1>Gestión Visitas
                            <?php
                            if ($_SESSION['type_id'] <= 2 || ($_SESSION['permisos'][0]->visitantes == 'Activo' && $_SESSION['permisos'][0]->cobertura == 'Full')) {
                            ?>
                                <button type="button" id="btn_crear_visita" data-bs-toggle="modal" data-bs-target="#crearVisita" class="btn bg-gradient-primary m-2">Registrar Visita</button>
                            <?php
                            }
                            ?>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_catalogo.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Visitas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header notiHeader">
                        <h3 class="card-title" style="display: flex;">Buscar Visita   <p class='badge badge-warning' id="liBadge"></p>
                        </h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarVisita" placeholder="Ingrese el nombre, teléfono o documento del visitante" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaVisita" class="row d-flex align-items-stretch"></div>
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
                dropdownParent: $('#crearVisita')
            });
        });
        $(document).ready(function() {
            $('#selMunicipio').select2({
                dropdownParent: $('#crearVisita')
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
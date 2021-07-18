<?php
session_start();
if (isset($_SESSION['type_id'])) {
    include_once '../Vista/layouts/header.php';
    include_once '../Conexion/consulSQL.php';
?>

    <title>Crear Reserva</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <script src="../Recursos/js/gestion_reservas.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="fecha_hoy" value="<?php echo date('Y-m-d'); ?>">
    <input type="hidden" id="txtPage" value="create">
    <div class="modal fade" id="crearMedicamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Agregar Medicamento</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_medicamento">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="txtNombreMed">Nombre del medicamento</label>
                                <input type="text" id="txtNombreMed" class="form-control" name="nombre" placeholder="Ingrese el nombre del medicamento" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtIndicaciones">Indicaciones</label>
                                <textarea name="" id="txtIndicaciones" rows="5" placeholder="Ingresa la descripción o forma de medicación" class="form-control"></textarea>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateMed" style="display: none;">
                                <span><i class='fas fa-check m-1'> Medicamento agregado</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateMed" style="display: none;">
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


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear reserva</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Crear reserva</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class='content'>
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-lg-12">
                        <div class="card-body">
                            <label style="padding-top: 12px; font-size: 14px;">Informacion del visitante</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="txtDoc_idItem" placeholder="Documento del visitante" title="Documento del visitante">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="txtNombre_completo" placeholder="Nombre del visitante" title="Nombre del visitante">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="txtTelefono" placeholder="Télefono del visitante" title="Télefono del visitante">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="txtEmail" placeholder="Email del visitante" title="Email del visitante">
                                </div>
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
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
                            </div>
                            <label style="padding-top: 12px; font-size: 14px;">Informacion de la reserva</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="" style="font-size: 12px;">Fecha inicial</label>
                                    <input type="date" class="form-control" name="nombre_madre" id="txtFechaInicio" placeholder="Fecha inicial" title="Fecha inicial">
                                </div>
                                <div class="col-sm-4">
                                    <label for="" style="font-size: 12px;">Fecha final</label>
                                    <input type="date" class="form-control" name="nombre_madre" id="txtFechaFinal" placeholder="Fecha final" title="Fecha final">
                                </div>
                                <div class="col-sm-4">
                                    <label for="" style="font-size: 12px;">Descuento</label>
                                    <select name="" id="selDescuento" class="form-control" style="width: 100%;" onchange="validarNacionalidad(this.value);">                                        
                                        <?php
                                        $sqlDescuentos = "SELECT id, nombre_descuento, descuento FROM descuentos";
                                        $resDescuentos = ejecutarSQL::consultar($sqlDescuentos);
                                        while ($descuento = mysqli_fetch_array($resDescuentos)) {
                                            if ($descuento['id'] == 1) {
                                                echo '<option value="' . $descuento['id'] . '" selected>' . $descuento['nombre_descuento'] . '  ($' . $descuento['descuento'] . ')</option>';
                                            } else {
                                                echo '<option value="' . $descuento['id'] . '">' . $descuento['nombre_descuento'] . '  ($' . $descuento['descuento'] . ')</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <table class="table table-hover table-sm table-responsive table-bordered" style="display: inline-table; justify-content: end;">
                                        <thead class="notiHeader">
                                            <th>#</th>
                                            <th>Servicio</th>
                                            <th>Cantidad</th>
                                            <th>dias/noches</th>
                                            <th>Valor neto</th>
                                            <th>subtotal</th>
                                        </thead>
                                        <tbody id="bodyItems"></tbody>
                                        <tfoot>
                                            <td colspan="4"></td>
                                            <td class="notiHeader"><strong>Total</strong></td>
                                            <td id="tdTotal"></td>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btn_crear_reserva" class="btn bg-gradient-danger m-2">Agregar item</button>
                            <button type="button" id="btn_crear_reserva" class="btn bg-gradient-success m-2">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php
    include_once '../Vista/layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
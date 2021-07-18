<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['permisos'][0]->eventos == 'Activo')) {
    include_once '../Vista/layouts/header.php';
    include_once '../Conexion/consulSQL.php';
?>
    <title id="tituloPage"></title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <input type="hidden" id="txtId_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
    <input type="hidden" id="id_region" value="<?php echo $_SESSION['id_region']; ?>">
    <input type="hidden" id="id_evento" value="<?php echo $_GET['id']; ?>">
    <script src="../Recursos/js/evento.js"></script>
    <div class="modal fade" id="agregarFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Agregar foto a evento</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_agregar_foto">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="txtDescFoto">Descripción</label>
                                <textarea id="txtDescFoto" cols="30" rows="5" placeholder="Ingresa una descripción de la foto" name="descripcion" class="form-control"></textarea>
                            </div>
                            <div class="div form-group">
                                <input type="hidden" name="funcion" value="crear_foto_evento">
                                <input type="hidden" name="id_evento" value="<?php echo $_GET['id']; ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class='fas fa-image' accept="image/*"></i></span>
                                </div>
                                <input type="file" id="txtArchivo" name="archivo" class="form-control">
                            </div>
                            <div class="alert alert-success text-center" id="divCreateFoto" style="display: none;">
                                <span><i class='fas fa-check m-1'> Foto registrada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateFoto" style="display: none;">
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

    <!-- Modal editar foto -->

    <div class="modal fade" id="editar_foto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Editar descripción Foto</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_editar_foto">
                        <div class="card-body">
                            <div class="input-group ml-2">
                                <img style="width: 90%; text-align: center;" id="imgFotoEd">
                                <input type="hidden" name="id" id="txtIdFoto">
                            </div>
                            <div class="div form-group">
                                <label for="txtDescFotoEd">Descripción</label>
                                <textarea id="txtDescFotoEd" cols="30" rows="5" placeholder="Ingresa una descripción de la foto" name="descripcion" class="form-control"></textarea>
                            </div>
                            <div class="alert alert-success text-center" id="divUpdateImg" style="display: none;">
                                <span><i class='fas fa-check m-1'> Imagén Actualizada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoUpdateImg" style="display: none;">
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

    <!-- Modal participante -->

    <div class="modal fade" id="detalle_part" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Participante Evento</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_editar_participante">
                        <div class="card-body">
                            <div class="input-group ml-2">
                                <input type="hidden" name="id" id="txtIdParticipante">
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6><b>Nombre: </b>
                                        <p id="pNombreParticipante"></p>
                                    </h6><br>
                                    <h6><b>Documento: </b>
                                        <p id="pDocumento"></p>
                                    </h6><br>
                                    <h6><b>Télefono: </b>
                                        <p id="pTelParticipante"></p>
                                    </h6><br>
                                    <h6><b>Email: </b>
                                        <p id="pEmailParticipante"></p>
                                    </h6><br>
                                    <h6><b>Tipo de sangre: </b>
                                        <p id="pTipoSParticipante"></p>
                                    </h6><br>
                                </div>
                                <div class="col-sm-6">
                                    <h6><b>Nacionalidad: </b>
                                        <p id="pNacionalidadParticipante"></p>
                                    </h6><br>
                                    <h6><b>Departamento: </b>
                                        <p id="pDeptoParticipante"></p>
                                    </h6><br>
                                    <h6><b>Municipio: </b>
                                        <p id="pmunicipioParticipante"></p>
                                    </h6><br>
                                    <h6><b>EPS: </b>
                                        <p id="pEpseParticipante"></p>
                                    </h6><br>
                                    <h6><b>Fecha de inscripción: </b>
                                        <p id="pFechaInscrParticipante"></p>
                                    </h6><br>
                                </div>
                            </div>
                            <div class="div form-group">
                                <label for="txtDescFotoEd">Estado</label>
                                <select name="estado" class="form-control" id="selEstadoParticipante">
                                    <option value="Confirmado">Confirmado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                            </div>
                            <div class="alert alert-success text-center" id="divUpdatePart" style="display: none;">
                                <span><i class='fas fa-check m-1'> Estado Actualizado</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoUpdatePart" style="display: none;">
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
                        <h1 id="h1Titulo"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="../Vista/adm_eventos.php?modulo=evento">Gestión Eventos</a></li>
                            <li class="breadcrumb-item" id="liTitulo"></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card card-success">
                            <div class="modal-header notiHeader">
                                <h3 class="card-title">Editar evento</h3>
                                <li class="breadcrumb-item" id="liBadge"></li>
                            </div>
                            <div class="card-body pb-0">
                                <form id="form_editar_evento">
                                    <div class="div form-group">
                                        <label for="txtNombreEventoE">Nombre del evento</label>
                                        <input type="text" class="form-control" name="nombre_evento" placeholder="Ingrese el nombre del evento" id="txtNombreEventoE" required>
                                    </div>
                                    <div class="div form-group">
                                        <label for="txtFechaInicialE">Fecha Inicial</label>
                                        <input type="date" class="form-control" name="fecha_inicial" id="txtFechaInicialE" required>
                                    </div>
                                    <div class="div form-group">
                                        <label for="txtFechaFinalE">Fecha Final</label>
                                        <input type="date" class="form-control" name="fecha_final" id="txtFechaFinalE" required>
                                    </div>
                                    <div class="div form-group">
                                        <label for="txtCuposE">Cupos del evento</label>
                                        <input type="number" class="form-control" name="total_cupos" placeholder="Ingrese la cantidad de cupos" id="txtCuposE" required>
                                    </div>
                                    <div class="div form-group">
                                        <label for="txtPrecioE">Precio del evento</label>
                                        <input type="text" class="form-control" name="precio" placeholder="Ingrese el nombre del evento" id="txtPrecioE" required>
                                    </div>
                                    <div class="div form-group">
                                        <label for="txtWpContactoE">Whatsapp de contacto</label>
                                        <input type="text" class="form-control" name="tel_contacto" id="txtWpContactoE" required>
                                    </div>
                                    <div class="div form-group">
                                        <label for="selServicioE">Servicio</label>
                                        <select id="selServicioE" name="id_servicio" class="form-control" required>
                                            <?php
                                            $sqlServ = "SELECT id, nombre_servicio FROM servicios WHERE estado_servicio='Activo'";
                                            $resServ = ejecutarSQL::consultar($sqlServ);
                                            while ($serv = mysqli_fetch_array($resServ)) {
                                                echo '<option value="' . $serv['id'] . '">' . $serv['nombre_servicio'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="div form-group">
                                        <label for="txtDescEvE">Descripción evento</label>
                                        <textarea id="txtDescEvE" cols="30" rows="5" placeholder="Ingresa la descripción del evento" name="descripcion_evento" class="form-control"></textarea>
                                    </div>
                                    <div class="alert alert-success text-center" id="divUpdate" style="display: none;">
                                        <span><i class='fas fa-check m-1'> Evento actualizado</i></span>
                                    </div>
                                    <div class="alert alert-danger text-center" id="divNoUpdate" style="display: none;">
                                        <span><i class='fas fa-times m-1'></i></span>
                                    </div>
                                    <?php
                                    if ($_SESSION['id_cargo'] == 1 || $_SESSION['id_cargo'] == 2 || $_SESSION['id_cargo'] == 8 || $_SESSION['id_cargo'] == 12) {
                                    ?>
                                        <div>
                                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Actualizar</button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                        <div class="card card-success">
                            <div class="modal-header notiHeader">
                                <h3 class="card-title">Cambiar imagen del evento</h3>
                            </div>
                            <div class="card-body text-center">
                                <form id="form_edit_image_evento">
                                    <div class="input-group ml-2">
                                        <img style="width: 90%; text-align: center;" id="imgEvento">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class='fas fa-image' accept="image/*"></i></span>
                                        </div>
                                        <input type="file" id="txtNombImage" name="imagen_evento" class="form-control">
                                    </div>
                                    <div class="alert alert-success text-center" id="divUpdateImg" style="display: none;">
                                        <span><i class='fas fa-check m-1'> Imagén Actualizada</i></span>
                                    </div>
                                    <div class="alert alert-danger text-center" id="divNoUpdateImg" style="display: none;">
                                        <span><i class='fas fa-times m-1'></i></span>
                                    </div>
                                    <div>
                                        <input type="hidden" name="funcion" value="actualizar_imagen">
                                        <?php
                                        if ($_SESSION['id_cargo'] == 1 || $_SESSION['id_cargo'] == 2 || $_SESSION['id_cargo'] == 8 || $_SESSION['id_cargo'] == 12) {
                                        ?>
                                            <div>
                                                <button type="submit" class="btn bg-gradient-primary float-right m-1">Actualizar</button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <input type="hidden" value="editar_imagen" name="funcion">
                                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card card-success">
                            <div class="modal-header notiHeader">
                                <h3 class="card-title">Fotos del evento</h3>
                            </div>
                            <div class="row d-flex align-items-stretch m-1" id="divFotos"></div>
                            <div class="card-footer pb-0">
                                <button type="button" id="btn_agregar_foto" data-bs-toggle="modal" data-bs-target="#agregarFoto" class="btn bg-gradient-primary m-2 float-right">Agregar Foto</button>
                            </div>
                        </div>
                        <div class="card card-success">
                            <div class="modal-header notiHeader">
                                <h3 class="card-title">Participantes del evento</h3>
                                <p class='badge badge-dark' id="pCuposDisponibles"></p>
                            </div>
                            <div >
                                <a href="javascript:imprSelec('divParticipantes')"><img src="../Recursos/img/pdf.png" style="width: 30px" style="height: 30px" title="Imprimir/Generar PDF">Imprimir</a>
                            </div>
                            <div class="card-body" id="divParticipantes">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        function imprSelec(divParticipantes) {
            var ficha = document.getElementById(divParticipantes);
            var ventimp = window.open(' ', 'popimpr');
            ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();
            ventimp.print();
            ventimp.close();
        }
    </script>
    <!-- /.content-wrapper -->
<?php
    include_once '../Vista/layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
<?php
session_start();
if (isset($_SESSION['type_id']) && ($_SESSION['type_id'] <= 2) || ($_SESSION['permisos'][0]->eventos == 'Activo')) {
    include_once '../Vista/layouts/header.php';
    include_once '../Conexion/consulSQL.php';
?>
    <title>Adm | Eventos</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../Recursos/js/eventos.js"></script>
    <input type="hidden" id="txtId_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <input type="hidden" id="id_cargo" value="<?php echo $_SESSION['id_cargo']; ?>">
    <input type="hidden" id="id_sede" value="<?php echo $_SESSION['id_sede']; ?>">    
   
    <div class="modal fade" id="crearEvento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Crear Evento</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_evento">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="txtNombreEvento">Nombre del evento</label>
                                <input type="text" class="form-control" name="nombre_evento" placeholder="Ingrese el nombre del evento" id="txtNombreEvento" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtFechaInicial">Fecha Inicial</label>
                                <input type="date" class="form-control" name="fecha_inicial" id="txtFechaInicial" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtFechaFinal">Fecha Final</label>
                                <input type="date" class="form-control" name="fecha_final" id="txtFechaFinal" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtCupos">Cupos del evento</label>
                                <input type="number" class="form-control" name="total_cupos" placeholder="Ingrese la cantidad de cupos" id="txtCupos" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtPrecio">Precio del evento</label>
                                <input type="text" class="form-control" name="precio" placeholder="Ingrese el nombre del evento" id="txtPrecio" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtWpContacto">Whatsapp de contacto</label>
                                <input type="text" class="form-control" name="tel_contacto" id="txtWpContacto" required>
                            </div>
                            <div class="div form-group">
                                <label for="selServicio">Servicio</label>
                                <select id="selServicio" name="id_servicio" class="form-control" required>
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
                                <label for="txtDescEv">Descripción evento</label>
                                <textarea id="txtDescEv" cols="30" rows="5" placeholder="Ingresa la descripción del evento" name="descripcion_evento" class="form-control"></textarea>
                            </div>
                            <div class="div form-group">
                                <input type="hidden" name="funcion" value="crear_evento">
                                <input type="hidden" name="id_region" value="<?php echo $_SESSION['id_region'] ?>">
                                <input type="hidden" name="id_organizador" value="<?php echo $_SESSION['id_user']; ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class='fas fa-image' accept="image/*"></i></span>
                                </div>
                                <input type="file" id="txtNombImage" name="imagen_evento" class="form-control">
                            </div>
                            <div class="alert alert-success text-center" id="divCreate" style="display: none;">
                                <span><i class='fas fa-check m-1'> Evento registrado</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreate" style="display: none;">
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
    <div class="content-wrapper" id="panelEventos">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestión eventos
                            <button type="button" id="btn_crear_evento" data-bs-toggle="modal" data-bs-target="#crearEvento" class="btn bg-gradient-primary m-2">Crear Evento</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../Vista/adm_panel.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión Eventos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Buscar evento</h3>
                        <div class="input-group">
                            <input type="text" id="TxtBuscarEvento" placeholder="Ingrese nombre o contenido de la descripción del evento" class="form-control float-left">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="busquedaEvento" class="row d-flex align-items-stretch"></div>
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
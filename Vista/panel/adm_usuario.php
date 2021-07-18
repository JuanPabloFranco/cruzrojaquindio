<?php
session_start();
if (isset($_SESSION['type_id'])) {
    include_once '../Vista/layouts/header.php'
?>

    <title>Adm | Voluntario</title>
    <?php
    include_once '../Vista/layouts/nav.php';
    ?>
    <script src="../Recursos/js/usuario2.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['type_id']; ?>">
    <!-- Medicamento -->
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
    <!-- Enfermedad-->
    <div class="modal fade" id="crearEnfermedad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Agregar Enfermedad</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_enfermedad">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="txtNombreEnf">Nombre de la enfermedad</label>
                                <input type="text" id="txtNombreEnf" class="form-control" name="nombre" placeholder="Ingrese el nombre de la enfermedad" required>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateEnf" style="display: none;">
                                <span><i class='fas fa-check m-1'> Enfermedad agregada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateEnf" style="display: none;">
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
    <!-- Alergia -->
    <div class="modal fade" id="crearAlergia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Agregar Alergia</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_alergia">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="selTipoAlergia">Tipo de alergia</label>
                                <select name="tipo_alergia" id="selTipoAlergia" class="form-control">
                                    <option value="Respiratoria">Respiratoria</option>
                                    <option value="Alimento">Alimento</option>
                                    <option value="Medicamento">Medicamento</option>
                                    <option value="Otra">Otra</option>
                                </select>
                            </div>
                            <div class="div form-group">
                                <label for="txtNombreAlergia">Nombre de la alergia</label>
                                <input type="text" id="txtNombreAlergia" class="form-control" name="nombre" placeholder="Ingrese el nombre de la alergia" required>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateAler" style="display: none;">
                                <span><i class='fas fa-check m-1'> Alergia agregada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateAler" style="display: none;">
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
    <!-- Cirugias -->
    <div class="modal fade" id="crearCirugia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Agregar Cirugía</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_cirugia">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="txtNombreCirugia">Nombre de la cirugía</label>
                                <input type="text" id="txtNombreCirugia" class="form-control" name="nombre" placeholder="Ingrese el nombre de la cirugía" required>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateCir" style="display: none;">
                                <span><i class='fas fa-check m-1'> Cirugía agregada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateCir" style="display: none;">
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
    <!-- Lesion -->
    <div class="modal fade" id="crearLesion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Agregar Lesión</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_lesion">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="selTipoLesion">Tipo de lesión</label>
                                <select name="tipo_lesion" id="selTipoLesion" class="form-control">
                                    <option value="Esguince">Esguince</option>
                                    <option value="Luxación">Luxación</option>
                                    <option value="Fractura">Fractura</option>
                                    <option value="Desgarro">Desgarro</option>
                                    <option value="Otra">Otra</option>
                                </select>
                            </div>
                            <div class="div form-group">
                                <label for="txtNombreLesion">Nombre de la Lesión</label>
                                <input type="text" id="txtNombreLesion" class="form-control" name="nombre" placeholder="Ingrese el nombre de la lesión" required>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateLes" style="display: none;">
                                <span><i class='fas fa-check m-1'> Lesión agregada</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateLes" style="display: none;">
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
    <!-- Antecendentes-->
    <div class="modal fade" id="crearAntecedente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Agregar Antecedente</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_antecedente">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="selAntecedente">Ha sufrido de</label>
                                <select name="tipo_lesion" id="selAntecedente" class="form-control">
                                    <option value="RUBEOLA">RUBEOLA</option>
                                    <option value="SARAMPION">SARAMPION</option>
                                    <option value="VARICELA">VARICELA</option>
                                    <option value="PAPERAS">PAPERAS</option>
                                    <option value="TETANO">TETANO</option>
                                    <option value="COVID 19">COVID 19</option>
                                </select>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateAnt" style="display: none;">
                                <span><i class='fas fa-check m-1'> Antecedente agregado</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateAnt" style="display: none;">
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

    <!-- Estudios Academicos -->

    <div class="modal fade" id="crearEstudio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Agregar Estudio Académico</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_estudio">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="selNivel">Nivel</label>
                                <select name="nivel" id="selNivel" class="form-control" required>
                                    <option value="Bachillerato">Bachillerato</option>
                                    <option value="Superior">Superior</option>
                                    <option value="Postgrados">Postgrados</option>
                                </select>
                            </div>
                            <div class="div form-group">
                                <label for="selTipoEstudio">Tipo nivel</label>
                                <select name="tipo_estudio" id="selTipoEstudio" class="form-control" required>

                                </select>
                            </div>
                            <div class="div form-group">
                                <label for="txtTitulo">Título</label>
                                <input type="text" id="txtTitulo" class="form-control" name="nombre" placeholder="Ingrese el nombre del título adquirido" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtInstitucion">Institución</label>
                                <input type="text" id="txtInstitucion" class="form-control" name="institucion   " placeholder="Ingrese el nombre de la institución" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtAñoEstudio">Año</label>
                                <input type="number" value="2000" id="txtAñoEstudio" class="form-control" name="año_estudio" placeholder="Ingrese el año de graduación" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtCiudad">Ciudad</label>
                                <input type="text" id="txtCiudad" class="form-control" name="ciudad_estudio" placeholder="Ingrese el nombre de la ciudad de graduación" required>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateEst" style="display: none;">
                                <span><i class='fas fa-check m-1'> Estudio agregado</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateEst" style="display: none;">
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

    <!-- Otro estudio -->
    <div class="modal fade" id="crearOtroEst" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Agregar otro estudio</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_OEst">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="selTipoOtroEst">Tipo estudio</label>
                                <select name="tipo_lesion" id="selTipoOtroEst" class="form-control">
                                    <option value="Idioma">Idioma</option>
                                    <option value="Curso">Curso</option>
                                    <option value="Diplomado">Diplomado</option>
                                </select>
                            </div>
                            <div class="div form-group">
                                <label for="txtDescrOtroEst">Descripción</label>
                                <textarea name="descr_est" class="form-control" id="txtDescrOtroEst" rows="3"></textarea>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateOtro" style="display: none;">
                                <span><i class='fas fa-check m-1'> Otro estudio agregado</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateOtro" style="display: none;">
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
    <!-- Cursos -->
    <div class="modal fade" id="crearCurso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Agregar Curso</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_curso">
                        <div class="card-body">
                            <div class="div form-group">
                                <label for="txtFechaCurso">Fecha</label>
                                <input type="date" id="txtFechaCurso" class="form-control" name="fecha_curso" placeholder="Ingrese la fecha de graduación del cruso" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtInstitucionCurso">Institución</label>
                                <input type="text" id="txtInstitucionCurso" class="form-control" name="institucion" placeholder="Nombre de la institución capacitadora" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtCapDesc">Descripción</label>
                                <input type="text" id="txtCapDesc" class="form-control" name="descr_cap" placeholder="Descripción del curso o capacitación" required>
                            </div>
                            <div class="div form-group">
                                <label for="txtHoras">Intensidad Horaria</label>
                                <input type="number" value="10" id="txtHoras" class="form-control" name="horas" placeholder="Ingrese el nombre de la ciudad de graduación" required>
                            </div>
                            <div class="alert alert-success text-center" id="divCreateCurso" style="display: none;">
                                <span><i class='fas fa-check m-1'> Curso agregado</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateCurso" style="display: none;">
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
    <!-- Soportes-->
    <div class="modal fade" id="crearSoporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="modal-header notiHeader">
                        <h3 class="card-title">Subir Imagen Soporte</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <form id="form_crear_soporte">
                        <div class="card-body">
                            <div class="div form-group">
                                <input type="hidden" class="form-control" name="id_usuario" value="<?php echo $_SESSION['id_user']; ?>" id="txtId_voluntario" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class='fas fa-image'></i></span>
                                </div>
                                <input type="file" id="txtSoporte" name="soporte" class="form-control" accept="image/*">
                            </div>
                            <div class="div form-group">
                                <label for="selTipoSoporte">Tipo de Soporte</label>
                                <select class="form-control" id="selTipoSoporte" name="tipo_soporte" required>
                                    <option value="Documento de Identidad">Documento de Identidad</option>
                                    <option value="Estudio Acádemico">Estudio Acádemico</option>
                                    <option value="Curso">Curso</option>
                                    <option value="EPS ó Médico">EPS ó Médico</option>
                                </select>
                            </div>
                            <div class="div form-group">
                                <label for="txtNombreArchivo">Nombre del soporte</label>
                                <input type="text" id="txtNombreArchivo" class="form-control" name="nombre_soporte" placeholder="Ingrese el nombre del archivo">
                            </div>
                            <div class="alert alert-success text-center" id="divCreateSoporte" style="display: none;">
                                <span><i class='fas fa-check m-1'> Soporte Subido</i></span>
                            </div>
                            <div class="alert alert-danger text-center" id="divNoCreateSoporte" style="display: none;">
                                <span><i class='fas fa-times m-1'></i></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="funcion" value="crear_soporte">
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
                        <h1>Actualizar datos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Actualizar datos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class='content'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-purple card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#adicional" class="nav-link active" data-bs-toggle='tab'>Información Adicional</a></li>
                                    <li class="nav-item"><a href="#academica" class="nav-link" data-bs-toggle='tab'>Información Académica</a></li>
                                    <li class="nav-item"><a href="#laboral" class="nav-link" data-bs-toggle='tab'>Información Laboral</a></li>
                                    <li class="nav-item"><a href="#medica" class="nav-link" data-bs-toggle='tab'>Información Médica</a></li>
                                    <li class="nav-item"><a href="#cursos" class="nav-link" data-bs-toggle='tab'>Cursos, talleres y más</a></li>
                                    <li class="nav-item"><a href="#soportes" class="nav-link" data-bs-toggle='tab'>Soportes</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="adicional">
                                        <div class="row">
                                            <div class="card col-sm-6  ">
                                                <div class="card-header notiHeader">
                                                    <h5>Información Familiar</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form id="form_crear_inf_fam">
                                                        <div class="card-body">
                                                            <div class="div form-group">
                                                                <label for="txtNombreMadre">Nombre de la madre</label>
                                                                <input type="text" class="form-control" name="nombre_madre" id="txtNombreMadre" required>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtOcupMadre">Ocupación u oficio madre</label>
                                                                <input type="text" class="form-control" name="ocupacion_madre" id="txtOcupMadre" required>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtTelMadre">Télefono madre</label>
                                                                <input type="text" class="form-control" name="tel_madre" id="txtTelMadre" required>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtNombrePadre">Nombre del padre</label>
                                                                <input type="text" class="form-control" name="nombre_padre" id="txtNombrePadre" required>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtOcupPadre">Ocupación u oficio padre</label>
                                                                <input type="text" class="form-control" name="ocupacion_padre" id="txtOcupPadre" required>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtTelPadre">Télefono padre</label>
                                                                <input type="text" class="form-control" name="tel_padre" id="txtTelPadre" required>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtConEmerg">En caso de emergencia llamar a</label>
                                                                <input type="text" class="form-control" name="contacto_emergencia" placeholder="Nombre del contacto de emergencia" id="txtConEmerg" required>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtParentezco">Parentezco</label>
                                                                <input type="text" class="form-control" name="parentezco_emergencia" placeholder="Parentezco del contacto de emergencia" id="txtParentezco" required>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtTelEmerg">Télefono</label>
                                                                <input type="text" class="form-control" name="cel_emergencia" placeholder="Teléfono del contacto de emergencia" id="txtTelEmerg">
                                                            </div>
                                                            <div class="alert alert-success text-center" id="divCreateFam" style="display: none;">
                                                                <span><i class='fas fa-check m-1'> Datos Actualizados</i></span>
                                                            </div>
                                                            <div class="alert alert-danger text-center" id="divNoCreateFam" style="display: none;">
                                                                <span><i class='fas fa-times m-1'></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                            <div class="card col-sm-6 ">
                                                <div class="card-header notiHeader">
                                                    <h5>Información Sociodemográfica</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form id="form_crear_sociodemo">
                                                        <div class="card-body">
                                                            <div class="div form-group">
                                                                <label for="selEstrato">Estrato</label>
                                                                <select name="estrato" id="selEstrato" class="form-control">
                                                                    <option value="0">0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                </select>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="selEstadoCivil">Estado civil</label>
                                                                <select name="estado_civil" id="selEstadoCivil" class="form-control">
                                                                    <option value="Soltero">Soltero</option>
                                                                    <option value="Casado">Casado</option>
                                                                    <option value="Divorciado">Divorciado</option>
                                                                    <option value="Separado/a">Separado/a</option>
                                                                    <option value="Viudo/a">Viudo/a</option>
                                                                    <option value="Unión libre">Unión libre</option>
                                                                    <option value="Otro">Otro</option>
                                                                </select>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="selGrupoEtnico">Grupo Etnico</label>
                                                                <select name="grupo_etnico" id="selGrupoEtnico" class="form-control">
                                                                    <option value="No corresponde">No corresponde</option>
                                                                    <option value="Negro, mulato, afrodescendiente, afrocolombiano">Negro, mulato, afrodescendiente, afrocolombiano</option>
                                                                    <option value="Indígena">Indígena</option>
                                                                    <option value="Raizal">Raizal</option>
                                                                    <option value="Palenquero">Palenquero</option>
                                                                    <option value="Gitano">Gitano</option>
                                                                    <option value="Otro">Otro</option>
                                                                </select>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtPersonas_cargo">Personas a cargo</label>
                                                                <input type="number" value="0" min='0' class="form-control" name="personas_cargo" id="txtPersonas_cargo">
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="selCabeza_familia">Cabeza_familia</label>
                                                                <select name="cabeza_familia" id="selCabeza_familia" class="form-control">
                                                                    <option value="No">No</option>
                                                                    <option value="Si">Si</option>
                                                                </select>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtHijos">Número de hijos</label>
                                                                <input type="number" value="0" min='0' class="form-control" name="hijos" id="txtHijos">
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="selFuma">Fuma</label>
                                                                <select name="fuma" id="selFuma" class="form-control">
                                                                    <option value="No">No</option>
                                                                    <option value="Si">Si</option>
                                                                </select>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtfuma_frecuencia">Frecuencia en que fuma</label>
                                                                <input type="text" class="form-control" name="fuma_frecuencia" id="txtfuma_frecuencia">
                                                            </div>

                                                            <div class="div form-group">
                                                                <label for="selBebidas">Consume bebidas alcoholicas </label>
                                                                <select name="bebidas" id="selBebidas" class="form-control">
                                                                    <option value="No">No</option>
                                                                    <option value="Si">Si</option>
                                                                </select>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtbebe_frecuencia">Frecuencia en que consube bebidas alcoholicas</label>
                                                                <input type="text" class="form-control" name="bebe_frecuencia" id="txtbebe_frecuencia">
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtDeporte">Deportes que práctica</label>
                                                                <input type="text" class="form-control" name="deporte" id="txtDeporte" required>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtDeporte_frecuencia">Frencuencia en que práctica deporte</label>
                                                                <input type="text" class="form-control" name="deporte_frecuencia" id="txtDeporte_frecuencia">
                                                            </div>

                                                            <div class="div form-group">
                                                                <label for="selLicencia">Liencia de conducción</label>
                                                                <select name="licencia_conduccion" id="selLicencia" class="form-control">
                                                                    <option value="No">No</option>
                                                                    <option value="Si">Si</option>
                                                                </select>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtLicencia_descr">Descripción de la licencia</label>
                                                                <input type="text" class="form-control" name="licencia_descr" id="txtLicencia_descr">
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtTallaCamisa">Talla camisa</label>
                                                                <input type="text" class="form-control" name="talla_camisa" id="txtTallaCamisa">
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtTallaPantalon">Talla pantalón</label>
                                                                <input type="text" class="form-control" name="talla_pantalon" id="txtTallaPantalon">
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtTallaCalzado">Talla calzado</label>
                                                                <input type="text" class="form-control" name="talla_calzado" id="txtTallaCalzado">
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="selTVivienda">Tipo de vivienda</label>
                                                                <select name="tipo_vivienda" id="selTVivienda" class="form-control">
                                                                    <option value="En arriendo">En arriendo</option>
                                                                    <option value="Propia">Propia</option>
                                                                    <option value="Familiar">Familiar</option>
                                                                    <option value="Otra">Otra</option>
                                                                </select>
                                                            </div>
                                                            <div class="div form-group">
                                                                <label for="txtAct_tiempo_libre">Actividades de tiempo libre</label>
                                                                <textarea name="act_tiempo_libre" id="txtAct_tiempo_libre" rows="2" class="form-control"></textarea>
                                                            </div>
                                                            <div class="alert alert-success text-center" id="divCreateSoc" style="display: none;">
                                                                <span><i class='fas fa-check m-1'> Datos Actualizados</i></span>
                                                            </div>
                                                            <div class="alert alert-danger text-center" id="divNoCreateSoc" style="display: none;">
                                                                <span><i class='fas fa-times m-1'></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="academica">
                                        <div class="card">
                                            <div class="card-header notiHeader">
                                                <h3>Información Académica</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <div class="card">
                                                                    <div class="card-header notiHeader">
                                                                        <h5>Estudios Acádemicos
                                                                            <button type="button" id="btn_crear_estudio" data-bs-toggle="modal" data-bs-target="#crearEstudio" class="btn bg-gradient-primary float-right" title="Agregar Estudio"><i class="fas fa-plus-circle"></i></button>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="card-body table-responsive">
                                                                        <table class="table table-hover">
                                                                            <thead class="table-light">
                                                                                <tr>
                                                                                    <th scope="col">#</th>
                                                                                    <th scope="col">Nivel</th>
                                                                                    <th scope="col">Tipo</th>
                                                                                    <th scope="col">Título</th>
                                                                                    <th scope="col">Institución</th>
                                                                                    <th scope="col">Año</th>
                                                                                    <th scope="col">Ciudad</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="bodyEstudios"></tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="card">
                                                                    <div class="card-header notiHeader">
                                                                        <h5>Otros Estudios
                                                                            <button type="button" id="btn_crear_soporte" data-bs-toggle="modal" data-bs-target="#crearOtroEst" class="btn bg-gradient-primary float-right" title="Agregar Soporte"><i class="fas fa-plus-circle"></i></button>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="card-body table-responsive">
                                                                        <table class="table table-hover">
                                                                            <thead class="table-light">
                                                                                <tr>
                                                                                    <th scope="col">#</th>
                                                                                    <th scope="col">Tipo</th>
                                                                                    <th scope="col">descripción</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="bodyOtros"></tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                                                </div>
                                            </div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="laboral">
                                        <div class="card col-sm-7">
                                            <div class="card-header notiHeader">
                                                <h3>Información laboral</h3>
                                            </div>
                                            <div class="card-body">
                                                <form id="form_crear_prof">
                                                    <div class="card-body">
                                                        <div class="div form-group">
                                                            <label for="txtProf">Formación Profesional</label>
                                                            <input type="text" class="form-control" name="formacion_prof" id="txtProf">
                                                        </div>
                                                        <div class="div form-group">
                                                            <label for="txtOcupacion">Ocupación u oficio</label>
                                                            <input type="text" class="form-control" name="ocupacion" id="txtOcupacion">
                                                        </div>
                                                        <div class="div form-group">
                                                            <label for="txtEmpresa">Empresa en la que labora</label>
                                                            <input type="text" class="form-control" name="tel_madre" id="txtEmpresa">
                                                        </div>
                                                        <div class="div form-group">
                                                            <label for="txtCargoLaboral">Cargo</label>
                                                            <input type="text" class="form-control" name="cargo_lab" id="txtCargoLaboral">
                                                        </div>
                                                        <div class="div form-group">
                                                            <label for="txtDirLab">Dirección laboral</label>
                                                            <input type="text" class="form-control" name="dir_lab" id="txtDirLab">
                                                        </div>
                                                        <div class="div form-group">
                                                            <label for="txtTelLab">Télefono Laboral</label>
                                                            <input type="text" class="form-control" name="tel_lab" id="txtTelLab" required>
                                                        </div>
                                                        <div class="alert alert-success text-center" id="divCreateLab" style="display: none;">
                                                            <span><i class='fas fa-check m-1'> Datos Actualizados</i></span>
                                                        </div>
                                                        <div class="alert alert-danger text-center" id="divNoCreateLab" style="display: none;">
                                                            <span><i class='fas fa-times m-1'></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="medica">
                                        <div class="card">
                                            <div class="card-header notiHeader">
                                                <h3>Información Médica</h3>
                                            </div>
                                            <div class="card-body">
                                                <form id="form_datos_salud">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" name="eps" id="txtEps" placeholder="EPS a la que esta afiliado">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" name="carnet" id="txtCarnet" placeholder="No. Carnet de la EPS">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select name="tipo_sangre" class="form-control" id="selTipoSangre">
                                                                <option selected="selected" value="">Tipo de sangre</option>
                                                                <option value="O negativo">O negativo</option>
                                                                <option value="O positivo">O positivo</option>
                                                                <option value="A negativo">A negativo</option>
                                                                <option value="A positivo">A positivo</option>
                                                                <option value="B negativo">B negativo</option>
                                                                <option value="B positivo">B positivo</option>
                                                                <option value="AB negativo">AB negativo</option>
                                                                <option value="AB positivo">AB positivo</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" name="arl" id="txtArl" placeholder="Arl">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" name="pension" id="txtPension" placeholder="Fondo de pensiones">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" name="caja_compensacion" id="txtCaja" placeholder="Caja de compensación">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <button type="submit" class="btn bg-gradient-primary float-left">Guardar</button>
                                                            <div class="alert alert-success text-center" id="divCreateSalud" style="display: none;">
                                                                <span><i class='fas fa-check m-1'></i></span>
                                                            </div>
                                                            <div class="alert alert-danger text-center" id="divNoCreateSalud" style="display: none;">
                                                                <span><i class='fas fa-times m-1'></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-footer">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-header notiHeader">
                                                                    <h5>Medicamentos
                                                                        <button type="button" id="btn_crear_medicamento" data-bs-toggle="modal" data-bs-target="#crearMedicamento" class="btn bg-gradient-primary float-right" title="Agregar Medicamento"><i class="fas fa-plus-circle"></i></button>
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body table-responsive">
                                                                    <table class="table table-hover">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Nombre</th>
                                                                                <th scope="col">Indicaciones</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="bodyMedicamento"></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-header notiHeader">
                                                                    <h5>Enfermedades
                                                                        <button type="button" id="btn_crear_enfermedad" data-bs-toggle="modal" data-bs-target="#crearEnfermedad" class="btn bg-gradient-primary float-right" title="Agregar Enfermedad"><i class="fas fa-plus-circle"></i></button>
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body table-responsive">
                                                                    <table class="table table-hover">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Nombre</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="bodyEnfermedad"></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-header notiHeader">
                                                                    <h5>Alergias
                                                                        <button type="button" id="btn_crear_alergia" data-bs-toggle="modal" data-bs-target="#crearAlergia" class="btn bg-gradient-primary float-right" title="Agregar Alergia"><i class="fas fa-plus-circle"></i></button>
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body table-responsive">
                                                                    <table class="table table-hover">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Tipo</th>
                                                                                <th scope="col">Nombre</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="bodyAlergia"></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-header notiHeader">
                                                                    <h5>Cirugías
                                                                        <button type="button" id="btn_crear_cirugia" data-bs-toggle="modal" data-bs-target="#crearCirugia" class="btn bg-gradient-primary float-right" title="Agregar Cirugía"><i class="fas fa-plus-circle"></i></button>
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body table-responsive">
                                                                    <table class="table table-hover">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Nombre</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="bodyCirugia"></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-header notiHeader">
                                                                    <h5>Lesiones
                                                                        <button type="button" id="btn_crear_lesion" data-bs-toggle="modal" data-bs-target="#crearLesion" class="btn bg-gradient-primary float-right" title="Agregar Lesión"><i class="fas fa-plus-circle"></i></button>
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body table-responsive">
                                                                    <table class="table table-hover">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Tipo</th>
                                                                                <th scope="col">Nombre</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="bodyLesion"></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-header notiHeader">
                                                                    <h5>Antecedentes
                                                                        <button type="button" id="btn_crear_antecedente" data-bs-toggle="modal" data-bs-target="#crearAntecedente" class="btn bg-gradient-primary float-right" title="Agregar Antecedente"><i class="fas fa-plus-circle"></i></button>
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body table-responsive">
                                                                    <table class="table table-hover">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Nombre</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="bodyAntecedente"></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="cursos">
                                        <div class="card">
                                            <div class="card-header notiHeader">
                                                <h3>Cursos, talleres y más
                                                    <button type="button" id="btn_crear_curso" data-bs-toggle="modal" data-bs-target="#crearCurso" class="btn bg-gradient-primary float-right" title="Agregar"><i class="fas fa-plus-circle"></i></button>
                                                </h3>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Fecha</th>
                                                            <th scope="col">Institución que capacita</th>
                                                            <th scope="col">Descripción</th>
                                                            <th scope="col">Int horas</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodyCursos"></tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="soportes">
                                        <div class="card col-sm-8">
                                            <div class="card-header notiHeader">
                                                <h3>Soportes
                                                    <button type="button" id="btn_crear_soporte" data-bs-toggle="modal" data-bs-target="#crearSoporte" class="btn bg-gradient-primary float-right" title="Agregar"><i class="fas fa-plus-circle"></i></button>
                                                </h3>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th scope="col-sm-1">#</th>
                                                            <th scope="col-sm-3">Tipo</th>
                                                            <th scope="col-sm-3">Nombre</th>
                                                            <th scope="col-sm-3">Adjunto</th>
                                                            <th scope="col-sm-2">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodySoportes"></tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"></div>
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
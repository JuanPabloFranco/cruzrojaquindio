$(document).ready(function () {
    var funcion = "";
    var id = $('#txtId_usuario').val();
    var cargo = $('#id_cargo').val();
    var tipo_usuario = $('#txtTipoUsuario').val();
    var id_evento = $('#id_evento').val();
    buscar_avatar();
    listarParticipantes();
    cargarEvento();
    buscarFotos();
    function buscar_avatar() {
        funcion = 'buscarAvatar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    function cargarEvento() {
        funcion = 'cargarEvento';
        $.post('../../Controlador/evento_controler.php', { id_evento, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#tituloPage').html(obj.nombre_evento);
            $('#h1Titulo').html(obj.nombre_evento);
            $('#liTitulo').html(obj.nombre_evento);
            $('#txtNombreEventoE').val(String(obj.nombre_evento));
            $('#txtFechaInicialE').val(obj.fecha_inicial);
            $('#txtFechaFinalE').val(obj.fecha_final);
            $('#txtCuposE').val(String(obj.total_cupos));
            $('#txtWpContactoE').val(String(obj.tel_contacto));
            $('#txtPrecioE').val(obj.precio);
            $('#selServicioE').val(obj.id_servicio);
            $('#txtDescEvE').val(obj.descripcion_evento);
            $('#tituloTable').html(obj.nombre_evento);
            if (obj.estado_evento == "Activo") {
                $('#liBadge').html(`<button badgeIdEv="${obj.id}" type="button" class='badgeId badge badge-warning float-right'>Evento ${obj.estado_evento}</button>`);
            } else {
                $('#liBadge').html(`<button badgeIdEv="${obj.id}" type="button" class='badgeId badge badge-danger float-right'>Evento ${obj.estado_evento}</button>`);
            }
            $('#pCuposDisponibles').html("Cupos disponibles: " + obj.cupos_disp);
            $('#imgEvento').attr('src', obj.imagen_evento);
        });
    }

    $(document).on('click', '.badgeId', (e) => {
        const elemento = $(this)[0].activeElement;
        const id = $(elemento).attr('badgeIdEv');
        funcion = 'changeEstadoEvento';
        $.post('../../Controlador/evento_controler.php', { id, funcion }, (response) => {
            cargarEvento();
        });
    });

    $('#form_editar_evento').submit(e => {
        let nombre_evento = $('#txtNombreEventoE').val();
        let fecha_inicial = $('#txtFechaInicialE').val();
        let fecha_final = $('#txtFechaFinalE').val();
        let total_cupos = $('#txtCuposE').val();
        let tel_contacto = $('#txtWpContactoE').val();
        let precio = $('#txtPrecioE').val();
        let id_servicio = $('#selServicioE').val();
        let descripcion_evento = $('#txtDescEvE').val();
        funcion = "editar_evento";
        $.post('../../Controlador/evento_controler.php', { id_evento, funcion, nombre_evento, fecha_inicial, fecha_final, total_cupos, tel_contacto, precio, id_servicio, descripcion_evento }, (response) => {
            if (response == 'update') {
                $('#divUpdate').hide('slow');
                $('#divUpdate').show(1000);
                $('#divUpdate').hide(3000);
                cargarEvento();
            } else {
                $('#divNoUpdate').hide('slow');
                $('#divNoUpdate').show(1000);
                $('#divNoUpdate').hide(3000);
                $('#divNoUpdate').html(response);
            }
        });
        e.preventDefault();
    });

    $("#form_edit_image_evento").on("submit", function (e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_edit_image_evento"));
        formData.append("dato", "valor");
        var peticion = $('#form_edit_image_evento').attr('action');
        $.ajax({
            url: '../../Controlador/evento_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            if (response == 'update') {
                $('#divUpdateImg').hide('slow');
                $('#divUpdateImg').show(1000);
                $('#divUpdateImg').hide(2000);
                cargarEvento();
            } else {
                $('#divNoUpdateImg').hide('slow');
                $('#divNoUpdateImg').show(1000);
                $('#divNoUpdateImg').hide(2000);
                $('#divNoUpdateImg').html(response);
            }
        });
    });

    $("#form_agregar_foto").on("submit", function (e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_agregar_foto"));
        formData.append("dato", "valor");
        var peticion = $('#form_agregar_foto').attr('action');
        $.ajax({
            url: '../../Controlador/fotoEvento_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            if (response == 'creado') {
                $('#divCreateFoto').hide('slow');
                $('#divCreateFoto').show(1000);
                $('#divCreateFoto').hide(2000);
                $('#form_agregar_foto').trigger('reset');
                buscarFotos();
            } else {
                $('#divNoCreateFoto').hide('slow');
                $('#divNoCreateFoto').show(1000);
                $('#divNoCreateFoto').hide(2000);
                $('#divNoCreateFoto').html(response);
            }
        });
    });

    function buscarFotos(consulta) {
        var funcion = "buscar_foto_evento";
        $.post('../../Controlador/fotoEvento_controler.php', { consulta, funcion, id_evento }, (response) => {
            const objetos = JSON.parse(response);
            let template = "";
            num = 0;
            objetos.forEach(obj => {
                num += 1;
                template += `<div fotoId="${obj.id}"  class="col-12 col-sm-4  align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header border-bottom-0 notiHeader">
                        Foto ${num}`;
                if (tipo_usuario <= 2 || (cargo == 1 || cargo == 7 || cargo == 8 || cargo == 12)) {
                    template += `<button class='editFoto btn btn-sm btn-info mr-1 float-right' style='display: flex;' type='button' data-bs-toggle="modal" data-bs-target="#editar_foto">
                            <i class="fas fa-pencil-alt mr-1"></i>
                        </button>
                        <button class='delFoto btn btn-sm btn-danger mr-1 float-right' style='display: flex;' type='button' >
                        <i class="fas fa-trash mr-1"></i>
                    </button>`;
                }
                template += `</div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">`;
                template += `<img class='' src='${obj.archivo}' style='width: 100%'>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"></span>${obj.descripcion}</li>                        
                        </ul>`;
                template += ` </div>
                    </div>
                  </div>`;
                template += `</div></div>`;
            });
            $('#divFotos').html(template);
        });
    }

    $(document).on('click', '.editFoto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('fotoId');
        $('#txtIdFoto').val(id);
        funcion = 'cargarFotoEvento';
        $.post('../../Controlador/fotoEvento_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtDescFotoEd').val(obj.descripcion);
            $('#imgFotoEd').attr('src', obj.archivo);
        });
    });

    $('#form_editar_foto').submit(e => {
        e.preventDefault();
        let id = $('#txtIdFoto').val();
        let descripcion = $('#txtDescFotoEd').val();
        funcion = 'editar_foto_evento';
        $.post('../../Controlador/fotoEvento_controler.php', { funcion, id, descripcion }, (response) => {
            if (response == 'update') {
                $('#divUpdateImg').hide('slow');
                $('#divUpdateImg').show(1000);
                $('#divUpdateImg').hide(2000);
                buscarFotos();
            } else {
                $('#divNoUpdateImg').hide('slow');
                $('#divNoUpdateImg').show(1000);
                $('#divNoUpdateImg').hide(2000);
                $('#divNoUpdateImg').html(response);
            }
        });
    });

    $(document).on('click', '.delFoto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar la foto del evento?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('fotoId');
                funcion = 'eliminarFoto';
                $.post('../../Controlador/fotoEvento_controler.php', { id, funcion }, (response) => {
                    Swal.fire('Eliminado!', '', 'success');
                    buscarFotos();
                });
            } else if (result.isDenied) {
                Swal.fire('No se ha eliminado la foto del evento', '', 'info')
            }
        })
    });

    function listarParticipantes(consulta) {
        var funcion = "listar_participantes";
        $.post('../../Controlador/participante_evento_controler.php', { consulta, funcion, id_evento }, (response) => {
            const objetos = JSON.parse(response);
            num = 0;
            let template = `<table class="table table-bordered table-responsive center-all">
                                <thead>
                                    <tr class='notiHeader'><th colspan='7'><p id='tituloTable'></p></th></tr>               
                                    <tr class='notiHeader'>
                                        <th>#</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>`;

            objetos.forEach(objeto => {
                num += 1;
                template += `       <tr idPart=${objeto.id}>
                                        <td>${num}</td>`;
                if (objeto.estado == 'Inscrito') {
                    template += `                   <td ><small class="badge badge-warning">${objeto.estado}</small></td>`;
                } else {
                    template += `                   <td ><small class="badge badge-success">${objeto.estado}</small></td>`;
                }
                template += `                       <td>${objeto.fecha_inscripcion}</td>
                                        <td>${objeto.nombre_participante}</td>
                                        <td>${objeto.telefono}</td>
                                        <td>${objeto.email}</td>
                                        <td>
                                            <button class='editParticipante btn btn-sm btn-primary mr-1' type='button' title='Editar del participante' data-bs-toggle="modal" data-bs-target="#detalle_part">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                    </tr>`;

            });
            template += `       </tbody>
                            </table>`;
            $('#divParticipantes').html(template);
        });
    }

    $(document).on('click', '.editParticipante', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id_participante = $(elemento).attr('idPart');
        funcion = 'cargar_participante';
        $('#txtIdParticipante').val(id_participante);
        $.post('../../Controlador/participante_evento_controler.php', { id_participante, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#pNombreParticipante').html(obj.nombre_participante);
            $('#pDocumento').html(obj.tipo_doc + " " + obj.documento);
            $('#pTelParticipante').html(obj.telefono);
            $('#pEmailParticipante').html(obj.email);
            $('#pTipoSParticipante').html(obj.tipo_sangre);
            $('#pNacionalidadParticipante').html(obj.nacionalidad);
            $('#pDeptoParticipante').html(obj.departamento_res);
            $('#pmunicipioParticipante').html(obj.municipio_res);
            $('#pEpseParticipante').html(obj.eps);
            $('#pFechaInscrParticipante').html(obj.fecha_inscripcion);
            $('#selEstadoParticipante').val(obj.estado);
        });
    });

    $('#form_editar_participante').submit(e => {
        e.preventDefault();
        let id = $('#txtIdParticipante').val();
        let estado = $('#selEstadoParticipante').val();
        funcion = 'changeEstadoParticipante';
        $.post('../../Controlador/participante_evento_controler.php', { funcion, id, estado, id_evento }, (response) => {
            if (response == 'update') {
                $('#divUpdatePart').hide('slow');
                $('#divUpdatePart').show(1000);
                $('#divUpdatePart').hide(2000);
                listarParticipantes();
                cargarEvento();
            } else {
                $('#divNoUpdatePart').hide('slow');
                $('#divNoUpdatePart').show(1000);
                $('#divNoUpdatePart').hide(2000);
                $('#divNoUpdatePart').html(response);
            }
        });
    });
});
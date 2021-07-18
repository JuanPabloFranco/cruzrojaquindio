
$(document).ready(function () {
    var tipo_usuario = $('#tipo_usuario').val();
    var id_cargo = $('#id_cargo').val();
    var id_usuario = $('#id_usuario').val();
    var fecha_hoy = $('#fecha_hoy').val();

    var funcion = "";
    var id_usuario = $('#id_usuario').val();
    var edit = false;
    buscarGestionVisitas();
    buscar_avatar(id_usuario);


    function buscar_avatar(id) {
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $(document).on('keyup', '#TxtBuscarVisita', function () {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarGestionVisitas(consulta);
        } else {
            buscarGestionVisitas();
        }
    });

    function buscarGestionVisitas(consulta) {
        var funcion = "buscar_visitas";
        $.post('../Controlador/visita_controler.php', { consulta, funcion }, (response) => {
            const usuarios = JSON.parse(response);
            let num = 0;
            let template = `<div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered table-responsive center-all">
                                            <thead class='notiHeader'>                  
                                                <tr>
                                                    <th>#</th>                                                    
                                                    <th>Estado</th>
                                                    <th >Tipo</th>
                                                    <th >Fecha</th>
                                                    <th >Visitante</th>
                                                    <th >Residencia</th>
                                                    <th >Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;

            usuarios.forEach(usuario => {
                fecha = usuario.fecha_inicio;
                if (usuario.fecha_fin != '0000-00-00') {
                    fecha = usuario.fecha_inicio + " - " + usuario.fecha_fin;
                }
                num += 1;
                template += `                   <tr idVisita=${usuario.id}>
                                                    <td >${num}</td>
                                                    <td >${usuario.estado_visita}</td>
                                                    <td >${usuario.nombre_servicio}</td>
                                                    <td >${fecha}</td>
                                                    <td >${usuario.nombre_completo}</td>
                                                    <td >${usuario.municipio}(${usuario.departamento})</td>
                                                    <td >
                                                        <button class='editVisita btn btn-sm btn-primary mr-1' type='button' data-bs-toggle="modal" data-bs-target="#ModalEditar_visita">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button class='actServicio btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                                                            <i class="fas fa-trash"></i>
                                                        </button>`;
                template += ` </td>
                                                </tr>`;

            });
            template += `                   </tbody>
                                        </table>
                                    </div> 
                                </div>`;
            $('#busquedaVisita').html(template);
            contar_visitas();
        });
    }

    $('#form_crear_visita').submit(e => {
        let id_servicio = $('#selTipoVisita').val();
        let fecha_inicio = $('#txtFechaInicioVisita').val();
        let fecha_fin = $('#txtFechaFinVisita').val();
        let nombre = $('#txtNombreUsuario').val();
        let cel_usuario = $('#txtTelefono').val();
        let documento = $('#txtDoc').val();
        let email_usuario = $('#txtEmail').val();
        let id_cargo = 1;
        let id_tipo_usuario = 4;
        let id_nacionalidad = $('#selNacionalidad').val();
        let id_municipio = "";
        if (id_nacionalidad == 43) {
            id_municipio = $('#selmunicipio').val();
        } else {
            id_municipio = 1127;
        }
        if (id_servicio == 1) {
            fecha_fin = '0000-00-00';
        }
        if (fecha_hoy >= '01-01-2020' && fecha_hoy >= fecha_inicio) {
            if (id_servicio == 1 && fecha_fin == '0000-00-00') {
                funcion = 'crear_visita';
                $.post('../Controlador/visita_controler.php', { id_usuario, funcion, nombre, documento, cel_usuario, email_usuario, id_nacionalidad, id_municipio, id_cargo, id_tipo_usuario, id_servicio, fecha_inicio, fecha_fin }, (response) => {
                    console.log(response);
                    if (response == 'creado') {
                        $('#create').hide('slow');
                        $('#create').show(1000);
                        $('#create').hide(2000);
                        $('#form_crear_visita').trigger('reset');
                        buscarGestionVisitas();
                    } else {
                        $('#noCreate').hide('slow');
                        $('#noCreate').show(1000);
                        $('#noCreate').hide(2000);
                        $('#noCreate').html(response);
                    }
                });
            } else {
                if (fecha_fin >= fecha_inicio) {
                    funcion = 'crear_visita';
                    $.post('../Controlador/visita_controler.php', { id_usuario, funcion, nombre, documento, cel_usuario, email_usuario, id_nacionalidad, id_municipio, id_cargo, id_tipo_usuario, id_servicio, fecha_inicio, fecha_fin }, (response) => {
                        console.log(response);
                        if (response == 'creado') {
                            $('#create').hide('slow');
                            $('#create').show(1000);
                            $('#create').hide(2000);
                            $('#form_crear_visitante').trigger('reset');
                            buscarGestionVisitas();
                        } else {
                            $('#noCreate').hide('slow');
                            $('#noCreate').show(1000);
                            $('#noCreate').hide(2000);
                            $('#noCreate').html(response);
                        }
                    });
                } else {
                    $('#noCreate').html("La fecha final no puede ser menor a la inicial");
                    $('#noCreate').hide('slow');
                    $('#noCreate').show(1000);
                    $('#noCreate').hide(2000);
                }
            }
        } else {
            $('#noCreate').html("La fecha inicial ingresada no es correcta");
            $('#noCreate').hide('slow');
            $('#noCreate').show(1000);
            $('#noCreate').hide(2000);
        }
        e.preventDefault();
    });

    $(document).on('click', '.editVisita', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('idVisita');
        $('#txtIdCc').val(id);
        funcion = 'cargarCc';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtDoc2').val(obj.doc_id);
            $('#txtRegionEd').val(obj.id_region);
            $('#selCargoEd').val(obj.id_cargo);
        });
    });


    $('#form_update_cc').submit(e => {
        let id = $('#txtIdCc').val();
        funcion = 'update_cc';
        let doc = $('#txtDoc2').val();
        let id_sede = $('#txtSedeEd').val();
        let id_cargo = $('#selCargoEd').val();
        $.post('../Controlador/usuario_controler.php', { id, funcion, doc, id_sede, id_cargo }, (response) => {
            if (response == 'update') {
                buscarGestionVisitas();
                $('#updateCc').hide('slow');
                $('#updateCc').show(1000);
                $('#updateCc').hide(2000);
                $('#form_update_cc').trigger('reset');
                buscarGestionVisitas();
            } else {
                $('#noUpdateCc').hide('slow');
                $('#noUpdateCc').show(1000);
                $('#noUpdateCc').html(response);
            }
        });
        e.preventDefault();
    });

    function contar_visitas() {
        funcion = 'contar_visitas';
        $.post('../Controlador/visita_controler.php', { funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#liBadge').html(obj.cantidad+" visitas registradas");
        });
    }

    $("#txtDoc").blur(function () {
        funcion = 'buscar_visitante';
        let documento = $('#txtDoc').val();
        $.post('../Controlador/usuario_controler.php', { documento, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#txtNombreUsuario').val(usuario.nombre_completo);
            $('#txtTelefono').val(usuario.cel_usuario);
            $('#txtEmail').val(usuario.email_usuario);
            $('#selNacionalidad').val(usuario.id_nacionalidad);
            $('#selmunicipio').val(usuario.id_municipio);
        });
    });

});

function validarNacionalidad(valor) {
    if (valor == 43) {
        document.getElementById('divMunicipio').style.display = '';
    } else {
        document.getElementById('divMunicipio').style.display = 'none';
    }
}

function validarTipoVisita(tipo) {
    if (tipo <= 1) {
        document.getElementById('divFinVisita').style.display = 'none';
    } else {
        document.getElementById('divFinVisita').style.display = '';
    }
}

$(document).ready(function () {
    var id_usuario = $('#id_usuario').val();
    var fecha_hoy = $('#fecha_hoy').val();
    var page = $('#txtPage').val();

    var funcion = "";
    var id_usuario = $('#id_usuario').val();
    buscar_avatar(id_usuario);
    if(page=="adm"){
        buscarGestionReservas();
    }
    if(page=="create"){
        listar_items();
    }


    function buscar_avatar(id) {
        funcion = 'buscarAvatar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $(document).on('keyup', '#TxtBuscarReserva', function () {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarGestionReservas(consulta);
        } else {
            buscarGestionReservas();
        }
    });

    function buscarGestionReservas(consulta) {
        var funcion = "buscar";
        $.post('../../Controlador/reserva_controler.php', { consulta, funcion }, (response) => {
            const reservas = JSON.parse(response);
            let num = 0;
            let template = `<div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered table-responsive center-all">
                                            <thead class='notiHeader'>                  
                                                <tr>
                                                    <th>#</th>                                                    
                                                    <th>Estado</th>
                                                    <th >Fecha</th>
                                                    <th >Visitante</th>
                                                    <th >Descuento</th>
                                                    <th >Valor Descuento</th>
                                                    <th >Total</th>
                                                    <th >Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;

            reservas.forEach(reserva => {
                fecha = reserva.fecha_inicio;
                if (reserva.fecha_fin != '0000-00-00') {
                    fecha = reserva.fecha_inicio + " - " + reserva.fecha_fin;
                }
                num += 1;
                template += `                   <tr idReserva=${reserva.id}>
                                                    <td >${num}</td>
                                                    <td >${reserva.estado_visita}</td>
                                                    <td >${fecha}</td>
                                                    <td >${reserva.nombre_completo} / ${reserva.doc_id}</td>
                                                    <td >${reserva.nombre_descuento}</td>
                                                    <td >${reserva.descuento}</td>
                                                    <td >${reserva.valor_total}</td>
                                                    <td >
                                                        <button class='editReserva btn btn-sm btn-primary mr-1' type='button' data-bs-toggle="modal" data-bs-target="#ModalEditar_reserva">
                                                            <i class="fas fa-pencil-alt"></i>
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

    $('#form_crear_reserva').submit(e => {
        //campos reserva
        let fecha_inicio = $('#txtFechaInicio').val();
        let fecha_fin = $('#txtFechaFinal').val();
        let id_visitante = $('#txtId_visitante').val();
        let id_descuento = $('#selDescuento').val();
        // campos visitante
        let doc_id = $('#txtDoc_id').val();
        let nombre_completo = $('#txtNombre_completo').val();
        let cel_usuario = $('#txtTelefono').val();
        let email_usuario = $('#txtEmail').val();
        let id_nacionalidad = $('#selNacionalidad').val();
        let id_municipio = $('#selMunicipio').val();
        
        if (fecha_hoy >= '01-01-2021' && fecha_hoy >= fecha_inicio) {
            if (fecha_fin >= fecha_inicio) {
                funcion = 'crear';
                $.post('../../Controlador/reserva_controler.php', { funcion, fecha_inicio, fecha_fin, id_visitante, id_descuento, doc_id, nombre_completo, cel_usuario, email_usuario, id_nacionalidad, id_municipio }, (response) => {
                    console.log(response);
                    if (response == 'creado') {
                        $(location).attr('href', '../../Vista/adm_reservas.php?modulo=reservas');
                    } else {
                        $('#noCreate').hide('slow');
                        $('#noCreate').show(1000);
                        $('#noCreate').hide(2000);
                        $('#noCreate').html(response);
                    }
                });
            } else {
                $('#noCreate').html("La fecha final debe ser mayor o igual que la inicial");
                $('#noCreate').hide('slow');
                $('#noCreate').show(1000);
                $('#noCreate').hide(2000);
            }
        } else {
            $('#noCreate').html("La fecha inicial ingresada no es correcta");
            $('#noCreate').hide('slow');
            $('#noCreate').show(1000);
            $('#noCreate').hide(2000);
        }
        e.preventDefault();
    });

    $(document).on('click', '.editReserva', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('idReserva');
        $('#txtIdReserva').val(id);
        funcion = 'cargar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtDoc2').val(obj.estado_reserva);
            $('#txtRegionEd').val(obj.fecha_inicio);
            $('#selCargoEd').val(obj.fecha_fin);
            $('#selCargoEd').val(obj.id_descuento);
            $('#selCargoEd').val(obj.nombre_completo);
            $('#selCargoEd').val(obj.doc_id);
        });
    });


    $('#form_update_cc').submit(e => {
        let id = $('#txtIdCc').val();
        funcion = 'update_cc';
        let doc = $('#txtDoc2').val();
        let id_sede = $('#txtSedeEd').val();
        let id_cargo = $('#selCargoEd').val();
        $.post('../../Controlador/usuario_controler.php', { id, funcion, doc, id_sede, id_cargo }, (response) => {
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
        $.post('../../Controlador/visita_controler.php', { funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#liBadge').html(obj.cantidad + " visitas registradas");
        });
    }

    $("#txtDoc").blur(function () {
        funcion = 'buscar_visitante';
        let documento = $('#txtDoc').val();
        $.post('../../Controlador/usuario_controler.php', { documento, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#txtNombreUsuario').val(usuario.nombre_completo);
            $('#txtTelefono').val(usuario.cel_usuario);
            $('#txtEmail').val(usuario.email_usuario);
            $('#selNacionalidad').val(usuario.id_nacionalidad);
            $('#selmunicipio').val(usuario.id_municipio);
        });
    });

    $("#txtDoc_idItem").blur(function () {
        funcion = 'buscar_visitante';
        let documento = $('#txtDoc_idItem').val();
        $.post('../../Controlador/usuario_controler.php', { documento, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#txtNombre_completo').val(usuario.nombre_completo);
            $('#txtTelefono').val(usuario.cel_usuario);
            $('#txtEmail').val(usuario.email_usuario);
            $('#selNacionalidad').val(usuario.id_nacionalidad);
            $('#selmunicipio').val(usuario.id_municipio);
        });
    });

    function listar_items() {
        var funcion = "listar_items";
        $.post('../../Controlador/reserva_controler.php', { funcion }, (response) => {
            const items = JSON.parse(response);
            let num = 0;
            let template = ``;

            items.forEach(item => {
                num += 1;
                template += `<tr idItem=${item.id}>
                                <td >${num}</td>
                                <td >${item.estado_visita}</td>
                                <td >${item.estado_visita}</td>
                                <td >${item.estado_visita}</td>
                                <td >${item.estado_visita}</td>
                                <td >${item.estado_visita}</td>
                                <td >
                                    <button class='editItem btn btn-sm btn-primary mr-1' type='button' data-bs-toggle="modal" data-bs-target="#ModalEditar_reserva">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>`;
                template += `   </td>
                            </tr>`;

            });
            $('#bodyItems').html(template);
            contar_visitas();
        });
    }

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
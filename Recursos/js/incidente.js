$(document).ready(function () {
    var funcion = "";
    var tipo_usuario = $('#txtTipoUsuario').val();
    var id_region = $('#txtId_region').val();
    var id_cargo = $('#txtId_cargo').val();
    var id = $('#txtId_usuario').val();
    buscar_avatar();
    buscarIncidentes();

    function buscar_avatar() {
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $('#form_crear_incidente').submit(e => {
        let fecha_creacion = $('#txtFechaCreacion').val();
        let fecha = $('#txtFecha').val();
        let hora = $('#txtHora').val();
        let evento = $('#txtEvento').val();
        let tipo = $('#txtTipo').val();
        let municipio = $('#txtMunicipio').val();
        let departamento = $('#txtDepartamento').val();
        let direccion = $('#txtDireccion').val();
        let cant_personal = $('#txtCantPersonal').val();
        let personal = $('#txtPersonal').val();
        let afectado = $('#txtAfectado').val();
        let heridos = $('#txtHeridos').val();
        let desaparecidos = $('#txtDesaparecidos').val();
        let muertos = $('#txtMuertos').val();
        let lesionados = $('#txtLesionados').val();
        let traslado = $('#txtTraslado').val();
        let quien_traslado = $('#txtQuienTraslado').val();
        let viviendas_averiadas = $('#txtVivAveriadas').val();
        let viviendas_destruidas = $('#txtVivDestruidas').val();
        let familias_afectadas = $('#txtFamAfectadas').val();
        let otros = $('#txtOtros').val();
        let observaciones = $('#txtObservaciones').val();
        funcion = 'crear_incidente';
        $.post('../Controlador/incidente_controler.php', {
            funcion, id, id_region, fecha_creacion, fecha, hora, evento, tipo, departamento, municipio, direccion, cant_personal, personal,
            afectado, heridos, desaparecidos, muertos, lesionados, traslado, quien_traslado, viviendas_averiadas, viviendas_destruidas, familias_afectadas, otros, observaciones
        }, (response) => {
            if (response == 'creado') {
                $('#divCreate').hide('slow');
                $('#divCreate').show(1000);
                $('#divCreate').hide(2000);
                buscarIncidentes();
            } else {
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(2000);
                $('#divNoCreate').html(response);
            }
        });
        e.preventDefault();
    });

    $(document).on('keyup', '#TxtBuscarIncidente', function () {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarIncidentes(consulta);
        } else {
            buscarIncidentes();
        }
    });

    function buscarIncidentes(consulta) {
        var funcion = "buscarIncidentes";
        $.post('../Controlador/incidente_controler.php', { consulta, funcion, id_cargo, id_region }, (response) => {
            const objetos = JSON.parse(response);
            if (objetos.length > 0) {
                num = 0;
                let template = `<table class="table table-bordered table-responsive center-all" style="width: 100%;">
                                                <thead>                  
                                                    <tr class='notiHeader'>
                                                        <th style="width: 5px">#</th>
                                                        <th >Estado</th>
                                                        <th >Región</th>
                                                        <th >Fecha y Hora</th>
                                                        <th >Evento</th>
                                                        <th >Tipo</th>
                                                        <th >Departamento</th>
                                                        <th >Municipio</th>
                                                        <th >Dirección</th>
                                                        <th >Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>`;
                objetos.forEach(objeto => {
                    num += 1;
                    template += `                   <tr idIncidente=${objeto.id}>
                                                        <td style="width: 5px">${num}</td>`;
                    if (objeto.estado == 'Nuevo') {
                        template += `                   <td ><small class="badge badge-warning">${objeto.estado}</small></td>`;
                    } else {
                        template += `                   <td ><small class="badge badge-success">${objeto.estado}</small></td>`;
                    }
                    template += `                       <td >${objeto.nombre_region}</td>
                                                        <td >${objeto.fecha} ${objeto.hora}</td>
                                                        <td >${objeto.evento}</td>
                                                        <td >${objeto.tipo}</td>
                                                        <td >${objeto.departamento}</td>
                                                        <td >${objeto.municipio}</td>
                                                        <td >${objeto.direccion}</td>`;

                    if ((id_cargo >= 2 && id_cargo <= 7) || tipo_usuario != 3) {
                        template += `                       <td>
                                                                <button class='editIncidente btn btn-sm btn-primary mr-1' type='button' data-bs-toggle="modal" data-bs-target="#updateIncidente" title'Editar'>
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </button>
                                                                <button class='verIncidente btn btn-sm btn-info mr-1' type='button' data-bs-toggle="modal" data-bs-target="#viewIncidente" title='Detalle'>
                                                                    <i class="fas fa-eye"></i>
                                                                </button>`;
                        if (objeto.estado != 'Verificado') {
                            template += `                            <button class='changeState btn btn-sm btn-success mr-1' type='button' title='Verificar'>
                                                                    <i class="fas fa-thumbs-up"></i>
                                                                </button>`;
                        }
                    } else {
                        template += `<td><button class='verIncidente btn btn-sm btn-info mr-1' type='button' data-bs-toggle="modal" data-bs-target="#viewIncidente">
                            <i class="fas fa-eye"></i>
                        </button>`;
                    }
                    template += `                   <a href='../Vista/incidente_pdf.php?id=${objeto.id}&hoja=carta' target='_blank'><button class='btn btn-sm btn-warning ml-1' type='button' title='Exportar'>
                                                        <i class="fas fa-file-pdf"></i></button></a>
                                                        </td>
                                                    </tr>`;
                });
                template += `                   </tbody>
                                            </table>`;
                $('#busquedaIncidente').html(template);
            }

        });
    }

    $(document).on('click', '.editIncidente', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idIncidente');
        $('#txtIdIncidente').val(id);
        funcion = 'cargarIncidente';
        $.post('../Controlador/incidente_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtFecha2').val(obj.fecha);
            $('#txtHora2').val(obj.hora);
            $('#txtEvento2').val(obj.evento);
            $('#txtTipo2').val(obj.tipo);
            $('#txtDepartamento2').val(obj.departamento);
            $('#txtMunicipio2').val(obj.municipio);
            $('#txtDireccion2').val(obj.direccion);
            $('#txtCantPersonal2').val(obj.cant_personal);
            $('#txtPersonal2').val(obj.personal);
            $('#txtAfectado2').val(obj.afectado);
            $('#txtHeridos2').val(obj.heridos);
            $('#txtDesaparecidos2').val(obj.desaparecidos);
            $('#txtMuertos2').val(obj.muertos);
            $('#txtLesionados2').val(obj.lesionados);
            $('#txtTraslado2').val(obj.traslado);
            $('#txtQuienTraslado2').val(obj.quien_traslado);
            $('#txtVivAveriadas2').val(obj.viviendas_averiadas);
            $('#txtVivDestruidas2').val(obj.viviendas_destruidas);
            $('#txtFamAfectadas2').val(obj.familias_afectadas);
            $('#txtOtros2').val(obj.otros);
            $('#txtObservaciones3').val(obj.observaciones);
        });
    });

    $(document).on('click', '.verIncidente', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idIncidente');
        $('#txtIdIncidente').val(id);
        funcion = 'cargarIncidente';
        $.post('../Controlador/incidente_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#i_voluntario').html(obj.nombre_voluntario);
            $('#i_region').html(obj.nombre_region);
            $('#i_estado').html(obj.estado);
            $('#i_fecha_creacion').html(obj.fecha_creacion);
            $('#i_fecha').html('<i class="far fa-fw fa-calendar"></i> ' + obj.fecha);
            $('#i_hora').html('<i class="far fa-fw fa-clock"></i> ' + obj.hora);
            $('#i_evento').html(obj.evento);
            $('#i_tipo').html(obj.tipo);
            $('#i_departamento').html('<i class="fas fa-fw fa-map-marker "></i>' + obj.departamento);
            $('#i_municipio').html('<i class="fas fa-fw fa-map-marker "></i>' + obj.municipio);
            $('#i_direccion').html('<i class="fas fa-fw fa-route"></i>' + obj.direccion);
            $('#i_cant_personal').html(obj.cant_personal);
            $('#i_personal').html(obj.personal);
            $('#i_afectado').html(obj.afectado);
            $('#i_heridos').html(obj.heridos);
            $('#i_desaparecidos').html(obj.desaparecidos);
            $('#i_muertos').html(obj.muertos);
            $('#i_lesionados').html(obj.lesionados);
            $('#i_traslado').html(obj.traslado);
            $('#i_quien_traslada').html(obj.quien_traslado);
            $('#i_viv_averiadas').html(obj.viviendas_averiadas);
            $('#i_viv_destruidas').html(obj.viviendas_destruidas);
            $('#i_fam_afectadas').html(obj.familias_afectadas);
            $('#i_otros').html(obj.otros);
            $('#i_observaciones').html(obj.observaciones);
        });
    });

    $(document).on('click', '.changeState', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea cambiar a "Verificado" el incidente?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Verificar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idIncidente');
                funcion = 'cambiar_estado';
                $.post('../Controlador/incidente_controler.php', { id, funcion }, (response) => {
                    console.log(response)
                    if(response=='change'){
                        Swal.fire('Incidente verificado!', '', 'success');
                        buscarIncidentes();
                    }else{
                        Swal.fire('Error al cambiar el estado del incidente', '', 'error');
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('No se ha cambiado el estado', '', 'info')
            }
        })
    });

    $('#form_editar_incidente').submit(e => {
        let id = $('#txtIdIncidente').val();
        let fecha = $('#txtFecha2').val();
        let hora = $('#txtHora2').val();
        let evento = $('#txtEvento2').val();
        let tipo = $('#txtTipo2').val();
        let departamento = $('#txtDepartamento2').val();
        let municipio = $('#txtMunicipio2').val();
        let direccion = $('#txtDireccion2').val();
        let cant_personal = $('#txtCantPersonal2').val();
        let personal = $('#txtPersonal2').val();
        let afectado = $('#txtAfectado2').val();
        let heridos = $('#txtHeridos2').val();
        let desaparecidos = $('#txtDesaparecidos2').val();
        let muertos = $('#txtMuertos2').val();
        let lesionados = $('#txtLesionados2').val();
        let traslado = $('#txtTraslado2').val();
        let quien_traslado = $('#txtQuienTraslado2').val();
        let viviendas_averiadas = $('#txtVivAveriadas2').val();
        let viviendas_destruidas = $('#txtVivDestruidas2').val();
        let familias_afectadas = $('#txtFamAfectadas2').val();
        let otros = $('#txtOtros2').val();
        let observaciones = $('#txtObservaciones2').val();
        funcion = 'editar_incidente';
        $.post('../Controlador/incidente_controler.php', {
            funcion, id, fecha, hora, evento, tipo, departamento, municipio, direccion, cant_personal, personal,
            afectado, heridos, desaparecidos, muertos, lesionados, traslado, quien_traslado, viviendas_averiadas, viviendas_destruidas, familias_afectadas, otros, observaciones
        }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarIncidentes();
            } else {
                $('#noUpdateObj').hide('slow');
                $('#noUpdateObj').show(1000);
                $('#noUpdateObj').hide(2000);
                $('#noUpdateObj').html(response);
            }
        });
        e.preventDefault();
    });
});
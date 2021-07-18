$(document).ready(function() {
    var funcion = "";
    var tipo_usuario = $('#txtTipoUsuario').val();
    var cargo = $('#id_cargo').val();
    var id_region = $('#id_region').val();
    buscar_avatar();
    buscarSolicitudes();

    function buscar_avatar() {
        var id = $('#id_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $('#form_crear_soporte').submit(e => {
        e.preventDefault();
        var id_voluntario = $('#id_usuario').val();
        let descripcion = $('#txtDescSoporte').val();
        funcion = 'crear_soporte';
        $.post('../Controlador/soporte_controler.php', { funcion, id_voluntario, descripcion }, (response) => {
            if (response == 'creado') {
                $('#divCreate').hide('slow');
                $('#divCreate').show(1000);
                $('#divCreate').hide(2000);
                $('#form_crear_soporte').trigger('reset');
                buscarSolicitudes();
            } else {
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(2000);
                $('#divNoCreate').html(response);
            }
        });
    });

    $(document).on('keyup', '#TxtBuscarSolicitud', function() {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarSolicitudes(consulta);
        } else {
            buscarSolicitudes();
        }
    });

    function buscarSolicitudes(consulta) {
        var funcion = "buscar_solicitud";
        var id_voluntario = $('#id_usuario').val();
        $.post('../Controlador/soporte_controler.php', { consulta, funcion, id_voluntario, tipo_usuario }, (response) => {
            const objetos = JSON.parse(response);
            let template = `<div class="col-md-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table class="table table-bordered center-all">
                                            <thead notiHeader> 
                                                <tr>
                                                    <th>Detalle</th> 
                                                    <th>Estado</th>
                                                    <th>Fecha</th>
                                                    <th>Nombre Voluntario</th>
                                                    <th>Descripción</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
            objetos.forEach(objeto => {
                template += `                   <tr idSoporte=${objeto.id}>
                                                    <td style="width: 2px">
                                                    <a href='../Vista/soporte_pdf.php?id=${objeto.id}&hoja=carta' target='_blank'><button class='btn btn-sm btn-info ml-1' type='button' title='Exportar'>
                                                        <i class="fas fa-file-pdf"></i> PDF
                                                    </button></a>
                                                    </td>
                                                    <td style="width: 8px">${objeto.estado_soporte}</td>
                                                    <td style="width: 8px">${objeto.fecha_registro}</td>
                                                    <td style="width: 20px">${objeto.nombre_completo} / ${objeto.nombre_region}</td>
                                                    <td style="width: 20px">${objeto.descripcion_soporte}</td>
                                                    <td style="width: 10px">   
                                                        <button class='upComentario btn btn-sm btn-primary mr-1' title='Agregar Comentario' type='button' data-bs-toggle="modal" data-bs-target="#crear_respuesta">
                                                            <i class="fas fa-comments"></i>
                                                        </button>`;
                if (tipo_usuario == 1) {
                    template += `<button class='changeEstado btn btn-sm btn-success mr-1' title='Cambiar Estado' type='button' data-bs-toggle="modal" data-bs-target="#cambiar_estado">
                        <i class="fas fa-sign-out-alt"></i>
                            </button`;
                } else {
                    template += `<button class='upImg btn btn-sm btn-warning mr-1' title='Agregar Imagén' type='button' data-bs-toggle="modal" data-bs-target="#agregarSoporte">
                    <i class="fas fa-image"></i>
                </button>`;
                }

                template += `</td>
                                  </tr>`;
            });

            template += `</tbody>
                        </table>
                    </div> 
                </div>`;
            $('#busquedaSoporte').html(template);
        });
    }

    $(document).on('click', '.upImg', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idSoporte');
        $('#txtIdSoporteImg').val(id);
    });

    $(document).on('click', '.upComentario', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idSoporte');
        $('#txtIdSoporte').val(id);
    });



    $(document).on('click', '.changeEstado', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idSoporte');
        $('#txtIdEstadoSop').val(id);
    });

    $('#form_crear_comentario').submit(e => {
        e.preventDefault();
        let id_voluntario = $('#txtId_vol_respuesta').val();
        let comentario = $('#txtResSoporte').val();
        let id_soporte = $('#txtIdSoporte').val();
        funcion = 'crear_comentario';
        $.post('../Controlador/soporte_controler.php', { funcion, id_soporte, id_voluntario, comentario }, (response) => {
            if (response == 'update') {
                $('#divCreateRes').hide('slow');
                $('#divCreateRes').show(1000);
                $('#divCreateRes').hide(2000);
                $('#form_crear_comentario').trigger('reset');
                buscarSolicitudes();
            } else {
                $('#divNoCreateRes').hide('slow');
                $('#divNoCreateRes').show(1000);
                $('#divNoCreateRes').hide(2000);
                $('#divNoCreateRes').html(response);
            }
        });
    });

    $('#form_img_soporte').submit(e => {
        let formData = new FormData($('#form_img_soporte')[0]);
        $.ajax({
            url: '../Controlador/soporte_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function(response) {
            if (response == 'update') {
                $('#updateSoporte').hide('slow');
                $('#updateSoporte').show(1000);
                $('#updateSoporte').hide(2000);
                $('#form_img_soporte').trigger('reset');
                buscarSolicitudes();
            } else {
                $('#noUpdateSoporte').hide('slow');
                $('#noUpdateSoporte').show(1000);
                $('#noUpdateSoporte').hide(2000);
                $('#noUpdateSoporte').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_estado_soporte').submit(e => {
        e.preventDefault();
        let id_soporte = $('#txtIdEstadoSop').val();
        let estado = $('#selEstado').val();
        funcion = 'cambiar_estado';
        $.post('../Controlador/soporte_controler.php', { funcion, id_soporte, estado }, (response) => {
            if (response == 'update') {
                $('#updateEstado').hide('slow');
                $('#updateEstado').show(1000);
                $('#updateEstado').hide(2000);
                $('#form_estado_soporte').trigger('reset');
                buscarSolicitudes();
                funcion = 'contar_soporte';
                $.post('../Controlador/soporte_controler.php', { funcion }, (response) => {
                    const obj = JSON.parse(response);
                    $('#spanContacto').text(obj.cantidad);
                });
            } else {
                $('#noUpdateEstado').hide('slow');
                $('#noUpdateEstado').show(1000);
                $('#noUpdateEstado').hide(2000);
                $('#noUpdateEstado').html(response);
            }
        });
    });
});
$(document).ready(function () {
    var funcion = "";
    var id_sede = $('#id_sede').val();
    buscar_avatar();
    buscarMsj();

    function buscar_avatar() {
        var id = $('#id_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $('#selRegionMsjContacto').change(e => {
        let id = $('#selRegionMsjContacto').val();
        if (id != 0) {
            funcion = 'listaContactanos';
            $.post('Controlador/region_controler.php', { id, funcion }, (response) => {
                const region = JSON.parse(response);
                $('#PDireccion').html(String(region.direccion_region) + "<br>" + String(region.ciudad_region));
                $('#PTelefono').html(String(region.tel_region));
                $('#PEmail').html(String(region.email));
                $('#PWp').html(String(region.wp_region));
            });
        }
        e.preventDefault();
    });

    $('#formMsjContacto').submit(e => {
        if ($('#selRegionMsjContacto').val() != 0) {
            let id_region = $('#selRegionMsjContacto').val();
            let nombre = $('#txtNombre').val();
            let email = $('#txtEmail').val();
            let asunto = $('#txtAsunto').val();
            let msj = $('#txtMsj').val();
            funcion = 'crear_mensaje';
            $.post('Controlador/msjContacto_controler.php', { funcion, id_region, nombre, email, asunto, msj }, (response) => {
                if (response == 'creado') {
                    $('#create').hide('slow');
                    $('#create').show(1000);
                    $('#create').hide(2000);
                    $('#formMsjContacto').trigger('reset');
                } else {
                    $('#msjError').html(response);
                    $('#noCreate').hide('slow');
                    $('#noCreate').show(1000);
                    $('#noCreate').hide(2000);
                }
            })
        } else {
            $('#msjError').html("Elija una región antes de enviar");
            $('#noCreate').hide('slow');
            $('#noCreate').show(1000);
            $('#noCreate').hide(2000);
        }
        e.preventDefault();
    });

    $(document).on('keyup', '#TxtBuscarRegion', function () {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarMsj(consulta);
        } else {
            buscarMsj();
        }
    });

    function buscarMsj(consulta) {
        var funcion = "buscar_msj";
        $.post('../Controlador/msjContacto_controler.php', { consulta, funcion, id_sede }, (response) => {
            const objetos = JSON.parse(response);
            let template = "";
            objetos.forEach(obj => {
                template += `
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">`;
                if (obj.estado_msj == 'Nuevo') {
                    template += `
                    <div msjid="${obj.id}" class="info-box mb-3 bg-warning">                                         
                        <div>
                            <h6 class='badge badge-warning small'>${obj.fecha}</h6>                   
                            <span class="info-box-icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    `;
                }
                if (obj.estado_msj == 'Visto') {
                    template += `
                        <div msjid="${obj.id}" class="info-box mb-3 bg-info">                    
                            <div>
                                <h6 class='badge badge-info small'>${obj.fecha}</h6>                   
                                <span class="info-box-icon">
                                    <i class="fas fa-envelope-open"></i>
                                </span>
                            </div>`;
                }

                if (obj.estado_msj == 'Respondido') {
                    template += `
                        <div msjid="${obj.id}" class="info-box mb-3 bg-success">                    
                            <div>
                                <h6 class='badge badge-success small'>${obj.fecha}</h6>                   
                                <span class="info-box-icon">
                                    <i class="fas fa-reply"></i>
                                </span>
                            </div>`;
                }
                template += `
                        <div class="info-box-content">
                            <span class="info-box-text">${obj.nombre} </span>
                            <span class="info-box-text small" style='font-size: 9px;'>Email: ${obj.email}</span>
                            <span class="info-box-text small" style='font-size: 11px;'>Asunto: ${obj.asunto}</span>                  
                        </div>`;
                if (obj.estado_msj == 'Nuevo') {
                    template += `<button class='msj btn btn-sm btn-warning mr-1' type='button' data-bs-toggle="modal" data-bs-target="#ver_msj">
                            <i class="fas fa-envelope-open-text mr-1"></i>
                                </button>`;
                }
                if (obj.estado_msj == 'Visto') {
                    template += `<button class='msj btn btn-sm btn-info mr-1' type='button' data-bs-toggle="modal" data-bs-target="#ver_msj">
                            <i class="fas fa-envelope-open-text mr-1"></i>
                                </button>`;
                }
                if (obj.estado_msj == 'Respondido') {
                    template += `<button class='msj btn btn-sm btn-success mr-1' type='button' data-bs-toggle="modal" data-bs-target="#ver_msj">
                            <i class="fas fa-envelope-open-text mr-1"></i>
                                </button>`;
                }
                template += `<!-- /.info-box-content -->                    
                    </div>
                </div>`;
            });            
            $('#busquedaMsj').html(template);
        });
    }

    $(document).on('click', '.msj', (e) => {
        const elemento = $(this)[0].activeElement.parentElement;
        const id = $(elemento).attr('msjid');
        funcion = 'cargarMsj';
        $.post('../Controlador/msjContacto_controler.php', { id, funcion }, (response) => {
            const objetos = JSON.parse(response);
            $('#spanNombre').html(objetos.nombre);
            $('#pFechaMsj').html("<b>Fecha:</b> " + objetos.fecha);
            $('#pAsuntoMsj').html("<b>Asunto:</b> " + objetos.asunto);
            $('#divMsj').html(objetos.mensaje);
            $('#idMsjVisto').val(objetos.id);
            if (objetos.estado_msj == "Nuevo") {
                $("#divBtn").html('<button class="visto btn btn-sm btn-info mr-1" type="button"><i class="fas fa-eye mr-1"></i>Visto</button>');
            }
            if (objetos.estado_msj == "Visto") {
                $("#divBtn").html('<button class="respon btn btn-sm btn-success mr-1" type="button"><i class="fas fa-reply mr-1"></i>Respondido</button>');
            }
        });
    });

    $(document).on('click', '.visto', (e) => {
        let id = $('#idMsjVisto').val();
        funcion = 'changeVisto';
        $.post('../Controlador/msjContacto_controler.php', { funcion, id }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarMsj();
            } else {
                $('#noUpdateObj').hide('slow');
                $('#noUpdateObj').show(1000);
                $('#noUpdateObj').hide(2000);
                $('#noUpdateObj').html(response);
            }
        });
        e.preventDefault();
    });

    $(document).on('click', '.respon', (e) => {
        let id = $('#idMsjVisto').val();
        funcion = 'changeRes';
        $.post('../Controlador/msjContacto_controler.php', { funcion, id }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarMsj();
            } else {
                $('#noUpdateObj').hide('slow');
                $('#noUpdateObj').show(1000);
                $('#noUpdateObj').hide(2000);
                $('#noUpdateObj').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_editar_msj').submit(e => {
        let id = $('#txtId_regionEd').val();
        let nombre = $('#txtNombreReg2').val();
        let ciudad = $('#txtCiudadReg2').val();
        funcion = 'editar_region';
        $.post('../Controlador/msjContacto_controler.php', { funcion, id, nombre, ciudad, direccion, telefono, email, wp, nit, fb, instagram, twitter, youtube }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarMsj();
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
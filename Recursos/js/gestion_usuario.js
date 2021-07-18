$(document).ready(function() {
    var tipo_usuario = $('#tipo_usuario').val();
    var id_sede = $('#id_sede').val();
    var id_cargo = $('#id_cargo').val();
    if (tipo_usuario == 3) {
        $('#btn_crear_usuario').hide();
    }
    var funcion = "";
    var id_usuario = $('#id_usuario').val();
    var edit = false;
    buscarGestionUsuarios();
    buscar_avatar(id_usuario);

    function buscar_avatar(id) {
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $(document).on('keyup', '#TxtBuscarUsuario', function() {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarGestionUsuarios(consulta);
        } else {
            buscarGestionUsuarios();
        }
    });

    function buscarGestionUsuarios(consulta) {
        
        var funcion = "buscar_gestion_usuario";
        $.post('../Controlador/usuario_controler.php', { consulta, funcion, id_cargo, id_sede, tipo_usuario }, (response) => {
            const usuarios = JSON.parse(response);
            let template = "";
            usuarios.forEach(usuario => {
                template += `<div usuarioId="${usuario.id}" estadoU="${usuario.estado}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header text-muted border-bottom-0">`;
                if (usuario.tipo_usuario == 1) {
                    template += `<h1 class="badge badge-dark">${usuario.nombre_tipo}</h1>`;
                }
                if (usuario.tipo_usuario == 2) {
                    template += `<h1 class='badge badge-warning'>${usuario.nombre_tipo}</h1>`;
                }
                if (usuario.tipo_usuario == 3) {
                    template += `<h1 class='badge badge-info'>${usuario.nombre_tipo}</h1>`;
                }
                if (usuario.estado == "Activo") {
                    template += `<h1 class="badge badge-success ml-1">${usuario.estado}</h1>`;
                } else {
                    template += `<h1 class="badge badge-danger ml-1">${usuario.estado}</h1>`;
                }
                template += `</div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-8">
                        <h2 class="lead"><b>${usuario.nombre_completo}</b></h2>
                        <p class="text-muted text-sm"><b>Sobre mi: </b> ${usuario.inf_voluntario} </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad: ${usuario.edad} años</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dirección: ${usuario.res_usuario}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono #: ${usuario.tel_voluntario}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Email: ${usuario.email_voluntario}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-marker-alt"></i></span> Región: ${usuario.nombre_region}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-sitemap"></i></span> Cargo: ${usuario.nombre_cargo}</li>
                        </ul>`;
                if (usuario.cel_voluntario != null && usuario.cel_voluntario != '') {
                    template += `<a href="https://api.whatsapp.com/send?phone=+57${usuario.cel_voluntario}&amp;text=Hola, me interesaría obtener información" target="_blank">
                                    <img src="../Recursos/img/whatsapp_icon.png" alt="" width="30px">
                                </a>`;
                }
                if (usuario.facebook != null && usuario.facebook != '') {
                    template += `<a href="${usuario.facebook}" target="_blank">
                                    <img src="../Recursos/img/facebook_icon.png" alt="" width="30px">
                                </a>`;
                }
                if (usuario.instagram != null && usuario.instagram != '') {
                    template += `<a href="${usuario.instagram}" target="_blank">
                                    <img src="../Recursos/img/instagram_icon.png" alt="" width="30px">
                                </a>`;
                }
                if (usuario.twitter != null && usuario.twitter != '') {
                    template += `<a href="${usuario.twitter}" target="_blank">
                                    <img src="../Recursos/img/twitter_icon.png" alt="" width="30px">
                                </a>`;
                }

                template += `</div>
                      <div class="col-4 text-center">
                        <img src="${usuario.avatar}" alt="" class="img-circle img-fluid" style='width: 80%'>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">`;
                if (id_usuario != usuario.id) {
                    if (tipo_usuario <= 2) {
                        if (tipo_usuario == 1) {
                            if (usuario.tipo_usuario == 3) {
                                template += `<button class='ascender btn btn-sm btn-primary' type='button' data-bs-toggle="modal" data-bs-target="#confirmar_resp" title='Ascender'>
                                <i class="fas fa-sort-amount-up mr-1"></i> 
                            </button>`;
                            }
                            if (usuario.tipo_usuario == 2) {
                                template += `<button class='descender btn btn-sm btn-secondary' type='button' data-bs-toggle="modal" data-bs-target="#confirmar_resp" title='Descender'>
                                <i class="fas fa-sort-amount-down mr-1"></i> 
                            </button>`;
                            }
                        }
                        if (usuario.tipo_usuario != 1) {
                            if (usuario.estado == "Activo") {
                                template += `<button class='activacion btn btn-sm btn-danger ml-1' type='button' data-bs-toggle="modal" data-bs-target="#confirmar_resp" title='Inactivar'>
                                <i class="fas fa-window-close ml-1"></i>
                            </button>`;
                            } else {
                                template += `<button class='activacion btn btn-sm btn-success ml-1' type='button' data-bs-toggle="modal" data-bs-target="#confirmar_resp" title='Activar'>
                                <i class="fas fa-window-close ml-1"></i>
                            </button>`;
                            }
                        }
                    }
                    if (tipo_usuario <= 2 || (id_cargo == 1 || id_cargo == 8)) {
                        template += `<button class='editcc btn btn-sm btn-secondary ml-1' type='button' data-bs-toggle="modal" data-bs-target="#editar_cc" title='Editar'>
                        <i class="fas fa-pencil-alt ml-1"></i>
                        </button>
                        <button class='login btn btn-sm btn-info ml-1' type='button' data-bs-toggle="modal" data-bs-target="#confirmar_resp" title='Restablecer login'>
                            <i class="fas fa-key ml-1"></i>
                        </button>`;
                    }
                }
                if ((id_cargo != 1) || (tipo_usuario <= 2)) {
                    template += `<a href='../Vista/hv_pdf.php?id=${usuario.id}&hoja=carta' target='_blank'><button class='btn btn-sm btn-warning ml-1' type='button' title='Exportar'>
                        <i class="fas fa-file-pdf"></i> PDF
                    </button></a>`;
                }
                template += `</div>
                  </div>
                </div>
              </div>`;
            });
            $('#busquedaUsuario').html(template);
        });
    }

    $('#form_crear_usuario').submit(e => {
        let nombre = $('#txtNombreUsuario').val();
        let documento = $('#txtDoc').val();
        let id_cargo = $('#selCargo').val();
        let id_sede = $('#txtSede').val();
        funcion = 'crear_usuario';
        $.post('../Controlador/usuario_controler.php', { id_usuario, funcion, nombre, documento, id_cargo, id_sede }, (response) => {
            if (response == 'agregado') {
                $('#create').hide('slow');
                $('#create').show(1000);
                $('#create').hide(2000);
                $('#form_crear_usuario').trigger('reset');
                buscarGestionUsuarios();
            } else {
                $('#noCreate').hide('slow');
                $('#noCreate').show(1000);
                $('#noCreate').hide(2000);
                $('#noCreate').html(response);
            }
        });
        e.preventDefault();
    });
    $(document).on('click', '.ascender', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId');
        funcion = "ascender";
        $('#txtId_userConfirm').val(id);
        $('#txtFuncionConfirm').val(funcion);
    });
    $(document).on('click', '.descender', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId');
        funcion = "descender";
        $('#txtId_userConfirm').val(id);
        $('#txtFuncionConfirm').val(funcion);
    });
    $(document).on('click', '.activacion', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId');
        const estado = $(elemento).attr('estadoU');
        funcion = "activacion";
        $('#txtId_userConfirm').val(id);
        $('#txtFuncionConfirm').val(funcion);
        $('#txtEstadoConfirm').val(estado);
    });
    $(document).on('click', '.login', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId');
        funcion = "restablecer_login";
        $('#txtId_userConfirm').val(id);
        $('#txtFuncionConfirm').val(funcion);
    });
    $(document).on('click', '.editcc', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId');
        $('#txtIdCc').val(id);
        funcion = 'cargarCc';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtDoc2').val(obj.doc_id);
            $('#txtRegionEd').val(obj.id_region);
            $('#selCargoEd').val(obj.id_cargo);
        });
    });
    $('#form_confirmar_user').submit(e => {
        let id = $('#txtId_userConfirm').val();
        funcion = $('#txtFuncionConfirm').val();
        let pass = $('#txtPass').val();
        let estado = $('#txtEstadoConfirm').val();
        $.post('../Controlador/usuario_controler.php', { id, funcion, pass, estado }, (response) => {
            if (response == 'ascendido' || response == 'descendido' || response == 'actualizado' || response == 'exito') {
                buscarGestionUsuarios();
                $('#updateAsc').hide('slow');
                $('#updateAsc').show(1000);
                $('#updateAsc').hide(2000);
                $('#form_confirmar_user').trigger('reset');
                buscarGestionUsuarios();
            } else {
                $('#noUpdateAsc').hide('slow');
                $('#noUpdateAsc').show(1000);
                $('#noUpdateAsc').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_update_cc').submit(e => {
        let id = $('#txtIdCc').val();
        funcion = 'update_cc';
        let doc = $('#txtDoc2').val();
        let id_sede = $('#txtSedeEd').val();
        let id_cargo = $('#selCargoEd').val();
        $.post('../Controlador/usuario_controler.php', { id, funcion, doc, id_sede, id_cargo }, (response) => {
            if (response == 'update') {
                buscarGestionUsuarios();
                $('#updateCc').hide('slow');
                $('#updateCc').show(1000);
                $('#updateCc').hide(2000);
                $('#form_update_cc').trigger('reset');
                buscarGestionUsuarios();
            } else {
                $('#noUpdateCc').hide('slow');
                $('#noUpdateCc').show(1000);
                $('#noUpdateCc').html(response);
            }
        });
        e.preventDefault();
    });

});
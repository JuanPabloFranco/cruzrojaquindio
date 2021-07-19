$(document).ready(function() {
    var funcion = "";
    var tipo_usuario = $('#txtTipoUsuario').val();
    buscar_avatar();
    buscarSedes();

    function buscar_avatar() {
        var id = $('#id_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $('#form_crear_sede').submit(e => {
        e.preventDefault();
        let nombre = $('#txtNombreSede').val();
        let ciudad = $('#txtCiudadSede').val();
        let direccion = $('#txtDirSede').val();
        let telefono = $('#txtTelSede').val();
        let email = $('#txtEmailSede').val();
        let wp = $('#txtWpSede').val();
        let nit = $('#txtNitSede').val();
        let fb = $('#txtFbSede').val();
        let instagram = $('#txtInstagramSede').val();
        let twitter = $('#txtTwitterSede').val();
        let youtube = $('#txtYoutubeSede').val();
        funcion = 'crear_sede';
        $.post('../../Controlador/sede_controler.php', { funcion, nombre, ciudad, direccion, telefono, email, wp, nit, fb, instagram, twitter, youtube }, (response) => {
            if (response == 'creada') {
                $('#divCreate').hide('slow');
                $('#divCreate').show(1000);
                $('#divCreate').hide(2000);
                $('#form_crear_region').trigger('reset');
                buscarSedes();
            } else {
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(2000);
                $('#divNoCreate').html(response);
            }
        });

    });

    $(document).on('keyup', '#TxtBuscarSede', function() {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarSedes(consulta);
        } else {
            buscarSedes();
        }
    });

    function buscarSedes(consulta) {
        var funcion = "buscar_sedes";
        $.post('../../Controlador/sede_controler.php', { consulta, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = "";
            objetos.forEach(obj => {
                template += `<div sedeId="${obj.id}"  class="col-12 col-sm-6 col-md-3  align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header border-bottom-0 notiHeader">
                        <h2 class="lead"><b>${obj.nombre_sede}</b></h2>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">`;
                if (obj.estado_sede == 'Activo') {
                    template += `<h1 class='badge badge-warning'>${obj.estado_sede}</h1>`;
                } else {
                    template += `<h1 class='badge badge-danger'>${obj.estado_sede}</h1>`;
                }
                template += `<p class="text-muted text-sm"><b>Nit: </b> ${obj.nit} </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-city"></i></span> Ciudad: ${obj.ciudad_sede}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-directions"></i></span> Dirección: ${obj.direccion_sede}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono: ${obj.tel_sede}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: ${obj.email}</li>
                        </ul>`;
                if (obj.wp_sede != null && obj.wp_sede != '') {
                    template += `<a href="https://api.whatsapp.com/send?phone=+57${obj.wp_sede}&amp;text=Hola, me interesaría obtener información" target="_blank">
                            <img src="../../Recursos/img/whatsapp_icon.png" alt="" width="30px">
                        </a>`;
                }
                if (obj.facebook != null && obj.facebook != '') {
                    template += `<a href="${obj.facebook}" target="_blank">
                            <img src="../../Recursos/img/facebook_icon.png" alt="" width="30px">
                        </a>`;
                }
                if (obj.instagram != null && obj.instagram != '') {
                    template += `<a href="${obj.instagram}" target="_blank">
                            <img src="../../Recursos/img/instagram_icon.png" alt="" width="30px">
                        </a>`;
                }
                if (obj.twitter != null && obj.twitter != '') {
                    template += `<a href="${obj.twitter}" target="_blank">
                            <img src="../../Recursos/img/twitter_icon.png" alt="" width="30px">
                        </a>`;
                }
                if (obj.youtube != null && obj.youtube != '') {
                    template += `<a href="${obj.youtube}" target="_blank">
                            <img src="../../Recursos/img/youtube_icon.png" alt="" width="30px">
                        </a>`;
                }
                template += ` </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">`;
                if (tipo_usuario <= 2) {
                    if (obj.estado_sede == 'Activo') {
                        template += `<button class='actSede btn btn-sm btn-danger mr-1' type='button'>
                            <i class="fas fa-pencil mr-1"></i>Inactivar
                        </button>`;
                    } else {
                        template += `<button class='actSede btn btn-sm btn-warning mr-1' type='button'>
                            <i class="fas fa-pencil mr-1"></i>Activar
                        </button>`;
                    }
                    template += `<button class='editSede btn btn-sm btn-info mr-1' type='button' data-bs-toggle="modal" data-bs-target="#editar_region">
                            <i class="fas fa-pencil mr-1"></i>Editar
                        </button>`;
                }
                template += `</div>
                  </div>
                </div>
              </div>`;
            });
            $('#busquedaSede').html(template);
        });
    }


    $(document).on('click', '.editSede', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('sedeId');
        $('#txtId_sedeEd').val(id);
        funcion = 'cargarSede';
        $.post('../../Controlador/sede_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtNombreSede2').val(obj.nombre_sede);
            $('#txtCiudadSede2').val(obj.ciudad_sede);
            $('#txtDirSede2').val(obj.direccion_sede);
            $('#txtTelSede2').val(obj.tel_sede);
            $('#txtEmailSede2').val(obj.email);
            $('#txtWpSede2').val(obj.wp_sede);
            $('#txtNitSede2').val(obj.nit);
            $('#txtFbSede2').val(obj.facebook);
            $('#txtInstagramSede2').val(obj.instagram);
            $('#txtTwitterSede2').val(obj.twitter);
            $('#txtYoutubeSede2').val(obj.youtube);
        });
    });

    $(document).on('click', '.actSede', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('sedeId');
        funcion = 'changeEstadoSede';
        $.post('../../Controlador/sede_controler.php', { id, funcion }, (response) => {
            buscarSedes();
        });
    });

    $('#form_editar_sede').submit(e => {
        let id = $('#txtId_sedeEd').val();
        let nombre = $('#txtNombreSede2').val();
        let ciudad = $('#txtCiudadSede2').val();
        let direccion = $('#txtDirSede2').val();
        let telefono = $('#txtTelSede2').val();
        let email = $('#txtEmailSede2').val();
        let wp = $('#txtWpSede2').val();
        let nit = $('#txtNitSede2').val();
        let fb = $('#txtFbSede2').val();
        let instagram = $('#txtInstagramSede2').val();
        let twitter = $('#txtTwitterSede2').val();
        let youtube = $('#txtYoutubeSede2').val();
        funcion = 'editar_sede';
        $.post('../../Controlador/sede_controler.php', { funcion, id, nombre, ciudad, direccion, telefono, email, wp, nit, fb, instagram, twitter, youtube }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarSedes();
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
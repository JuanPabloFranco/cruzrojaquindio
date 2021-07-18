$(document).ready(function() {
    var funcion = "";
    var tipo_usuario = $('#txtTipoUsuario').val();
    var cargo = $('#id_cargo').val();
    var id_sede = $('#id_sede').val();
    var cobertura = $('#cobertura').val();
    buscar_avatar();
    buscarContactos();

    function buscar_avatar() {
        var id = $('#id_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $('#form_crear_contacto').submit(e => {
        e.preventDefault();
        let tipo = $('#selTipoCto').val();
        let id_sede_create = $('#id_sede2').val();
        let nombre = $('#txtNombreCto').val();
        let tel = $('#txtTelCto').val();
        let email = $('#txtEmailCto').val();
        let dir = $('#txtDirCto').val();
        let municipio = $('#txtMunicipio').val();
        let depto = $('#txtDeptoCto').val();
        let web = $('#txtWebCtog').val();
        let notas = $('#txtNotasCto').val();
        funcion = 'crear_contacto';
        $.post('../Controlador/contacto_controler.php', { funcion, id_sede_create, tipo, nombre, tel, email, dir, municipio, depto, web, notas }, (response) => {
            if (response == 'creado') {
                $('#divCreate').hide('slow');
                $('#divCreate').show(1000);
                $('#divCreate').hide(2000);
                $('#form_crear_contacto').trigger('reset');
                buscarContactos();
            } else {
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(2000);
                $('#divNoCreate').html(response);
            }
        });

    });

    $(document).on('keyup', '#TxtBuscarContacto', function() {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarContactos(consulta);
        } else {
            buscarContactos();
        }
    });

    function buscarContactos(consulta) {
        var funcion = "buscar_contacto";
        $.post('../Controlador/contacto_controler.php', { consulta, funcion, id_sede, cobertura }, (response) => {
            const objetos = JSON.parse(response);
            let template = "";
            objetos.forEach(obj => {
                $('#logoCtoEd').attr('src', '../Recursos/img/contacto/' + obj.logo_cto);
                template += `<div contactoId="${obj.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header text-muted border-bottom-0">
                    <h1 class="badge badge-danger">${obj.tipo_cto}</h1>     
                    <h1 class="badge badge-info">Sede ${obj.nombre_sede}</h1>                    
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead"><b>${obj.nombre_cto}</b></h2>
                        <p class="text-muted text-sm"><b>Sobre mi: </b> ${obj.notas} </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dirección: ${obj.dir_cto}<br> (${obj.municipio},${obj.depto_cto})</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono #: ${obj.tel_cto}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Email: ${obj.email_cto}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink"></i></span> Página Web:<br> ${obj.web_cto}</li>
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="../Recursos/img/contacto/${obj.logo_cto}" alt="" class="img-circle img-fluid" style='width: 80%'>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">`;
                if (tipo_usuario <= 2 || cargo != 1) {
                    template += `<button class='editContacto btn btn-sm btn-primary mr-1' type='button' data-bs-toggle="modal" data-bs-target="#editar_contacto">
                        <i class="fas fa-pencil-alt mr-1"></i>
                    </button>`;
                    template += `<button class='logoCto btn btn-sm btn-info mr-1' type='button' data-bs-toggle="modal" data-bs-target="#changeLogo">
                        <i class="fas fa-image mr-1"></i>
                    </button>`;
                    if (tipo_usuario <= 2) {
                        template += `<button class='delCto btn btn-sm btn-danger' type='button'>
                            <i class="fas fa-trash mr-1"></i>
                    </button>`;
                    }
                }
                template += `</div>
                  </div>
                </div>
              </div>`;
            });
            $('#busquedaContacto').html(template);
        });
    }

    $(document).on('click', '.editContacto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('contactoId');
        $('#txtId_ctoEd').val(id);
        funcion = 'cargarContacto';
        $.post('../Controlador/contacto_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#selTipoCto2').val(obj.tipo_cto);
            $('#txtNombreCto2').val(obj.nombre_cto);
            $('#txtTelCto2').val(obj.tel_cto);
            $('#txtEmailCto2').val(obj.email_cto);
            $('#txtDirCto2').val(obj.dir_cto);
            $('#txtMunicipio2').val(obj.municipio);
            $('#txtDeptoCto2').val(obj.depto_cto);
            $('#txtWebCtog2').val(obj.web_cto);
            $('#txtNotasCto2').val(obj.notas);
        });
    });

    $(document).on('click', '.logoCto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('contactoId');
        $('#txtIdCtoImg').val(id);
        funcion = 'cargarLogo';
        $.post('../Controlador/contacto_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#logoCtoEd').attr('src', '../Recursos/img/contacto/' + obj.logo_cto);
            $('#NombreContactoImg').html(obj.nombre_cto);
        });
    });

    $(document).on('click', '.delCto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar el contacto?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('contactoId');
                funcion = 'eliminar_contacto';
                $.post('../Controlador/contacto_controler.php', { id, funcion }, (response) => {
                    Swal.fire('Eliminado!', '', 'success');
                    buscarContactos();
                });
            } else if (result.isDenied) {
                Swal.fire('No se ha eliminado el contacto', '', 'info')
            }
        })
    });

    $('#form_editar_contacto').submit(e => {
        let id = $('#txtId_ctoEd').val();
        let tipo = $('#selTipoCto2').val();
        let nombre = $('#txtNombreCto2').val();
        let tel = $('#txtTelCto2').val();
        let email = $('#txtEmailCto2').val();
        let dir = $('#txtDirCto2').val();
        let municipio = $('#txtMunicipio2').val();
        let depto = $('#txtDeptoCto2').val();
        let web = $('#txtWebCtog2').val();
        let notas = $('#txtNotasCto2').val();
        funcion = 'editar_contacto';
        $.post('../Controlador/contacto_controler.php', { funcion, id, tipo, nombre, tel, email, dir, municipio, depto, web, notas }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarContactos();
            } else {
                $('#noUpdateObj').hide('slow');
                $('#noUpdateObj').show(1000);
                $('#noUpdateObj').hide(2000);
                $('#noUpdateObj').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_logoCto').submit(e => {
        let formData = new FormData($('#form_logoCto')[0]);
        $.ajax({
            url: '../Controlador/contacto_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function(response) {
            const json = JSON.parse(response);
            if (json.alert == 'edit') {
                $('#updateAvatar').hide('slow');
                $('#updateAvatar').show(1000);
                $('#updateAvatar').hide(2000);
                buscarContactos();
            } else {
                $('#noUpdateAvatar').hide('slow');
                $('#noUpdateAvatar').show(1000);
                $('#noUpdateAvatar').hide(2000);
                $('#noUpdateAvatar').html(response);
            }
        });
        e.preventDefault();
    });

});
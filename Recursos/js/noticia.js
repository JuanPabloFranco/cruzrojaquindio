$(document).ready(function () {
    var funcion = "";
    var id_usuario = $('#txtId_usuario').val();
    var tipo_usuario = $('#txtTipoUsuario').val();
    var id_sede = $('#id_sede').val();
    var cargo = $('#id_cargo').val();
    buscar_avatar(id_usuario);
    buscarNoticias();

    function buscar_avatar() {
        var id = $('#txtId_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $('#form_crear_noticia').submit(e => {
        e.preventDefault();
        let fecha = $('#txtFecha').val();
        let titulo = $('#txtTitulo').val();
        let encabezado = $('#txtEncabezado').val();
        let texto = $('#txtDesarrollo').val();
        funcion = 'crear_noticia';
        $.post('../../Controlador/noticia_controler.php', { funcion, fecha, titulo, encabezado, texto, id_sede }, (response) => {
            if (response == 'creado') {
                $('#createObj').hide('slow');
                $('#createObj').show(1000);
                $('#createObj').hide(2000);
                $('#form_crear_noticia').trigger('reset');
                buscarNoticias();
            } else {
                $('#noCreateObj').hide('slow');
                $('#noCreateObj').show(1000);
                $('#noCreateObj').hide(2000);
                $('#noCreateObj').html(response);
            }
        });

    });

    $("#form_agregar_imagen").on("submit", function (e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_agregar_imagen"));
        formData.append("dato", "valor");
        var peticion = $('#form_agregar_imagen').attr('action');
        $.ajax({
            url: '../../Controlador/noticia_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            const json = JSON.parse(response);
            if (json.alert == 'edit') {
                $('#divCreate').hide('slow');
                $('#divCreate').show(1000);
                $('#divCreate').hide(2000);
                $('#form_agregar_imagen').trigger('reset');
                buscarNoticias();
            } else {
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(2000);
                $('#divNoCreate').html(json.alert);
            }
        });
    });

    $('#form_editar_noticia').submit(e => {
        e.preventDefault();
        let id = $('#txtId_noticia').val();
        let fecha = $('#txtFecha2').val();
        let titulo = $('#txtTitulo2').val();
        let encabezado = $('#txtEncabezado2').val();
        let texto = $('#txtDesarrollo2').val();
        funcion = 'editar_noticia';
        $.post('../../Controlador/noticia_controler.php', { funcion, id, fecha, titulo, encabezado, texto }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                $('#form_crear_noticia').trigger('reset');
                buscarNoticias();
            } else {
                $('#noUpdateObj').hide('slow');
                $('#noUpdateObj').show(1000);
                $('#noUpdateObj').hide(2000);
                $('#noUpdateObj').html(response);
            }
        });

    });

    $(document).on('keyup', '#TxtBuscarNoticia', function () {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarNoticias(consulta);
        } else {
            buscarNoticias();
        }
    });

    function buscarNoticias(consulta) {
        var funcion = "buscar_noticias";
        $.post('../../Controlador/noticia_controler.php', { consulta, funcion, id_sede }, (response) => {
            const objetos = JSON.parse(response);
            let template = "";
            num = 0;
            objetos.forEach(obj => {
                num += 1;
                template += `<div notiId="${obj.id}"  class="col-12 col-sm-6 col-md-3  align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header border-bottom-0 notiHeader">
                        Noticia ${num}`;
                if (tipo_usuario <= 2 || (cargo == 1 || cargo == 7)) {
                    template += `<button class='addNoti btn btn-sm btn-warning mr-1 float-right' style='display: flex;' type='button' data-bs-toggle="modal" data-bs-target="#agregarImagen">
                            <i class="fas fa-image mr-1"></i>
                        </button>
                        <button class='editNoti btn btn-sm btn-info mr-1 float-right' style='display: flex;' type='button' data-bs-toggle="modal" data-bs-target="#editar_noticia">
                            <i class="fas fa-pencil-alt mr-1"></i>
                        </button>
                        <button class='delNoti btn btn-sm btn-danger mr-1 float-right' style='display: flex;' type='button' >
                        <i class="fas fa-trash mr-1"></i>
                    </button>`;
                }
                template += `</div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">`;
                if (obj.imagen != null && obj.imagen != "") {
                    template += `<img class='' src='../../Recursos/img/post/${obj.imagen}' style='width: 100%'>`;
                }
                template += `<ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"></span><b>${obj.titulo}</b></li>                        
                            </ul>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"></span>${obj.encabezado}</li>                        
                            </ul>`;
                template += `</div>
                    </div>
                  </div>`;

                template += `</div></div>`;
            });
            $('#busquedaNoticia').html(template);
        });
    }

    $(document).on('click', '.editNoti', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('notiId');
        $('#txtId_noticia').val(id);
        funcion = 'cargar_noticia';
        $.post('../../Controlador/noticia_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtFecha2').val(obj.fecha);
            $('#txtTitulo2').val(obj.titulo);
            $('#txtEncabezado2').val(obj.encabezado);
            $('#txtDesarrollo2').val(obj.texto);
        });
    });

    $(document).on('click', '.addNoti', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('notiId');
        $('#idNotiImg').val(id);
        funcion = 'cargar_noticia';
        $.post('../../Controlador/noticia_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            if (obj.imagen != null || obj.imagen != "") {
                $('#imgNoti').attr('src', obj.imagen);
            } else {
                document.getElementById("imgNoti").style.display = "none";
            }
        });
    });

    $(document).on('click', '.delNoti', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar la noticia?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('notiId');
                funcion = 'eliminar_imagen';
                $.post('../../Controlador/noticia_controler.php', { id, funcion }, (response) => {
                    Swal.fire('Eliminado!', '', 'success');
                    buscarNoticias();
                });
            } else if (result.isDenied) {
                Swal.fire('No se ha eliminado la noticia', '', 'info')
            }
        })
    });

});
$(document).ready(function () {
    var funcion = "";
    var id = $('#txtId_usuario').val();
    var cargo = $('#id_cargo').val();
    var id_sede = $('#id_sede').val();
    var tipo_usuario = $('#txtTipoUsuario').val();
    buscar_avatar();
    buscarEventos();
    function buscar_avatar() {
        funcion = 'buscarAvatar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $('#form_crear_evento').submit(e => {
        let formData = new FormData($('#form_crear_evento')[0]);
        $.ajax({
            url: '../../Controlador/evento_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {  
            if (response == 'edit') {
                $('#divCreate').hide('slow');
                $('#divCreate').show(1000);
                $('#divCreate').hide(2000);
                $('#form_crear_evento').trigger('reset');
                buscarEventos();
            } else {
                $('#divNoCreate').html(response);
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(2000);
            }
        });
        e.preventDefault();
    });

    $(document).on('keyup', '#TxtBuscarEvento', function () {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarEventos(consulta);
        } else {
            buscarEventos();
        }
    });

    function buscarEventos(consulta) {
        var funcion = "buscar_evento";
        $.post('../../Controlador/evento_controler.php', { consulta, funcion, id, id_sede }, (response) => {
            const objetos = JSON.parse(response);
            let template = "";
            num = 0;
            objetos.forEach(obj => {
                num += 1;
                template += `<div eventoId="${obj.id}" class="col-12 col-sm-6 col-md-3 align-items-stretch" id='divev'>
                <div class="card bg-light" id='divCard'>
                  <div class="card-header border-bottom-0 notiHeader" id='header'>${obj.nombre_evento}`;
                template += `</div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12 text-center">`;
                if (obj.estado_evento == "Activo") {
                    template += `<h1 class='badge badge-warning float-right'>${obj.estado_evento}</h1>`;
                } else {
                    template += `<h1 class='badge badge-danger'>${obj.estado_evento}</h1>`;
                }
                template += `<img class='' src='${obj.imagen_evento}' style='width:80%'>
                        <ul class="ml-4 mb-0 fa-ul text-muted">                        
                            <li class="small"><span class="fa-li"></span>${obj.nombre_servicio}</li>                        
                        </ul>`;
                template += ` </div>
                    </div><br>
                    <a href='../../Vista/evento.php?modulo=evento&&id=${obj.id}' class='btn btn-sm btn-info mr-1 float-right' style='display: flex;' type='button' >
                            <i class="fas fa-pager mr-1"> Detalle Evento</i>
                        </a>
                  </div>`;
                template += `</div></div>`;
            });
            $('#busquedaEvento').html(template);
        });
    }

    $(document).on('click', '.verEvento', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('eventoId');
        funcion = 'cargarEvento';
        $.post('../../Controlador/evento_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtTituloNombre').html(obj.nombre_evento);
            $('#regionEvento').html(obj.nombre_region);
            $('#servicioEvento').html(obj.nombre_servicio);
            $('#pFechaIn').html(obj.fecha_inicial);
            $('#pFechaFin').html(obj.fecha_final);
            $('#pTotal').html(obj.total_cupos);
            $('#pCupos').html(obj.cupos_disp);
            $('#pValor').html("$" + obj.precio);
            $('#vDescricion').html(obj.descripcion_evento);
            $('#badgeEstado').html(obj.estado_evento);
            $('#vImgEvento').attr('src', obj.imagen_evento);
        });
    });

});
$(document).ready(function() {
    var funcion = "";
    var tipo_usuario = $('#txtTipoUsuario').val();
    buscar_avatar();
    buscarServicios();

    function buscar_avatar() {
        var id = $('#id_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $('#form_crear_servicio').submit(e => {
        e.preventDefault();
        let nombre = $('#txtNombreServ').val();
        let descrip = $('#txtDescServ').val();
        let valor = $('#txtValorServ').val();
        funcion = 'crear_servicio';
        $.post('../Controlador/servicio_controler.php', { funcion, nombre, descrip, valor }, (response) => {
            if (response == 'creado') {
                $('#divCreate').hide('slow');
                $('#divCreate').show(1000);
                $('#divCreate').hide(2000);
                $('#form_crear_servicio').trigger('reset');
                buscarServicios();
            } else {
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(2000);
                $('#divNoCreate').html(response);
            }
        });

    });

    $(document).on('keyup', '#TxtBuscarServicio', function() {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarServicios(consulta);
        } else {
            buscarServicios();
        }
    });

    function buscarServicios(consulta) {
        var funcion = "buscar_servicio";
        $.post('../Controlador/servicio_controler.php', { consulta, funcion }, (response) => {
            const objetos = JSON.parse(response);
            num = 0;
            let template = `<div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered center-all">
                                            <thead notiHeader>                  
                                                <tr>
                                                    <th>#</th>                                                    
                                                    <th>Estado</th>
                                                    <th >Nombre</th>
                                                    <th >Valor</th>
                                                    <th >Descripción</th>
                                                    <th >Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;

            objetos.forEach(objeto => {
                num += 1;
                template += `                   <tr idServicio=${objeto.id}>
                                                    <td >${num}</td>
                                                    <td >${objeto.estado_servicio}</td>
                                                    <td >${objeto.nombre_servicio}</td>
                                                    <td >$${objeto.valor}</td>
                                                    <td >${objeto.descripcion}</td>
                                                    <td >
                                                        <button class='editServicio btn btn-sm btn-primary mr-1' type='button' data-bs-toggle="modal" data-bs-target="#ModalEditar_servicio">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button class='addImage btn btn-sm btn-info mr-1' type='button' data-bs-toggle="modal" data-bs-target="#fotosServicio">
                                                            <i class="fas fa-image"></i>
                                                        </button>`;
                if (objeto.estado_servicio == "Activo") {
                    template += `<button class='actServicio btn btn-sm btn-danger mr-1' type='button' title='Inactivar'>
                    <i class="fas fa-lock"></i>
                </button>`;
                } else {
                    template += `<button class='actServicio btn btn-sm btn-warning mr-1' type='button' title='Activar'>
                    <i class="fas fa-lock-open"></i>
                </button>`;
                }
                template += ` </td>
                                                </tr>`;

            });
            template += `                   </tbody>
                                        </table>
                                    </div> 
                                </div>`;
            $('#busquedaServicio').html(template);
        });
    }

    $(document).on('click', '.editServicio', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idServicio');
        $('#txtId_ServicioEd').val(id);
        funcion = 'cargarServicio';
        $.post('../Controlador/servicio_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtNombreServ2').val(obj.nombre_servicio);
            $('#txtDescServ2').val(obj.descripcion);
            $('#txtValorServ2').val(obj.valor);
        });
    });

    $(document).on('click', '.addImage', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idServicio');
        $('#txtIdServImage').val(id);
        buscarFotosServicios();
        
    });

    $('#form_editar_servicio').submit(e => {
        let id = $('#txtId_ServicioEd').val();
        let nombre = $('#txtNombreServ2').val();
        let desc = $('#txtDescServ2').val();
        let valor = $('#txtValorServ2').val();
        funcion = 'editar_servicio';
        $.post('../Controlador/servicio_controler.php', { funcion, id, nombre, desc, valor }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarServicios();
            } else {
                $('#noUpdateObj').hide('slow');
                $('#noUpdateObj').show(1000);
                $('#noUpdateObj').hide(2000);
                $('#noUpdateObj').html(response);
            }
        });
        e.preventDefault();
    });

    $(document).on('click', '.actServicio', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idServicio');
        funcion = 'changeEstadoServicio';
        $.post('../Controlador/servicio_controler.php', { id, funcion }, (response) => {
            buscarServicios();
        });
    });

    $("#form_crear_foto").on("submit", function(e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_crear_foto"));
        formData.append("dato", "valor");
        var peticion = $('#form_crear_foto').attr('action');
        $.ajax({
            url: '../Controlador/servicio_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function(response) {
            if (response == 'creado') {
                $('#divCreateFoto').hide('slow');
                $('#divCreateFoto').show(1000);
                $('#divCreateFoto').hide(2000);
                $('#form_crear_foto').trigger('reset');
                $('#divCreateFoto').html('Foto registrada');
                buscarFotosServicios();
            } else {
                $('#divNoCreateFoto').hide('slow');
                $('#divNoCreateFoto').show(1000);
                $('#divNoCreateFoto').hide(2000);
                $('#divNoCreateFoto').html(response);
            }
        });
    });

    function buscarFotosServicios() {
        var id_servicio = $('#txtIdServImage').val();
        var funcion = "buscar_foto_servicio";
        $.post('../Controlador/servicio_controler.php', { funcion, id_servicio }, (response) => {
            const objetos = JSON.parse(response);
            let template = "";
            num = 0;
            objetos.forEach(obj => {
                num += 1;
                template += `<div fotoId="${obj.id}"  class="col-12 col-sm-4  align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header border-bottom-0 notiHeader">
                        Foto ${num}`;
                if (tipo_usuario <= 2 || (cargo == 1 || cargo == 7 || cargo == 8 || cargo == 12)) {
                    template += `<button class='delFoto btn btn-sm btn-danger mr-1 float-right' style='display: flex;' type='button' >
                        <i class="fas fa-trash mr-1"></i>
                    </button>`;
                }
                template += `</div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">`;
                template += `<img class='' src='${obj.archivo}' style='width: 100%'>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"></span>${obj.descripcion}</li>                        
                        </ul>`;
                template += ` </div>
                    </div>
                  </div>`;
                template += `</div></div>`;
            });
            $('#divFotosServicio').html(template);
        });
    }

    $(document).on('click', '.delFoto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;        
        const id = $(elemento).attr('fotoId');
        funcion = 'eliminarFotoServicio';
        $.post('../Controlador/servicio_controler.php', { id, funcion }, (response) => {
            if (response == 'eliminado') {
                $('#divCreateFoto').hide('slow');
                $('#divCreateFoto').show(1000);
                $('#divCreateFoto').hide(2000);
                $('#divCreateFoto').html('Foto eliminada');
                buscarFotosServicios();
            } else {
                $('#divNoCreateFoto').hide('slow');
                $('#divNoCreateFoto').show(1000);
                $('#divNoCreateFoto').hide(2000);
                $('#divNoCreateFoto').html(response);
            }
        });
    });

});
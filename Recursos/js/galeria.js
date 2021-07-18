$(document).ready(function () {
    var funcion = "";
    var id_usuario = $('#txtId_usuario').val();
    var tipo_usuario = $('#txtTipoUsuario').val();
    var cargo = $('#id_cargo').val();
    buscar_avatar(id_usuario);
    buscarFotos();

    function buscar_avatar() {
        var id = $('#txtId_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $("#form_crear_foto").on("submit", function (e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_crear_foto"));
        formData.append("dato", "valor");
        var peticion = $('#form_crear_foto').attr('action');
        $.ajax({
            url: '../Controlador/imagen_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            if (response == 'subido') {
                $('#divCreate').hide('slow');
                $('#divCreate').show(1000);
                $('#divCreate').hide(2000);
                $('#form_crear_foto').trigger('reset');
                buscarFotos();
            } else {
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(2000);
                $('#divNoCreate').html(response);
            }
        });
    });

    $(document).on('keyup', '#TxtBuscarFoto', function () {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarFotos(consulta);
        } else {
            buscarFotos();
        }
    });

    function buscarFotos(consulta) {
        var funcion = "buscar_fotos";
        let id = $('#id_sede').val();
        $.post('../Controlador/imagen_controler.php', { consulta, funcion, id }, (response) => {
            const objetos = JSON.parse(response);
            let template = "";
            num = 0;
            objetos.forEach(obj => {
                num += 1;
                template += `<div fotoId="${obj.id}"  class="col-12 col-sm-6 col-md-3  align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header border-bottom-0 notiHeader">
                        Imagen ${num}`;
                if (tipo_usuario <= 2 || (cargo == 1 || cargo == 7 || cargo == 8 || cargo == 12)) {
                    template += `<button class='editFoto btn btn-sm btn-info mr-1 float-right' style='display: flex;' type='button' data-bs-toggle="modal" data-bs-target="#editar_foto">
                            <i class="fas fa-pencil-alt mr-1"></i>
                        </button>
                        <button class='delFoto btn btn-sm btn-danger mr-1 float-right' style='display: flex;' type='button' >
                        <i class="fas fa-trash mr-1"></i>
                    </button>`;
                }
                template += `</div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">`;
                template += `<img class='' src='../Recursos/img/fotos_sede/${obj.nombre_foto}' style='width: 100%'>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"></span>${obj.desc_foto}</li>                        
                        </ul>`;
                template += ` </div>
                    </div>
                  </div>
                  
                    `;

                template += `</div></div>`;
            });
            $('#busquedaFoto').html(template);
        });
    }

    $(document).on('click', '.editFoto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('fotoId');
        $('#txtId_fotoEd').val(id);
        funcion = 'cargarFoto';
        $.post('../Controlador/imagen_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtDescServ2').val(obj.desc_foto);
            $('#imgFoto').attr('src', '../Recursos/img/fotos_sede/' + obj.nombre_foto);
        });
    });

    $(document).on('click', '.delFoto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar la foto?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('fotoId');
                $('#txtId_fotoEd').val(id);
                funcion = 'eliminarFoto';
                $.post('../Controlador/imagen_controler.php', { id, funcion }, (response) => {
                    Swal.fire('Eliminado!', '', 'success');
                    buscarFotos();
                });
            } else if (result.isDenied) {
                Swal.fire('No se ha eliminado la foto', '', 'info')
            }
        })
    });

    $('#form_editar_foto').submit(e => {
        let id = $('#txtId_fotoEd').val();
        let desc = $('#txtDescServ2').val();
        funcion = 'editar_imagen';
        $.post('../Controlador/imagen_controler.php', { funcion, id, desc }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarFotos();
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
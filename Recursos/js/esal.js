$(document).ready(function () {
    var funcion = "";
    var id_usuario = $('#txtId_usuario').val();
    var tipo_usuario = $('#txtTipoUsuario').val();
    var cargo = $('#id_cargo').val();
    buscar_avatar(id_usuario);
    buscarArchivos();

    $('#selAñoEsalReg').change(e => {
        let ano = $('#selAñoEsalReg').val();
        let id = $('#txtIdSede').val();
        if (ano != 0) {
            funcion = 'listaEsalReg';
            $.post('Controlador/esal_controler.php', { ano, funcion, id }, (response) => {
                if (response == 'No') {
                    $('#divEsal').html('No se encontraron resultados para el año seleccionado');
                } else {
                    const objetos = JSON.parse(response);
                    let template = ``;
                    objetos.forEach(objeto => {
                        template += `<div class="col-md-3">
                        <div class="info-box text-center">
                            <a href="Recursos/esal/${objeto.archivo}" target='_blank'><img src="Recursos/img/pdf.png" style="width: 20%;">
                            <h3>${objeto.nombre}</h3>
                            <p>Vigencia: ${objeto.ano}</p>
                            </a>                            
                        </div>
                        </div>`;
                    });
                    $('#divEsal').html(template);
                }
            });

        }
        e.preventDefault();
    });

    function buscar_avatar() {
        var id = $('#txtId_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $("#form_crear_esal").on("submit", function (e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_crear_esal"));
        formData.append("dato", "valor");
        var peticion = $('#form_crear_esal').attr('action');
        $.ajax({
            url: '../../Controlador/esal_controler.php',
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
                $('#form_crear_esal').trigger('reset');
                buscarArchivos();
            } else {
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(2000);
                $('#divNoCreate').html(response);
            }
        });
    });

    $(document).on('keyup', '#TxtBuscarEsal', function () {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarArchivos(consulta);
        } else {
            buscarArchivos();
        }
    });

    function buscarArchivos(consulta) {
        var funcion = "buscar_archivos";
        let id = $('#id_sede').val();
        $.post('../../Controlador/esal_controler.php', { consulta, funcion, id }, (response) => {
            const objetos = JSON.parse(response);
            let template = "";
            num = 0;
            objetos.forEach(obj => {
                num += 1;
                template += `<div esalId="${obj.id}"  class="col-12 col-sm-6 col-md-3  align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header border-bottom-0 notiHeader">
                  <h1 class='badge badge-warning'>${obj.ano}</h1>`;
                if (tipo_usuario <= 2 || (cargo == 1 || cargo == 7 || cargo == 8)) {
                    template += `<button class='editEsal btn btn-sm btn-info mr-1 float-right' style='display: flex;' type='button' data-bs-toggle="modal" data-bs-target="#editar_esal">
                            <i class="fas fa-pencil-alt mr-1"></i>
                        </button>
                        <button class='delEsal btn btn-sm btn-danger mr-1 float-right' style='display: flex;' type='button' >
                        <i class="fas fa-trash mr-1"></i>
                    </button>`;
                }
                template += `</div>
                  <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-3">
                            <a href='../../Recursos/esal/${obj.archivo}' target='_blank'><img src='../../Recursos/img/pdf.png' style='width: 100%'></a>
                        </div>
                        <div class="col-9">
                            <h6 class='text-muted'>${obj.nombre}</h6>  
                        </div>
                    </div>
                  </div>
                </div>
                </div>`;
            });
            $('#busquedaEsal').html(template);
        });
    }

    $(document).on('click', '.editEsal', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('esalId');
        $('#txtId_esalEd').val(id);
        funcion = 'cargarEsal';
        $.post('../../Controlador/esal_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtNombreArchivo2').val(obj.nombre);
            $('#selAñoEsal2').val(obj.ano);

        });
    });

    $(document).on('click', '.delEsal', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar el archivo?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('esalId');
                $('#txtId_esalEd').val(id);
                funcion = 'eliminarEsal';
                $.post('../../Controlador/esal_controler.php', { id, funcion }, (response) => {
                    Swal.fire('Eliminado!', '', 'success');
                    buscarArchivos();
                });
            } else if (result.isDenied) {
                Swal.fire('No se ha eliminado el archivo', '', 'info')
            }
        })
    });

    $('#form_editar_esal').submit(e => {
        let id = $('#txtId_esalEd').val();
        let nombre = $('#txtNombreArchivo2').val();
        let ano = $('#selAñoEsal2').val();
        funcion = 'editar_esal';
        $.post('../../Controlador/esal_controler.php', { funcion, id, nombre, ano }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarArchivos();
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
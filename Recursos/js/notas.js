$(document).ready(function() {
    var funcion = "";
    var tipo_usuario = $('#txtTipoUsuario').val();
    var cargo = $('#id_cargo').val();
    var id_sede = $('#txtId_sede').val();
    buscar_avatar();
    buscarNotas();

    function buscar_avatar() {
        var id = $('#id_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $('#form_crear_nota').submit(e => {
        e.preventDefault();
        let tipo = $('#selTipoNota').val();
        let dirigido = $('#selDirigido').val();
        let id_cargo = 0;
        let id_sede = 0;
        let id_usuario = 0;
        if (dirigido == 'Todos') {
            id_cargo = 0;
            id_sede = 0;
            id_usuario = 0;
        }
        if (dirigido == 'Sede') {
            id_cargo = 0;
            id_sede = $('#selSedeNota').val();
            id_usuario = 0;
        }
        if (dirigido == 'Cargo') {
            id_cargo = $('#selCargoNota').val();
            id_sede = 0;
            id_usuario = 0;
        }
        if (dirigido == 'Usuario') {
            id_cargo = 0;
            id_sede = 0;
            id_usuario = $('#selUsuario').val();;
        }
        let fechaini = $('#txtFechaIni').val();
        let fechafin = $('#txtFechaFinal').val();
        let descripcion = $('#txtDescNota').val();
        let id_autor = $('#txtId_autor').val();
        funcion = 'crear_nota';
        $.post('../Controlador/nota_controler.php', { funcion, id_autor, tipo, dirigido, id_cargo, id_sede, id_usuario, fechaini, fechafin, descripcion }, (response) => {
            if (response == 'creado') {
                $('#divCreate').hide('slow');
                $('#divCreate').show(1000);
                $('#divCreate').hide(2000);
                $('#form_crear_nota').trigger('reset');
                buscarNotas();
            } else {
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(2000);
                $('#divNoCreate').html(response);
            }
        });
    });

    function buscarNotas(consulta) {
        var id = $('#id_usuario').val();
        var funcion = "buscar_nota";
        $.post('../Controlador/nota_controler.php', { consulta, funcion, id }, (response) => {
            const objetos = JSON.parse(response);
            num = 0;
            let template = `<div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered center-all">
                                            <thead class='notiHeader'>                  
                                                <tr>
                                                    <th>#</th>                                                    
                                                    <th>Tipo</th>
                                                    <th>Dirigido a</th>
                                                    <th>Descripción</th>
                                                    <th>Fecha Inicial</th>
                                                    <th>Fecha Final</th>
                                                    <th style='width: 138px'>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;

            objetos.forEach(objeto => {
                num += 1;
                template += `                   <tr idNota=${objeto.id}>
                                                    <td>${num}</td>
                                                    <td>${objeto.tipo_nota}</td>
                                                    <td>${objeto.dirigido}</td>
                                                    <td>${objeto.descripcion_nota}</td>
                                                    <td>${objeto.fecha_ini}</td>
                                                    <td>${objeto.fecha_fin}</td>
                                                    <td style="width: 10px">
                                                        <button class='editNota btn btn-sm btn-primary mr-1' type='button' data-bs-toggle="modal" data-bs-target="#editar_nota">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button class='imgNota btn btn-sm btn-warning mr-1' type='button' data-bs-toggle="modal" data-bs-target="#agregar_imagen">
                                                            <i class="fas fa-image"></i>
                                                        </button>
                                                        <button class='delNota btn btn-sm btn-danger mr-1' type='button'>
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                     </td>
                                                </tr>`;
            });
            template += `                   </tbody>
                                        </table>
                                    </div> 
                                </div>
            `
            $('#busquedaNota').html(template);
        });
    }

    $(document).on('click', '.editNota', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idNota');
        $('#txtId_NotaEd').val(id);
        funcion = 'cargarNotaEdit';
        $.post('../Controlador/nota_controler.php', { id, funcion }, (response) => {
            console.log(response)
            const obj = JSON.parse(response);
            $('#selTipoNota2').val(obj.tipo_nota);
            $('#selDirigido2').val(obj.dirigido);
            $('#selSedeNota2').val(obj.id_sede);
            $('#selCargoNota2').val(obj.id_cargo);
            $('#selUsuario2').val(obj.id_usuario);
            $('#txtFechaIni2').val(obj.fecha_ini);
            $('#txtFechaFinal2').val(obj.fecha_fin);
            $('#txtDescNota2').val(obj.descripcion_nota);
            if (obj.dirigido == 'Sede') {
                document.getElementById('divSede2').style.display = '';
            }
            if (obj.dirigido == 'Cargo') {
                document.getElementById('divCargo2').style.display = '';
            }
            if (obj.dirigido == 'Usuario') {
                document.getElementById('divUsuario2').style.display = '';
            }
        });
    });

    $(document).on('click', '.imgNota', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idNota');
        $('#txtIdNotaImg').val(id);
        funcion = 'cargarNotaImg';
        $.post('../Controlador/nota_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#notaImg').attr('src', '../Recursos/img/notas/' + obj.imagen);
            $('#txtNotaImg').html(obj.tipo_nota + " dirigido a " + obj.dirigido);
        });
    });

    $(document).on('click', '.delNota', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar la nota?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idNota');
                funcion = 'eliminarNota';
                $.post('../Controlador/nota_controler.php', { id, funcion }, (response) => {
                    Swal.fire('Eliminado!', '', 'success');
                    buscarNotas();
                });               
            } else if (result.isDenied) {
                Swal.fire('No se ha eliminado la nota', '', 'info')
            }
        })
    });

    $('#form_editar_nota').submit(e => {
        e.preventDefault();
        let tipo = $('#selTipoNota2').val();
        let dirigido = $('#selDirigido2').val();
        let id_cargo = 0;
        let id_sede = 0;
        let id_usuario = 0;
        if (dirigido == 'Todos') {
            id_cargo = 0;
            id_sede = 0;
            id_usuario = 0;
        }
        if (dirigido == 'Sede') {
            id_cargo = 0;
            id_sede = $('#selSedeNota2').val();
            id_usuario = 0;
        }
        if (dirigido == 'Cargo') {
            id_cargo = $('#selCargoNota2').val();
            id_sede = 0;
            id_usuario = 0;
        }
        if (dirigido == 'Usuario') {
            id_cargo = 0;
            id_sede = 0;
            id_usuario = $('#selUsuario2').val();;
        }
        let fechaini = $('#txtFechaIni2').val();
        let fechafin = $('#txtFechaFinal2').val();
        let descripcion = $('#txtDescNota2').val();
        let id = $('#txtId_NotaEd').val();
        funcion = 'editar_nota';
        $.post('../Controlador/nota_controler.php', { funcion, id, tipo, dirigido, id_cargo, id_sede, id_usuario, fechaini, fechafin, descripcion }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarNotas();
            } else {
                $('#noUpdateObj').hide('slow');
                $('#noUpdateObj').show(1000);
                $('#noUpdateObj').hide(2000);
                $('#noUpdateObj').html(response);
            }
        });
    });

    $('#form_img_nota').submit(e => {
        let formData = new FormData($('#form_img_nota')[0]);
        $.ajax({
            url: '../Controlador/nota_controler.php',
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
                $('#form_img_nota').trigger('reset');
                buscarNotas();
            } else {
                $('#noUpdateAvatar').hide('slow');
                $('#noUpdateAvatar').show(1000);
                $('#noUpdateAvatar').hide(2000);
                $('#noUpdateAvatar').html(json.alert);
            }
        });
        e.preventDefault();
    });

    $('#selDirigido').change(e => {
        valor = $('#selDirigido').val();
        if (valor == 'Todos') {
            document.getElementById('divSede').style.display = 'none';
            document.getElementById('divCargo').style.display = 'none';
            document.getElementById('divUsuario').style.display = 'none';
        }
        if (valor == 'Sede') {
            document.getElementById('divSede').style.display = '';
            document.getElementById('divCargo').style.display = 'none';
            document.getElementById('divUsuario').style.display = 'none';
        }
        if (valor == 'Cargo') {
            document.getElementById('divSede').style.display = 'none';
            document.getElementById('divCargo').style.display = '';
            document.getElementById('divUsuario').style.display = 'none';
        }
        if (valor == 'Usuario') {
            document.getElementById('divSede').style.display = 'none';
            document.getElementById('divCargo').style.display = 'none';
            document.getElementById('divUsuario').style.display = '';
        }
    });

    $('#selDirigido2').change(e => {
        valor = $('#selDirigido2').val();
        if (valor == 'Todos') {
            document.getElementById('divSede2').style.display = 'none';
            document.getElementById('divCargo2').style.display = 'none';
            document.getElementById('divUsuario2').style.display = 'none';
        }
        if (valor == 'Sede') {
            document.getElementById('divSede2').style.display = '';
            document.getElementById('divCargo2').style.display = 'none';
            document.getElementById('divUsuario2').style.display = 'none';
        }
        if (valor == 'Cargo') {
            document.getElementById('divSede2').style.display = 'none';
            document.getElementById('divCargo2').style.display = '';
            document.getElementById('divUsuario2').style.display = 'none';
        }
        if (valor == 'Usuario') {
            document.getElementById('divSede2').style.display = 'none';
            document.getElementById('divCargo2').style.display = 'none';
            document.getElementById('divUsuario2').style.display = '';
        }
    });
});
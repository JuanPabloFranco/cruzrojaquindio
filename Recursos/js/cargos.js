$(document).ready(function () {
    var funcion = "";
    var tipo_usuario = $('#txtTipoUsuario').val();
    buscar_avatar();
    buscarCargos();

    function buscar_avatar() {
        var id = $('#id_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            console.log(response);
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }


    $(document).on('keyup', '#TxtBuscarCargo', function () {
        let consulta = $(this).val();
        if (consulta != "") {
            buscarCargos(consulta);
        } else {
            buscarCargos();
        }
    });

    function buscarCargos(consulta) {
        var funcion = "buscar_cargo";
        $.post('../../Controlador/cargo_controler.php', { consulta, funcion }, (response) => {
            const objetos = JSON.parse(response);
            num = 0;
            let template = `<div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered table-responsive center-all">
                                            <thead>                  
                                                <tr class='notiHeader'>
                                                    <th >#</th>
                                                    <th>Acción</th>
                                                    <th>Nombre</th>                                                    
                                                    <th>Configuracion</th>
                                                    <th>Sedes</th>
                                                    <th>Usuarios</th>
                                                    <th>Agenda</th>
                                                    <th>Notas</th>
                                                    <th>Msj Contacto</th>
                                                    <th>Servicios</th>
                                                    <th>Galeria</th>
                                                    <th>Esal</th>
                                                    <th>Noticias</th>
                                                    <th>Eventos</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>`;

            objetos.forEach(objeto => {
                num += 1;
                template += `                   <tr idCargo=${objeto.id}>
                                                    <td>${num}</td>
                                                    <td>
                                                        <button class='editCargo btn btn-sm btn-primary mr-1' type='button' data-bs-toggle="modal" data-bs-target="#editar_cargo">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    </td>
                                                    <td>${objeto.nombre_cargo}</td>
                                                    <td>${objeto.adm}</td>
                                                    <td>${objeto.sedes}</td>
                                                    <td>${objeto.usuarios}</td>
                                                    <td>${objeto.agenda}</td>
                                                    <td>${objeto.notas}</td>
                                                    <td>${objeto.msj_contacto}</td>
                                                    <td>${objeto.servicios}</td>
                                                    <td>${objeto.galeria}</td>
                                                    <td>${objeto.esal}</td>
                                                    <td>${objeto.noticias}</td>
                                                    <td>${objeto.eventos}</td>
                                                </tr>`;

            });
            template += `                   </tbody>
                                        </table>
                                    </div> 
                                </div>`;
            $('#busquedaCargos').html(template);
        });
    }

    $(document).on('click', '.editCargo', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('idCargo');
        $('#txtId_CargoEd').val(id);
        funcion = 'cargarCargo';
        $('#checkConfiguracion2').attr('checked', true);
        $('#checkSedes2').attr('checked', true);
        $('#checkUsuarios2').attr('checked', true);
        $.post('../../Controlador/cargo_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtNombreCargo2').val(obj.nombre_cargo);
            $('#txtDescCargo2').val(obj.descripcion);
            $('#selCobertura2').val(obj.cobertura);
            $('#checkConfiguracion2').attr('checked', false);
            $('#checkSedes2').attr('checked', false);
            $('#checkUsuarios2').attr('checked', false);
            $('#checkAgenda2').attr('checked', false);
            $('#checkEventos2').attr('checked', false);
            $('#checkNoticias2').attr('checked', false);
            $('#checkEsal2').attr('checked', false);
            $('#checkGaleria2').attr('checked', false);
            $('#checkServicios2').attr('checked', false);
            $('#checkNotas2').attr('checked', false);
            $('#checkMsjContacto2').attr('checked', false);
            if (obj.adm == 'Activo') {
                $('#checkConfiguracion2').attr('checked', true);
            }
            if (obj.sedes == 'Activo') {
                $('#checkSedes2').attr('checked', true);
            }
            if (obj.usuarios == 'Activo') {
                $('#checkUsuarios2').attr('checked', true);
            }
            if (obj.agenda == 'Activo') {
                $('#checkAgenda2').attr('checked', true);
            }
            if (obj.msj_contacto == 'Activo') {
                $('#checkMsjContacto2').attr('checked', true);
            }
            if (obj.notas == 'Activo') {
                $('#checkNotas2').attr('checked', true);
            }
            if (obj.servicios == 'Activo') {
                $('#checkServicios2').attr('checked', true);
            }
            if (obj.galeria == 'Activo') {
                $('#checkGaleria2').attr('checked', true);
            }
            if (obj.esal == 'Activo') {
                $('#checkEsal2').attr('checked', true);
            }
            if (obj.noticias == 'Activo') {
                $('#checkNoticias2').attr('checked', true);
            }
            if (obj.eventos == 'Activo') {
                $('#checkEventos2').attr('checked', true);
            }
        });
    });

    $('#form_editar_cargo').submit(e => {
        let id = $('#txtId_CargoEd').val();
        let nombre_cargo = $('#txtNombreCargo2').val();
        let desc = $('#txtDescCargo2').val();
        let cobertura = $('#selCobertura2').val();
        let adm = '';
        let servicios = '';
        let sedes='';
        let galeria='';
        let esal='';
        let noticias='';
        let eventos='';
        let usuarios='';
        let msj_contacto='';
        let agenda='';
        let notas='';
        if (document.getElementById('checkConfiguracion2').checked) {
            adm = 'Activo';
        }
        if (document.getElementById('checkSedes2').checked) {
            sedes = 'Activo';
        }
        if (document.getElementById('checkServicios2').checked) {
            servicios = 'Activo';
        }
        if (document.getElementById('checkGaleria2').checked) {
            galeria = 'Activo';
        }
        if (document.getElementById('checkEsal2').checked) {
            esal = 'Activo';
        }
        if (document.getElementById('checkNoticias2').checked) {
            noticias = 'Activo';
        }        
        if (document.getElementById('checkEventos2').checked) {
            eventos = 'Activo';
        }
        if (document.getElementById('checkUsuarios2').checked) {
            usuarios = 'Activo';
        }
        if (document.getElementById('checkMsjContacto2').checked) {
            msj_contacto = 'Activo';
        }
        if (document.getElementById('checkAgenda2').checked) {
            agenda = 'Activo';
        }
        if (document.getElementById('checkNotas2').checked) {
            notas = 'Activo';
        }
        funcion = 'editar_cargo';
        $.post('../../Controlador/cargo_controler.php', {funcion, id, nombre_cargo, desc, cobertura, adm, sedes, servicios, galeria, esal, noticias, eventos, usuarios, msj_contacto, agenda, notas}, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
                buscarCargos();
            } else {
                $('#noUpdateObj').hide('slow');
                $('#noUpdateObj').show(1000);
                $('#noUpdateObj').hide(2000);
                $('#noUpdateObj').html(response);
            }
        });
        e.preventDefault();
    });


    $('#form_crear_cargo').submit(e => {
        let nombre_cargo = $('#txtNombreCargo').val();
        let desc = $('#txtDescCargo').val();
        let cobertura = $('#selCobertura').val();
        let adm = '';
        let servicios = '';
        let sedes='';
        let galeria='';
        let esal='';
        let noticias='';
        let eventos='';
        let usuarios='';
        let msj_contacto='';
        let agenda='';
        let notas='';
        if (document.getElementById('checkConfiguracion').checked) {
            adm = 'Activo';
        }
        if (document.getElementById('checkSedes').checked) {
            sedes = 'Activo';
        }
        if (document.getElementById('checkServicios').checked) {
            servicios = 'Activo';
        }
        if (document.getElementById('checkGaleria').checked) {
            galeria = 'Activo';
        }
        if (document.getElementById('checkEsal').checked) {
            esal = 'Activo';
        }
        if (document.getElementById('checkNoticias').checked) {
            noticias = 'Activo';
        }        
        if (document.getElementById('checkEventos').checked) {
            eventos = 'Activo';
        }
        if (document.getElementById('checkUsuarios').checked) {
            usuarios = 'Activo';
        }
        if (document.getElementById('checkMsjContacto').checked) {
            msj_contacto = 'Activo';
        }
        if (document.getElementById('checkAgenda').checked) {
            agenda = 'Activo';
        }
        if (document.getElementById('checkNotas').checked) {
            notas = 'Activo';
        }
        funcion = 'crear_cargo';
        $.post('../../Controlador/cargo_controler.php', {funcion, nombre_cargo, desc, cobertura, adm, sedes, servicios, galeria, esal, noticias, eventos, usuarios, msj_contacto, agenda, notas}, (response) => {
            if (response == 'create') {
                $('#createObj').hide('slow');
                $('#createObj').show(1000);
                $('#createObj').hide(2000);
                buscarCargos();
            } else {
                $('#noCreateObj').hide('slow');
                $('#noCreateObj').show(1000);
                $('#noCreateObj').hide(2000);
                $('#noCreateObj').html(response);
            }
        });
        e.preventDefault();
    });
});
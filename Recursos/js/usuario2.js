$(document).ready(function () {
    var tipo_usuario = $('#tipo_usuario').val();
    var id_sede = $('#id_sede').val();
    var id_cargo = $('#id_cargo').val();

    var funcion = "";
    var id_usuario = $('#id_usuario').val();
    var edit = false;
    buscar_avatar(id_usuario);
    buscarInfUsuario();
    buscarTipoEstudio("Bachillerato");
    buscarEstudios();
    buscarOtrosEstudios();
    buscarMedicamento();
    buscarEnfermedades();
    buscarAlergias();
    buscarCirugias();
    buscarLesiones();
    buscarAntecedentes();
    buscarCursos();
    buscarSoportes();

    function buscar_avatar(id) {
        funcion = 'buscarAvatar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }
    //Guardar informacipon familiar
    $('#form_crear_inf_fam').submit(e => {
        let madre = $('#txtNombreMadre').val();
        let ocuMadre = $('#txtOcupMadre').val();
        let telMadre = $('#txtTelMadre').val();
        let padre = $('#txtNombrePadre').val();
        let ocuPadre = $('#txtOcupPadre').val();
        let telPadre = $('#txtTelPadre').val();
        let conEmergencia = $('#txtConEmerg').val();
        let parentezco = $('#txtParentezco').val();
        let telEmergencia = $('#txtTelEmerg').val();
        funcion = 'update_familiar';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, madre, ocuMadre, telMadre, padre, ocuPadre, telPadre, conEmergencia, parentezco, telEmergencia }, (response) => {
            console.log(response);
            if (response == 'update') {
                $('#divCreateFam').hide('slow');
                $('#divCreateFam').show(1000);
                $('#divCreateFam').hide(2000);
                buscarInfUsuario();
            } else {
                $('#divNoCreateFam').hide('slow');
                $('#divNoCreateFam').show(1000);
                $('#divNoCreateFam').hide(2000);
                $('#divNoCreateFam').html(response);
            }
        });
        e.preventDefault();
    });

    function buscarInfUsuario() {
        funcion = 'buscarInfUsuario';
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtNombreMadre').val(obj.nombre_madre);
            $('#txtOcupMadre').val(obj.ocupacion_madre);
            $('#txtTelMadre').val(obj.tel_madre);
            $('#txtNombrePadre').val(obj.nombre_padre);
            $('#txtOcupPadre').val(obj.ocupacion_padre);
            $('#txtTelPadre').val(obj.tel_padre);
            $('#txtConEmerg').val(obj.contacto_emergencia);
            $('#txtParentezco').val(obj.parentezco_emergencia);
            $('#txtTelEmerg').val(obj.cel_emergencia);

            $('#txtProf').val(obj.formacion_prof);
            $('#txtOcupacion').val(obj.ocupacion);
            $('#txtEmpresa').val(obj.lab_emp);
            $('#txtCargoLaboral').val(obj.cargo_lab);
            $('#txtDirLab').val(obj.dir_lab);
            $('#txtTelLab').val(obj.tel_lab);

            $('#txtEps').val(obj.eps);
            $('#txtCarnet').val(obj.carnet);
            $('#selTipoSangre').val(obj.tipo_sangre);
            $('#txtPension').val(obj.pension);
            $('#txtArl').val(obj.arl);
            $('#txtCaja').val(obj.caja_compensacion);

            $('#selEstrato').val(obj.estrato);
            $('#selEstadoCivil').val(obj.estado_civil);
            $('#selGrupoEtnico').val(obj.grupo_etnico);
            $('#txtPersonas_cargo').val(obj.personas_cargo);
            $('#selCabeza_familia').val(obj.cabeza_familia);
            $('#txtHijos').val(obj.hijos);
            $('#selFuma').val(obj.fuma);
            $('#txtfuma_frecuencia').val(obj.fuma_frecuencia);
            $('#selBebidas').val(obj.bebidas);
            $('#txtbebe_frecuencia').val(obj.bebe_frecuencia);
            $('#txtDeporte').val(obj.deporte);
            $('#txtDeporte_frecuencia').val(obj.deporte_frecuencia);
            $('#txtTallaCamisa').val(obj.talla_camisa);
            $('#txtTallaPantalon').val(obj.talla_pantalon);
            $('#txtTallaCalzado').val(obj.talla_calzado);
            $('#selTVivienda').val(obj.tipo_vivienda);
            $('#selLicencia').val(obj.licencia_conduccion);
            $('#txtLicencia_descr').val(obj.licencia_descr);
            $('#txtAct_tiempo_libre').val(obj.act_tiempo_libre);
        });
    }

    //Guardar informacion sociodemografica
    $('#form_crear_sociodemo').submit(e => {
        let estrato = $('#selEstrato').val();
        let estado_civil = $('#selEstadoCivil').val();
        let grupo_etnico = $('#selGrupoEtnico').val();
        let personas_cargo = $('#txtPersonas_cargo').val();
        let cabeza_familia = $('#selCabeza_familia').val();
        let hijos = $('#txtHijos').val();
        let fuma = $('#selFuma').val();
        let fuma_frecuencia = $('#txtfuma_frecuencia').val();
        let bebidas = $('#selBebidas').val();
        let bebe_frecuencia = $('#txtbebe_frecuencia').val();
        let deporte = $('#txtDeporte').val();
        let deporte_frecuencia = $('#txtDeporte_frecuencia').val();
        let talla_camisa = $('#txtTallaCamisa').val();
        let talla_pantalon = $('#txtTallaPantalon').val();
        let talla_calzado = $('#txtTallaCalzado').val();
        let tipo_vivienda = $('#selTVivienda').val();
        let licencia_conduccion = $('#selLicencia').val();
        let licencia_descr = $('#txtLicencia_descr').val();
        let act_tiempo_libre = $('#txtAct_tiempo_libre').val();
        funcion = 'update_sociodemografica';
        $.post('../../Controlador/usuario_controler.php', {
            funcion, id_usuario, estrato, estado_civil, grupo_etnico,
            personas_cargo, cabeza_familia, hijos, fuma, fuma_frecuencia, bebidas, bebe_frecuencia, deporte, deporte_frecuencia,
            talla_camisa, talla_pantalon, talla_calzado, tipo_vivienda, licencia_conduccion, licencia_descr, act_tiempo_libre
        }, (response) => {
            if (response == 'update') {
                $('#divCreateSoc').hide('slow');
                $('#divCreateSoc').show(1000);
                $('#divCreateSoc').hide(2000);
                buscarInfUsuario();
            } else {
                $('#divNoCreateSoc').hide('slow');
                $('#divNoCreateSoc').show(1000);
                $('#divNoCreateSoc').hide(2000);
                $('#divNoCreateSoc').html(response);
            }
        });
        e.preventDefault();
    });

    function buscarTipoEstudio(valor) {
        if (valor == 'Bachillerato') {
            $("#selTipoEstudio option[value='Técnico']").remove();
            $("#selTipoEstudio option[value='Tecnólogo']").remove();
            $("#selTipoEstudio option[value='Profesional']").remove();
            $("#selTipoEstudio option[value='Especialización']").remove();
            $("#selTipoEstudio option[value='Magíster']").remove();

            $('#selTipoEstudio').prepend("<option value='Clásico' >Clásico</option>");
            $('#selTipoEstudio').prepend("<option value='Comercial' >Comercial</option>");
            $('#selTipoEstudio').prepend("<option value='Técnico' >Técnico</option>");
        }
        if (valor == 'Superior') {
            $("#selTipoEstudio option[value='Clásico']").remove();
            $("#selTipoEstudio option[value='Comercial']").remove();
            $("#selTipoEstudio option[value='Técnico']").remove();
            $("#selTipoEstudio option[value='Especialización']").remove();
            $("#selTipoEstudio option[value='Magíster']").remove();

            $('#selTipoEstudio').prepend("<option value='Técnico' >Técnico</option>");
            $('#selTipoEstudio').prepend("<option value='Tecnólogo' >Tecnólogo</option>");
            $('#selTipoEstudio').prepend("<option value='Profesional' >Profesional</option>");
        }
        if (valor == 'Postgrados') {
            $("#selTipoEstudio option[value='Clásico']").remove();
            $("#selTipoEstudio option[value='Comercial']").remove();
            $("#selTipoEstudio option[value='Técnico']").remove();
            $("#selTipoEstudio option[value='Tecnólogo']").remove();
            $("#selTipoEstudio option[value='Profesional']").remove();

            $('#selTipoEstudio').prepend("<option value='Especialización' >Especialización</option>");
            $('#selTipoEstudio').prepend("<option value='Magíster' >Magíster</option>");
        }
    }

    $('#selNivel').change(e => {
        valor = $('#selNivel').val();
        buscarTipoEstudio(valor);
    });

    $('#form_crear_estudio').submit(e => {
        let nivel = $('#selNivel').val();
        let tipo = $('#selTipoEstudio').val();
        let titulo = $('#txtTitulo').val();
        let institucion = $('#txtInstitucion').val();
        let año = $('#txtAñoEstudio').val();
        let ciudad = $('#txtCiudad').val();
        funcion = 'crear_estudio';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, nivel, tipo, titulo, institucion, año, ciudad }, (response) => {
            console.log(response);
            if (response == 'update') {
                $('#divCreateEst').hide('slow');
                $('#divCreateEst').show(1000);
                $('#divCreateEst').hide(2000);
                $('#form_crear_estudio').trigger('reset');
                buscarEstudios();
            } else {
                $('#divNoCreateEst').hide('slow');
                $('#divNoCreateEst').show(1000);
                $('#divNoCreateEst').hide(2000);
                $('#divNoCreateEst').html(response);
            }
        });
        e.preventDefault();
    });

    function buscarEstudios() {
        var funcion = "buscarEstudios";
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = ``;
            objetos.forEach(objeto => {
                template += `<tr idEstudio=${objeto.id}>
                <th scope="row"><button class='delEstudio btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                <i class="fas fa-trash"></i>
                </button></th>
                <td>${objeto.nivel}</td>
                <td>${objeto.tipo_nivel}</td>
                <td>${objeto.titulo}</td>
                <td>${objeto.institucion}</td>
                <td>${objeto.ano}</td>
                <td>${objeto.ciudad}</td>
            </tr>`;
            });
            $('#bodyEstudios').html(template);
        });
    }

    $(document).on('click', '.delEstudio', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;

        Swal.fire({
            title: 'Realmente desea eliminar el estudio?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idEstudio');
                alert(id);
                funcion = 'eliminar_estudio';
                $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
                    buscarEstudios();
                });                
            } 
        })
    });

    function buscarOtrosEstudios() {
        var funcion = "buscarOtrosEstudios";
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = ``;
            objetos.forEach(objeto => {
                template += `<tr idEstudio=${objeto.id}>
                <th scope="row"><button class='delOtroEstudio btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                <i class="fas fa-trash"></i>
                </button></th>
                <td>${objeto.tipo}</td>
                <td>${objeto.descripcion}</td>
            </tr>`;
            });
            $('#bodyOtros').html(template);
        });
    }

    $(document).on('click', '.delOtroEstudio', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;

        Swal.fire({
            title: 'Realmente desea eliminar el estudio?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idEstudio');
                funcion = 'eliminar_otro_estudio';
                $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
                    buscarOtrosEstudios;
                });                
            } 
        })

    });

    $('#form_crear_OEst').submit(e => {
        let tipo = $('#selTipoOtroEst').val();
        let descripcion = $('#txtDescrOtroEst').val();
        funcion = 'crear_otro_estudio';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, tipo, descripcion }, (response) => {
            if (response == 'update') {
                $('#divCreateOtro').hide('slow');
                $('#divCreateOtro').show(1000);
                $('#divCreateOtro').hide(2000);
                $('#form_crear_OEst').trigger('reset');
                buscarOtrosEstudios();
            } else {
                $('#divNoCreateOtro').hide('slow');
                $('#divNoCreateOtro').show(1000);
                $('#divNoCreateOtro').hide(2000);
                $('#divNoCreateOtro').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_crear_prof').submit(e => {
        let profesion = $('#txtProf').val();
        let ocupacion = $('#txtOcupacion').val();
        let empresa = $('#txtEmpresa').val();
        let cargo = $('#txtCargoLaboral').val();
        let direccion = $('#txtDirLab').val();
        let telefono = $('#txtTelLab').val();
        funcion = 'update_laboral';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, profesion, ocupacion, empresa, cargo, direccion, telefono }, (response) => {
            if (response == 'update') {
                $('#divCreateLab').hide('slow');
                $('#divCreateLab').show(1000);
                $('#divCreateLab').hide(2000);
                $('#form_crear_prof').trigger('reset');
                buscarInfUsuario();
            } else {
                $('#divNoCreateLab').hide('slow');
                $('#divNoCreateLab').show(1000);
                $('#divNoCreateLab').hide(2000);
                $('#divNoCreateLab').html(response);
            }
        });
        e.preventDefault();
    });

    function buscarMedicamento() {
        var funcion = "buscarMedicamento";
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = ``;
            objetos.forEach(objeto => {
                template += `<tr idMed=${objeto.id}>
                <th scope="row"><button class='delMedicamento btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                <i class="fas fa-trash"></i>
                </button></th>
                <td>${objeto.nombre}</td>
                <td>${objeto.indicaciones}</td>
            </tr>`;
            });
            $('#bodyMedicamento').html(template);
        });
    }

    $(document).on('click', '.delMedicamento', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar el medicamento?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idMed');
                funcion = 'eliminar_medicamento';
                $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
                    buscarMedicamento();
                });                
            } 
        })
    });

    function buscarEnfermedades() {
        var funcion = "buscarEnfermedades";
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = ``;
            objetos.forEach(objeto => {
                template += `<tr idEnfer=${objeto.id}>
                <th scope="row"><button class='delEnfermedad btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                <i class="fas fa-trash"></i>
                </button></th>
                <td>${objeto.nombre}</td>
            </tr>`;
            });
            $('#bodyEnfermedad').html(template);
        });
    }

    $(document).on('click', '.delEnfermedad', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar la enfermedad?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idEnfer');
                funcion = 'eliminar_enfermedad';
                $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
                    buscarEnfermedades();
                });                
            } 
        })
    });

    function buscarAlergias() {
        var funcion = "buscarAlergias";
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = ``;
            objetos.forEach(objeto => {
                template += `<tr idAlergia=${objeto.id}>
                <th scope="row"><button class='delAlergias btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                <i class="fas fa-trash"></i>
                </button></th>
                <td>${objeto.tipo}</td>
                <td>${objeto.nombre}</td>
            </tr>`;
            });
            $('#bodyAlergia').html(template);
        });
    }

    $(document).on('click', '.delAlergias', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar la alergia?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idAlergia');
                funcion = 'eliminar_alergia';
                $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
                    buscarAlergias();
                });                
            } 
        })
    });

    function buscarCirugias() {
        var funcion = "buscarCirugias";
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = ``;
            objetos.forEach(objeto => {
                template += `<tr idCirugia=${objeto.id}>
                <th scope="row"><button class='delCirugias btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                <i class="fas fa-trash"></i>
                </button></th>
                <td>${objeto.nombre}</td>
            </tr>`;
            });
            $('#bodyCirugia').html(template);
        });
    }

    $(document).on('click', '.delCirugias', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar la cirugía?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idCirugia');
                funcion = 'eliminar_cirugia';
                $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
                    buscarCirugias();
                });                
            } 
        })
    });

    function buscarLesiones() {
        var funcion = "buscarLesiones";
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = ``;
            objetos.forEach(objeto => {
                template += `<tr idLesion=${objeto.id}>
                <th scope="row"><button class='delLesiones btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                <i class="fas fa-trash"></i>
                </button></th>
                <td>${objeto.tipo}</td>
                <td>${objeto.nombre}</td>
            </tr>`;
            });
            $('#bodyLesion').html(template);
        });
    }

    $(document).on('click', '.delLesiones', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar la lesión?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idLesion');
                funcion = 'eliminar_lesion';
                $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
                    buscarLesiones();
                });                
            } 
        })
    });

    function buscarAntecedentes() {
        var funcion = "buscarAntecedentes";
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = ``;
            objetos.forEach(objeto => {
                template += `<tr idAnte=${objeto.id}>
                <th scope="row"><button class='delAntecedente btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                <i class="fas fa-trash"></i>
                </button></th>
                <td>${objeto.nombre}</td>
            </tr>`;
            });
            $('#bodyAntecedente').html(template);
        });
    }

    $(document).on('click', '.delAntecedente', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar el antecedente?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idAnte');
                funcion = 'eliminar_antecedente';
                $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
                    buscarAntecedentes();
                });                
            } 
        })
    });

    function buscarCursos() {
        var funcion = "buscarCursos";
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = ``;
            objetos.forEach(objeto => {
                template += `<tr idCurso=${objeto.id}>
                <th scope="row"><button class='delCurso btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                <i class="fas fa-trash"></i>
                </button></th>
                <td>${objeto.fecha}</td>
                <td>${objeto.institucion}</td>
                <td>${objeto.descripcion}</td>
                <td>${objeto.horas}</td>
            </tr>`;
            });
            $('#bodyCursos').html(template);
        });
    }

    $(document).on('click', '.delCurso', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar el curso?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idCurso');
                funcion = 'eliminar_curso';
                $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
                    buscarCursos();
                });
            } 
        })
    });

    $('#form_crear_medicamento').submit(e => {
        let medicamento = $('#txtNombreMed').val();
        let indicaciones = $('#txtIndicaciones').val();
        funcion = 'crear_medicamento';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, medicamento, indicaciones }, (response) => {
            if (response == 'update') {
                $('#divCreateMed').hide('slow');
                $('#divCreateMed').show(1000);
                $('#divCreateMed').hide(2000);
                $('#form_crear_medicamento').trigger('reset');
                buscarMedicamento();
            } else {
                $('#divNoCreateMed').hide('slow');
                $('#divNoCreateMed').show(1000);
                $('#divNoCreateMed').hide(2000);
                $('#divNoCreateMed').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_crear_enfermedad').submit(e => {
        let enfermedad = $('#txtNombreEnf').val();
        funcion = 'crear_enfermedad';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, enfermedad }, (response) => {
            if (response == 'update') {
                $('#divCreateEnf').hide('slow');
                $('#divCreateEnf').show(1000);
                $('#divCreateEnf').hide(2000);
                $('#form_crear_enfermedad').trigger('reset');
                buscarEnfermedades();
            } else {
                $('#divNoCreateEnf').hide('slow');
                $('#divNoCreateEnf').show(1000);
                $('#divNoCreateEnf').hide(2000);
                $('#divNoCreateEnf').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_crear_alergia').submit(e => {
        let tipo = $('#selTipoAlergia').val();
        let nombre = $('#txtNombreAlergia').val();
        funcion = 'crear_alergia';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, tipo, nombre }, (response) => {
            if (response == 'update') {
                $('#divCreateAler').hide('slow');
                $('#divCreateAler').show(1000);
                $('#divCreateAler').hide(2000);
                $('#form_crear_alergia').trigger('reset');
                buscarAlergias();
            } else {
                $('#divNoCreateAler').hide('slow');
                $('#divNoCreateAler').show(1000);
                $('#divNoCreateAler').hide(2000);
                $('#divNoCreateAler').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_crear_cirugia').submit(e => {
        let nombre = $('#txtNombreCirugia').val();
        funcion = 'crear_cirugia';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, nombre }, (response) => {
            if (response == 'update') {
                $('#divCreateCir').hide('slow');
                $('#divCreateCir').show(1000);
                $('#divCreateCir').hide(2000);
                $('#form_crear_cirugia').trigger('reset');
                buscarCirugias();
            } else {
                $('#divNoCreateCir').hide('slow');
                $('#divNoCreateCir').show(1000);
                $('#divNoCreateCir').hide(2000);
                $('#divNoCreateCir').html(response);
            }
        });
        e.preventDefault();
    });


    $('#form_crear_lesion').submit(e => {
        let tipo = $('#selTipoLesion').val();
        let nombre = $('#txtNombreLesion').val();
        funcion = 'crear_lesion';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, tipo, nombre }, (response) => {
            if (response == 'update') {
                $('#divCreateLes').hide('slow');
                $('#divCreateLes').show(1000);
                $('#divCreateLes').hide(2000);
                $('#form_crear_lesion').trigger('reset');
                buscarLesiones();
            } else {
                $('#divNoCreateLes').hide('slow');
                $('#divNoCreateLes').show(1000);
                $('#divNoCreateLes').hide(2000);
                $('#divNoCreateLes').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_crear_antecedente').submit(e => {
        let nombre = $('#selAntecedente').val();
        funcion = 'crear_antecedente';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, nombre }, (response) => {
            console.log(response);
            if (response == 'update') {
                $('#divCreateAnt').hide('slow');
                $('#divCreateAnt').show(1000);
                $('#divCreateAnt').hide(2000);
                $('#form_crear_antecedente').trigger('reset');
                buscarAntecedentes();
            } else {
                $('#divNoCreateAnt').hide('slow');
                $('#divNoCreateAnt').show(1000);
                $('#divNoCreateAnt').hide(2000);
                $('#divNoCreateAnt').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_crear_curso').submit(e => {
        let fecha = $('#txtFechaCurso').val();
        let institucion = $('#txtInstitucionCurso').val();
        let descripcion = $('#txtCapDesc').val();
        let horas = $('#txtHoras').val();
        funcion = 'crear_curso';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, fecha, institucion, descripcion, horas }, (response) => {
            console.log(response);
            if (response == 'update') {
                $('#divCreateCurso').hide('slow');
                $('#divCreateCurso').show(1000);
                $('#divCreateCurso').hide(2000);
                $('#form_crear_curso').trigger('reset');
                buscarCursos();
            } else {
                $('#divNoCreateCurso').hide('slow');
                $('#divNoCreateCurso').show(1000);
                $('#divNoCreateCurso').hide(2000);
                $('#divNoCreateCurso').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_datos_salud').submit(e => {
        let eps = $('#txtEps').val();
        let carnet = $('#txtCarnet').val();
        let tipo_sangre = $('#selTipoSangre').val();
        let arl = $('#txtArl').val();
        let pension = $('#txtPension').val();
        let caja_compensacion = $('#txtCaja').val();
        funcion = 'update_salud';
        $.post('../../Controlador/usuario_controler.php', { funcion, id_usuario, eps, carnet, tipo_sangre, arl, pension, caja_compensacion }, (response) => {
            if (response == 'update') {
                $('#divCreateSalud').hide('slow');
                $('#divCreateSalud').show(1000);
                $('#divCreateSalud').hide(2000);
                buscarInfUsuario();
            } else {
                $('#divNoCreateSalud').hide('slow');
                $('#divNoCreateSalud').show(1000);
                $('#divNoCreateSalud').hide(2000);
            }
        });
        e.preventDefault();
    });

    $("#form_crear_soporte").on("submit", function (e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_crear_soporte"));
        formData.append("dato", "valor");
        var peticion = $('#form_crear_soporte').attr('action');
        $.ajax({
            url: '../../Controlador/usuario_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            if (response == 'creado') {
                $('#divCreateSoporte').hide('slow');
                $('#divCreateSoporte').show(1000);
                $('#divCreateSoporte').hide(2000);
                $('#form_crear_soporte').trigger('reset');
                buscarSoportes();
            } else {
                $('#divNoCreateSoporte').hide('slow');
                $('#divNoCreateSoporte').show(1000);
                $('#divNoCreateSoporte').hide(2000);
                $('#divNoCreateSoporte').html(response);
            }
        });
    });

    function buscarSoportes() {
        var funcion = "buscarSoportes";
        $.post('../../Controlador/usuario_controler.php', { id_usuario, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = ``;
            num = 0;
            objetos.forEach(objeto => {
                num +=1;
                template += `<tr idSoporte=${objeto.id} soporte=${objeto.soporte}>
                <td>${num}</td>
                <td>${objeto.tipo_soporte}</td>
                <td>${objeto.nombre_soporte}</td>
                <td><img src='../../Recursos/img/soportes_usuario/${objeto.soporte}' style='width: 45%'></td>
                <td scope="row"><button class='delSoporte btn btn-sm btn-danger mr-1' type='button' title='Eliminar'>
                <i class="fas fa-trash"></i>
                </button></td>
            </tr>`;
            });
            $('#bodySoportes').html(template);
        });
    }

    $(document).on('click', '.delSoporte', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        Swal.fire({
            title: 'Realmente desea eliminar el soporte?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                const id = $(elemento).attr('idSoporte');
                const soporte = $(elemento).attr('soporte');
                funcion = 'eliminar_soporte';
                $.post('../../Controlador/usuario_controler.php', { id, funcion, soporte }, (response) => {
                    buscarSoportes();
                });                
            } 
        })
    });

});
$(document).ready(function () {
    let funcion = 'reporteGeneral';
    var id_tipo = $('#txtTipoUsuario').val();
    var id_cargo = $('#id_cargo').val();
    var id_region = $('#id_region').val();
    buscar_avatar();
    cargarEstadisticas();

    if((id_cargo>1 && id_cargo<=7) || id_tipo<=2){
        estadisticasRegiones();
    }

    
    function buscar_avatar() {
        var id = $('#txtId_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    $(document).on('click', '.excel', (e) => {
        accion = $('#selTipoReporte').val();
        $('#txtAccion').val(accion);
        $('#formExcel').submit();
    });


    function cargarEstadisticas() {
        var id = $('#id_usuario').val();
        funcion = 'estadisticas';
        $.post('../Controlador/incidente_controler.php', { funcion, id_cargo, id_region }, (response) => {
            const obj = JSON.parse(response);
            $('#spanRegistrados').html(obj.registrados);
            $('#spanNuevos').html(obj.nuevos);
            $('#spanVerificados').html(obj.verificados);
            $('#spanPersonal').html(obj.personal);
            $('#spanHeridos').html(obj.heridos);
            $('#spanDesaparecidos').html(obj.desaparecidos);
            $('#spanLesionados').html(obj.lesionados);
            $('#spanMuertos').html(obj.muertos);
            $('#spanVAveriadas').html(obj.averiadas);
            $('#spanVDestruidas').html(obj.destruidas);
            $('#spanFam').html(obj.familias);
        });
    }

    function estadisticasRegiones(consulta) {
        var funcion = "estadisticasRegiones";
        $.post('../Controlador/incidente_controler.php', { consulta, funcion }, (response) => {
            const objetos = JSON.parse(response);
            let template = "";
            objetos.forEach(obj => {
                template += `<div class="col-lg-2 col-6">
                                <div class="info-box mb-3 bg-purple">
                                    <div class="info-box-content">
                                        <span class="info-box-text">${obj.nombre_region}</span>
                                    </div>
                                    <span class="info-box-icon" id="spanFam"></i>${obj.cantidad}</span>
                                </div>
                            </div>`;
            });
            $('#estadisticasReg').html(template);
        });
    }
});
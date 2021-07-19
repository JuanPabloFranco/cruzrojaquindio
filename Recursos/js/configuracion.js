$(document).ready(function () {
    var funcion = "";
    buscar_avatar();
    cargarInformacion();

    function buscar_avatar() {
        var id = $('#id_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    function cargarInformacion() {
        funcion = 'cargarInformacion';
        $.post('../../Controlador/configuracion_controler.php', { funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtNombreEntidad').val(obj.nombre);
            $('#txtTexto1').val(obj.texto);
            $('#txtMision').val(obj.mision);
            $('#txtVision').val(obj.vision);
            $('#txtTituloAlternativo').val(obj.titulo);
            $('#txtAlternativo').val(obj.texto2);
            $('#img1').attr('src', obj.imagen1);
            $('#img2').attr('src', obj.imagen2);
        });
    }

    $('#form_datos_basicos').submit(e => {
        let nombre = $('#txtNombreEntidad').val();
        let texto = $('#txtTexto1').val();
        let mision = $('#txtMision').val();
        let vision = $('#txtVision').val();
        funcion = 'guardarDatosBasicos';
        $.post('../../Controlador/configuracion_controler.php', { funcion, nombre, texto, mision, vision }, (response) => {
            if (response == 'update') {
                $('#save').hide('slow');
                $('#save').show(1000);
                $('#save').hide(2000);
            } else {
                $('#noSave').hide('slow');
                $('#noSave').show(1000);
                $('#noSave').hide(2000);
                $('#noSave').html(response);
            }
        });
        e.preventDefault();
    });
    $('#form_datos_alternativos').submit(e => {
        let titulo = $('#txtTituloAlternativo').val();
        let texto2 = $('#txtAlternativo').val();
        funcion = 'guardarDatosAlternativos';
        $.post('../../Controlador/configuracion_controler.php', { funcion, titulo, texto2 }, (response) => {
            if (response == 'update') {
                $('#saveA').hide('slow');
                $('#saveA').show(1000);
                $('#saveA').hide(2000);
            } else {
                $('#noSaveA').hide('slow');
                $('#noSaveA').show(1000);
                $('#noSaveA').hide(2000);
                $('#noSaveA').html(response);
            }
        });
        e.preventDefault();
    });

    $("#form_crear_imagen1").on("submit", function (e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_crear_imagen1"));
        formData.append("dato", "valor");
        var peticion = $('#form_crear_imagen1').attr('action');
        $.ajax({
            url: '../../Controlador/configuracion_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            console.log(response)
            if (response == 'update') {
                $('#divCreateImg1').hide('slow');
                $('#divCreateImg1').show(1000);
                $('#divCreateImg1').hide(2000);
                cargarInformacion();
            } else {
                $('#divNoCreateImg1').hide('slow');
                $('#divNoCreateImg1').show(1000);
                $('#divNoCreateImg1').hide(2000);
                $('#divNoCreateImg1').html(response);
            }
        });
    });

    $("#form_crear_imagen2").on("submit", function (e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("form_crear_imagen2"));
        formData.append("dato", "valor");
        var peticion = $('#form_crear_imagen2').attr('action');
        $.ajax({
            url: '../../Controlador/configuracion_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            if (response == 'update') {
                $('#divCreateImg2').hide('slow');
                $('#divCreateImg2').show(1000);
                $('#divCreateImg2').hide(2000);
                cargarInformacion();
            } else {
                $('#divNoCreateImg2').hide('slow');
                $('#divNoCreateImg2').show(1000);
                $('#divNoCreateImg2').hide(2000);
                $('#divNoCreateImg2').html(response);
            }
        });
    });

    $("#btnDeleteImg1").click(function(){
        Swal.fire({
            title: 'Realmente desea eliminar la imagen 1',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                funcion = 'eliminarImagen1';
                $.post('../../Controlador/configuracion_controler.php', { funcion }, (response) => {
                    if (response == 'update') {
                        Swal.fire('Eliminado!', '', 'success');
                        cargarInformacion();
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('No se ha eliminado la imagen1', '', 'info')
            }
        })
    });
    $("#btnDeleteImg2").click(function(){
        Swal.fire({
            title: 'Realmente desea eliminar la imagen 2',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                funcion = 'eliminarImagen2';
                $.post('../../Controlador/configuracion_controler.php', { funcion }, (response) => {
                    if (response == 'update') {
                        Swal.fire('Eliminado!', '', 'success');
                        cargarInformacion();
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('No se ha eliminado la imagen 2', '', 'info')
            }
        })
    });
});
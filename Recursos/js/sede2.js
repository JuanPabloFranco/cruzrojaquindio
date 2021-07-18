$(document).ready(function() {
    var funcion = "";
    var tipo_usuario = $('#txtTipoUsuario').val();
    var id = $('#txtIdsede').val();
    buscar_avatar();
    cargarDatosSede();

    function buscar_avatar() {
        var id = $('#id_usuario').val();
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    function cargarDatosSede() {
        funcion = 'cargarSede';
        $.post('../Controlador/sede_controler.php', { id, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#txtNombreSede2').val(obj.nombre_sede);
            $('#txtCiudadSede2').val(obj.ciudad_sede);
            $('#txtDirSede2').val(obj.direccion_sede);
            $('#txtTelSede2').val(obj.tel_sede);
            $('#txtEmailSede2').val(obj.email);
            $('#txtWpSede2').val(obj.wp_sede);
            $('#txtNitSede2').val(obj.nit);
            $('#txtFbSede2').val(obj.facebook);
            $('#txtInstagramSede2').val(obj.instagram);
            $('#txtTwitterSede2').val(obj.twitter);
            $('#txtYoutubeSede2').val(obj.youtube);
        });
    }

    $('#form_editar_sede').submit(e => {
        let nombre = $('#txtNombreSede2').val();
        let ciudad = $('#txtCiudadSede2').val();
        let direccion = $('#txtDirSede2').val();
        let telefono = $('#txtTelSede2').val();
        let email = $('#txtEmailSede2').val();
        let wp = $('#txtWpSede2').val();
        let nit = $('#txtNitSede2').val();
        let fb = $('#txtFbSede2').val();
        let instagram = $('#txtInstagramSede2').val();
        let twitter = $('#txtTwitterSede2').val();
        let youtube = $('#txtYoutubeSede2').val();
        funcion = 'editar_sede';
        $.post('../Controlador/sede_controler.php', { funcion, id, nombre, ciudad, direccion, telefono, email, wp, nit, fb, instagram, twitter, youtube }, (response) => {
            if (response == 'update') {
                $('#updateObj').hide('slow');
                $('#updateObj').show(1000);
                $('#updateObj').hide(2000);
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
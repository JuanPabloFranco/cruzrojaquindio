$(document).ready(function() {

    var id_usuario = $('#id_usuario').val();
    buscar_avatar(id_usuario);

    function buscar_avatar(id) {
        funcion = 'buscarAvatar';
        $.post('../../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }
});
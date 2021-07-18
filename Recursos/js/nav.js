$(document).ready(function() {

    msjContacto();
    soporte();

    function msjContacto() {
        funcion = 'contar_msj';
        id_region = $('#txtIdRegion').val();
        $.post('../Controlador/msjContacto_controler.php', { funcion, id_region }, (response) => {
            const obj = JSON.parse(response);
            $('#spanMsj').text(obj.cantidad);
        });
    }

    function soporte() {
        funcion = 'contar_soporte';
        $.post('../Controlador/soporte_controler.php', { funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#spanContacto').text(obj.cantidad);
        });
    }
});
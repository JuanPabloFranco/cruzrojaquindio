$(document).ready(function () {
    var funcion = "";
   
    $('#form_inscripcion_evento').submit(e => {
        let id_evento  = $('#txtId_evento').val();
        let nombre_participante = $('#txtNombreParticipante').val();
        let tipo_doc = $('#selTipoDoc').val();
        let documento = $('#txtDoc').val();
        let fec_nac_part = $('#txtFechaNac').val();
        let telefono = $('#txtTelefono').val();
        let email = $('#txtTEmail').val();
        let tipo_sangre = $('#selTipoSangre').val();
        let nacionalidad = $('#txtNacionalidad').val();
        let departamento_res = $('#txtDepto').val();
        let municipio_res = $('#txtMunicipio').val();
        let eps = $('#txtEps').val();
        funcion = "inscribir_participante";
        $.post('../../Controlador/participante_evento_controler.php', { funcion, id_evento, nombre_participante, tipo_doc, documento, fec_nac_part, telefono, email, tipo_sangre, nacionalidad, departamento_res, municipio_res, eps }, (response) => {            
            if (response == 'registrado') {
                $('#divCreate').hide('slow');
                $('#divCreate').show(1000);
                $('#divCreate').hide(3000);
                setTimeout('document.location.reload()',6000);
            } else {
                $('#divNoCreate').hide('slow');
                $('#divNoCreate').show(1000);
                $('#divNoCreate').hide(3000);
                $('#divNoCreate').html(response);
            }
        });
        e.preventDefault();
    });
    
});
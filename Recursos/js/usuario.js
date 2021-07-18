$(document).ready(function() {

    var funcion = "";
    var id_usuario = $('#id_usuario').val();
    var edit = false;
    buscar_general(id_usuario);
    buscar_avatar(id_usuario);

    function buscar_avatar(id) {
        funcion = 'buscarAvatar';
        $.post('../Controlador/usuario_controler.php', { id, funcion }, (response) => {
            const usuario = JSON.parse(response);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }

    function buscar_general(dato) {
        funcion = 'buscar_datos_general';
        $.post('../Controlador/usuario_controler.php', { dato, funcion }, (response) => {
            const obj = JSON.parse(response);
            $('#genero').html(obj.genero);
            $('#edad_usuario').html(obj.edad_usuario);
            $('#fecha_nac').html(obj.fecha_nac);
            $('#doc_usuario').html(obj.doc_id);
            $('#p_telefono').html(obj.tel_usuario);
            $('#p_celular').html(obj.cel_usuario);
            $('#p_residencia').html(obj.dir_usuario);
            $('#p_email').html(obj.email_usuario);
            $('#p_region').html(obj.nombre_sede);
            $('#p_cargo').html(obj.nombre_cargo);
            $('#p_tipo').html(obj.nombre_tipo);
            $('#p_info').html(obj.inf_usuario);
            $('#avatar1').attr('src', obj.avatar);
            $('#avatar2').attr('src', obj.avatar);
            $('#avatar3').attr('src', obj.avatar);
            buscar_avatar(id_usuario);
        })
    };

    $(document).on('click', '.edit', (e) => {
        funcion = 'llenar_datos';
        edit = true;
        $.post('../Controlador/usuario_controler.php', { funcion, id_usuario }, (response) => {
            const usuario = JSON.parse(response);
            $('#txtNombreCompleto').val(String(usuario.nombre_completo));
            $('#txtDoc_id').val(String(usuario.doc_id));
            $('#txtTecha_nac').val(String(usuario.fecha_nac));
            $('#selGenero').val(String(usuario.genero));
            $('#txtLugarNac').val(String(usuario.lugar_nac));
            $('#txtTelefono').val(String(usuario.tel_voluntario));
            $('#txtCelular').val(String(usuario.cel_voluntario));
            $('#txtDireccion').val(String(usuario.dir_voluntario));
            $('#txtEmail').val(String(usuario.email_voluntario));
            $('#txtAdicional').val(String(usuario.inf_voluntario));
            $('#txtTwitter').val(String(usuario.twitter));
            $('#txtFb').val(String(usuario.facebook));
            $('#txtInstagram').val(String(usuario.instagram));
        })
    });

    $('#formEditarGeneral').submit(e => {
        if (edit == true) {
            let nombre = $('#txtNombreCompleto').val();
            let doc_id = $('#txtDoc_id').val();
            let fecha_nac = $('#txtTecha_nac').val();
            let genero = $('#selGenero').val();
            let lugarNac = $('#txtLugarNac').val();
            let telefono = $('#txtTelefono').val();
            let celular = $('#txtCelular').val();
            let direccion = $('#txtDireccion').val();
            let email = $('#txtEmail').val();
            let inf_usuario = $('#txtAdicional').val();
            let twitter = $('#txtTwitter').val();
            let fb = $('#txtFb').val();
            let instagram = $('#txtInstagram').val();
            funcion = 'editar_general';
            $.post('../Controlador/usuario_controler.php', { id_usuario, funcion, nombre, doc_id, fecha_nac, lugarNac, telefono, celular, direccion, email, inf_usuario, twitter, fb, instagram, genero }, (response) => {
                if (response == 'editado') {
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(2000);
                    $('#formEditarGeneral').trigger('reset');
                    edit = false;
                    buscar_general(id_usuario);
                }

            })
        } else {
            $('#noeditado').hide('slow');
            $('#noeditado').show(1000);
            $('#noeditado').hide(2000);
            $('#formEditarGeneral').trigger('reset');
        }
        e.preventDefault();
    });

    $('#form_pass').submit(e => {
        let nameUser = $('#txtUsuarioCh').val();
        let oldpass = $('#oldPass').val();
        let newpass = $('#newPass').val();
        funcion = "changePass";
        $.post('../Controlador/usuario_controler.php', { id_usuario, funcion, nameUser, oldpass, newpass }, (response) => {
            if (response == 'update') {
                $('#update').hide('slow');
                $('#update').show(1000);
                $('#update').hide(8000);
                $('#form_pass').trigger('reset');
            } else {
                $('#noUpdate').hide('slow');
                $('#noUpdate').show(1000);
                $('#noUpdate').hide(5000);
                $('#noUpdate').html(response);
            }
        });
        e.preventDefault();
    });

    $('#form_avatar').submit(e => {
        let formData = new FormData($('#form_avatar')[0]);
        $.ajax({
            url: '../Controlador/usuario_controler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function(response) {
            const json = JSON.parse(response);
            if (json.alert == 'edit') {
                $('#avatar3').attr('src', json.ruta);
                $('#updateAvatar').hide('slow');
                $('#updateAvatar').show(1000);
                $('#updateAvatar').hide(2000);
                $('#form_avatar').trigger('reset');
                buscar_general(id_usuario);
                buscar_avatar(id_usuario);
            } else {
                $('#noUpdateAvatar').hide('slow');
                $('#noUpdateAvatar').show(1000);
                $('#noUpdateAvatar').hide(2000);
                $('#form_avatar').trigger('reset');
            }
        });
        e.preventDefault();
    });   

});
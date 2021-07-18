<?php
include_once '../Modelo/Usuario.php';
session_start();

if (!empty($_SESSION['type_id'])) {
    header('location: ../Vista/adm_panel.php');
} else {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    $usuario = new Usuario();
    $usuario->loguearse($user, $pass);
    if (!empty($usuario->objetos)) {
        if ($usuario->objetos[0]->estado_sede == 'Activo') {
            if ($usuario->objetos[0]->estado == 'Activo') {
                $_SESSION['id_user'] = $usuario->objetos[0]->id;
                $_SESSION['name_user'] = $usuario->objetos[0]->nombre_completo;
                $_SESSION['type_id'] = $usuario->objetos[0]->id_tipo_usuario;
                $_SESSION['type_user'] = $usuario->objetos[0]->nombre_tipo;
                $_SESSION['id_sede'] = $usuario->objetos[0]->id_sede;
                $_SESSION['name_sede'] = $usuario->objetos[0]->nombre_sede;
                $_SESSION['id_cargo'] = $usuario->objetos[0]->id_cargo;
                $_SESSION['usuario'] = $usuario->objetos[0]->usuario;
                //permisos
                $_SESSION['permisos'] = $usuario->permisosCargo($usuario->objetos[0]->id);
                if($_SESSION['type_user']<=3){
                    header('location: ../Vista/adm_panel.php');                    
                }else{
                    header('location: ../index.php');
                }
            } else {
                $msj = 'El Voluntario se encuentra inactivo';
                header('location: ../login.php?msj=' . $msj);
            }
        } else {
            $msj = 'La sede a la que pertenece el usuario se encuentra inactiva';
            header('location: ../login.php?msj=' . $msj);
        }        
    } else {
        $msj = 'Usuario o Contraseña incorrecta';
        header('location: ../login.php?msj=' . $msj);
    }
}

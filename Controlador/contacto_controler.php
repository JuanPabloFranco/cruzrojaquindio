<?php
include_once '../Modelo/Contacto.php';
$contacto = new Contacto();

if ($_POST['funcion'] == 'crear_contacto') {
    $contacto->crear($_POST['id_sede'], utf8_decode($_POST['nombre']),$_POST['tel'],$_POST['email'], $_POST['dir'],utf8_decode($_POST['municipio']),utf8_decode($_POST['depto']),$_POST['web'],utf8_decode($_POST['tipo']),utf8_decode($_POST['notas']));    
}

if ($_POST['funcion'] == 'buscar_contacto') {
    $json = array();
    $contacto->buscar_datos();
    foreach ($contacto->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_cto' => $objeto->nombre_cto,
            'tel_cto' => $objeto->tel_cto,
            'email_cto' => $objeto->email_cto,
            'dir_cto' => $objeto->dir_cto,
            'municipio' => $objeto->municipio,
            'depto_cto' => $objeto->depto_cto,
            'web_cto' => $objeto->web_cto,
            'logo_cto' => $objeto->logo_cto,
            'tipo_cto' => $objeto->tipo_cto,
            'nombre_sede' => $objeto->nombre_sede,
            'notas' => $objeto->notas
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarContacto') {
    $json = array();
    $id = $_POST['id'];
    $contacto->cargarContacto($id);
    foreach ($contacto->objetos as $objeto) {
        $json[] = array(
            'nombre_cto' => $objeto->nombre_cto,
            'tel_cto' => $objeto->tel_cto,
            'email_cto' => $objeto->email_cto,
            'dir_cto' => $objeto->dir_cto,
            'municipio' => $objeto->municipio,
            'depto_cto' => $objeto->depto_cto,
            'web_cto' => $objeto->web_cto,
            'logo_cto' => $objeto->logo_cto,
            'tipo_cto' => $objeto->tipo_cto,
            'notas' => $objeto->notas
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarLogo') {
    $json = array();
    $id = $_POST['id'];
    $contacto->cargarContacto($id);
    foreach ($contacto->objetos as $objeto) {
        $json[] = array(
            'nombre_cto' => $objeto->nombre_cto,
            'logo_cto' => $objeto->logo_cto
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar_contacto') {
    $contacto->editar_contacto($_POST['id'], utf8_decode($_POST['nombre']), $_POST['tel'],$_POST['email'],utf8_decode($_POST['dir']),utf8_decode($_POST['municipio']),utf8_decode($_POST['depto']), $_POST['web'],utf8_decode($_POST['tipo']),utf8_decode($_POST['notas']));    
}


if ($_POST['funcion'] == 'changeLogo') {
    $id = $_POST['id'];
    if (($_FILES['logo_cto']['type'] == 'image/jpeg') || ($_FILES['logo_cto']['type'] == 'image/png') || ($_FILES['avatar']['type'] == 'image/gif')) {
        $logo = uniqid() . "-" . $_FILES['logo_cto']['name'];
        $ruta = '../Recursos/img/contacto/' . $logo;
        move_uploaded_file($_FILES['logo_cto']['tmp_name'], $ruta);
        $contacto->cambiar_logo($id, $logo);
        foreach ($contacto->objetos as $objeto) {
            if($objeto->logo_cto<>'contacto_default.png'){
                unlink('../Recursos/img/contacto/' . $objeto->logo_cto);
            }            
        }
        $json = array();
        $json[] = array(
            'ruta' => $ruta,
            'alert' => 'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    } else {
        $json = array();
        $json[] = array(
            'alert' => 'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}

if ($_POST['funcion'] == 'eliminar_contacto') {
    $contacto->eliminar_contacto($_POST['id']);    
}
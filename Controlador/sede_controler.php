<?php
include_once '../Modelo/Sede.php';
$sede = new Sede();

if ($_POST['funcion'] == 'listaContactanos') {
    $json = array();
    $id = $_POST['id'];
    $sede->listaContactanos($id);
    foreach ($sede->objetos as $objeto) {
        $json[] = array(            
            'nombre_sede' => $objeto->nombre_sede,
            'ciudad_sede' => $objeto->ciudad_sede,
            'direccion_sede' => $objeto->direccion_sede,
            'tel_sede' => $objeto->tel_sede,
            'email' => $objeto->email,
            'wp_sede' => $objeto->wp_sede,
            'facebook' => $objeto->facebook,
            'instagram' => $objeto->instagram,
            'twitter' => $objeto->twitter,
            'youtube' => $objeto->youtube
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'crear_sede') {
    $sede->crear_sede($_POST['nombre'], $_POST['ciudad'], $_POST['direccion'], $_POST['telefono'], $_POST['email'], $_POST['wp'], $_POST['nit'], $_POST['fb'], $_POST['instagram'], $_POST['twitter'], $_POST['youtube']);    
}

if ($_POST['funcion'] == 'buscar_sedes') {
    $json = array();
    $sede->buscar_datos();
    foreach ($sede->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_sede' => $objeto->nombre_sede,
            'ciudad_sede' => $objeto->ciudad_sede,
            'direccion_sede' => $objeto->direccion_sede,
            'tel_sede' => $objeto->tel_sede,
            'email' => $objeto->email,
            'wp_sede' => $objeto->wp_sede,
            'nit' => $objeto->nit,
            'facebook' => $objeto->facebook,
            'instagram' => $objeto->instagram,
            'twitter' => $objeto->twitter,
            'youtube' => $objeto->youtube,
            'estado_sede' => $objeto->estado_sede
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarSede') {
    $json = array();
    $id = $_POST['id'];
    $sede->cargarsede($id);
    foreach ($sede->objetos as $objeto) {
        $json[] = array(
            'nombre_sede' => $objeto->nombre_sede,
            'ciudad_sede' => $objeto->ciudad_sede,
            'direccion_sede' => $objeto->direccion_sede,
            'tel_sede' => $objeto->tel_sede,
            'email' => $objeto->email,
            'wp_sede' => $objeto->wp_sede,
            'nit' => $objeto->nit,
            'facebook' => $objeto->facebook,
            'instagram' => $objeto->instagram,
            'twitter' => $objeto->twitter,
            'youtube' => $objeto->youtube
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar_sede') {
    $sede->editar_sede($_POST['id'],$_POST['nombre'], $_POST['ciudad'], $_POST['direccion'], $_POST['telefono'], $_POST['email'], $_POST['wp'], $_POST['nit'], $_POST['fb'], $_POST['instagram'], $_POST['twitter'], $_POST['youtube']);    
}

if ($_POST['funcion'] == 'changeEstadoSede') {
    $sede->changeEstadosede($_POST['id']);    
}

if ($_POST['funcion'] == 'cargarFb') {
    $json = array();
    $id = $_POST['id_sede'];
    $sede->cargarFb($id);
    foreach ($sede->objetos as $objeto) {
        $json[] = array(
            'facebook' => $objeto->facebook
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
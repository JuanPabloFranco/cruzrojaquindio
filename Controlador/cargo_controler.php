<?php
include_once '../Modelo/Cargo.php';
$cargo = new Cargo();

if ($_POST['funcion'] == 'buscar_cargo') {
    $json = array();
    $cargo->buscar_datos();
    foreach ($cargo->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_cargo' => $objeto->nombre_cargo,
            'cobertura' => $objeto->cobertura,
            'adm' => $objeto->adm,
            'sedes' => $objeto->sedes,
            'servicios' => $objeto->servicios,
            'galeria' => $objeto->galeria,
            'esal' => $objeto->esal,
            'noticias' => $objeto->noticias,
            'eventos' => $objeto->eventos,
            'usuarios' => $objeto->usuarios,
            'msj_contacto' => $objeto->msj_contacto,
            'agenda' => $objeto->agenda,
            'notas' => $objeto->notas,
            'descripcion' => $objeto->descripcion        
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarCargo') {
    $json = array();
    $id = $_POST['id'];
    $cargo->cargarCargo($id);
    foreach ($cargo->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_cargo' => $objeto->nombre_cargo,
            'cobertura' => $objeto->cobertura,
            'adm' => $objeto->adm,
            'sedes' => $objeto->sedes,
            'servicios' => $objeto->servicios,
            'galeria' => $objeto->galeria,
            'esal' => $objeto->esal,
            'noticias' => $objeto->noticias,
            'eventos' => $objeto->eventos,
            'usuarios' => $objeto->usuarios,
            'msj_contacto' => $objeto->msj_contacto,
            'agenda' => $objeto->agenda,
            'notas' => $objeto->notas,
            'descripcion' => $objeto->descripcion     
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'crear_cargo') {
    $cargo->crear_cargo($_POST['nombre_cargo'],$_POST['cobertura'],$_POST['desc'],$_POST['adm'],$_POST['sedes'],$_POST['servicios'],
    $_POST['galeria'],$_POST['esal'],$_POST['noticias'],$_POST['eventos'],$_POST['usuarios'],$_POST['msj_contacto'],$_POST['agenda'],$_POST['notas']);    
}

if ($_POST['funcion'] == 'editar_cargo') {
    $cargo->editar_cargo($_POST['id'],$_POST['nombre_cargo'],$_POST['cobertura'],$_POST['desc'],$_POST['adm'],$_POST['sedes'],$_POST['servicios'],
    $_POST['galeria'],$_POST['esal'],$_POST['noticias'],$_POST['eventos'],$_POST['usuarios'],$_POST['msj_contacto'],$_POST['agenda'],$_POST['notas']);    
}
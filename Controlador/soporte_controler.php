<?php
include_once '../Modelo/Soporte.php';
$soporte = new Soporte();

if ($_POST['funcion'] == 'crear_soporte') {
    $fecha = date('Y-m-d');
    $soporte->crear($_POST['id_voluntario'], $_POST['descripcion'],$fecha);    
}

if ($_POST['funcion'] == 'buscar_solicitud') {
    $json = array();
    $soporte->buscar_datos();
    foreach ($soporte->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_completo' => $objeto->nombre_completo,
            'nombre_region' => $objeto->nombre_region,
            'estado_soporte' => $objeto->estado_soporte,
            'descripcion_soporte' => $objeto->descripcion_soporte,
            'fecha_registro' => $objeto->fecha_registro
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'crear_comentario') {
    $fecha = date('Y-m-d');
    $soporte->crear_comentario($_POST['id_soporte'],$_POST['comentario'], $_POST['id_voluntario'],$fecha);    
}

if ($_POST['funcion'] == 'cambiar_estado') {
    $soporte->cambiar_estado($_POST['id_soporte'], $_POST['estado']);    
}


if ($_POST['funcion'] == 'soporte') {
    $id = $_POST['id'];
    if (($_FILES['soporte']['type'] == 'image/jpeg') || ($_FILES['soporte']['type'] == 'image/png') || ($_FILES['soporte']['type'] == 'image/gif')) {
        $soport = uniqid() . "-" . $_FILES['soporte']['name'];
        $ruta = '../Recursos/img/soporte/' . $soport;
        move_uploaded_file($_FILES['soporte']['tmp_name'], $ruta);
        $soporte->agregar_soporte($id, $soport); 
    } else {
        echo 'El tipo de archivo seleccionado no es válido';
    }
}

if ($_POST['funcion'] == 'contar_soporte') {
    $json = array();
    $soporte->contar_soporte();
    foreach ($soporte->objetos as $objeto) {
        $json[] = array(
            'cantidad' => $objeto->cantidad
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;   
}
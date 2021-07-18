<?php
include_once '../Modelo/Servicio.php';
$servicio = new Servicio();

if ($_POST['funcion'] == 'crear_servicio') {
    $servicio->crear($_POST['nombre'], $_POST['descrip'], $_POST['valor']);    
}

if ($_POST['funcion'] == 'buscar_servicio') {
    $json = array();
    $servicio->buscar_datos();
    foreach ($servicio->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_servicio' => $objeto->nombre_servicio,
            'estado_servicio' => $objeto->estado_servicio,
            'descripcion' => $objeto->descripcion,
            'valor' => $objeto->valor
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarServicio') {
    $json = array();
    $id = $_POST['id'];
    $servicio->cargarServicio($id);
    foreach ($servicio->objetos as $objeto) {
        $json[] = array(
            'nombre_servicio' => $objeto->nombre_servicio,
            'descripcion' => $objeto->descripcion,
            'valor' => $objeto->valor
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar_servicio') {
    $servicio->editar_serrvicio($_POST['id'],$_POST['nombre'], $_POST['desc'], $_POST['valor']);    
}

if ($_POST['funcion'] == 'changeEstadoServicio') {
    $servicio->changeEstadoServicio($_POST['id']);    
}

if ($_POST['funcion'] == 'listar_fotos_servicio') {
    $json = array();
    $id = $_POST['id'];
    $servicio->listar_fotos_servicio($id);
    foreach ($servicio->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'archivo' => $objeto->archivo,
            'descripcion' => $objeto->descripcion
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'crear_foto_servicio') {
    $id_servicio = $_POST['id_servicio'];
    $descripcion = $_POST['descripcion'];
    if (($_FILES['archivo']['type'] == 'image/jpeg') || ($_FILES['archivo']['type'] == 'image/png') || ($_FILES['archivo']['type'] == 'image/gif')) {
        $archivo = uniqid() . "-" . $_FILES['archivo']['name'];
        $ruta = '../Recursos/img/servicios/' . $archivo;
        move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        $servicio->crear_foto($id_servicio, $archivo, $descripcion);
    } else {
        echo "El archivo seleccionado debe ser jpeg, png o gif";
    }
}

if ($_POST['funcion'] == 'buscar_foto_servicio') {
    $json = array();
    $servicio->buscar_foto_servicio($_POST['id_servicio']);
    foreach ($servicio->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'archivo' => '../Recursos/img/servicios/'. $objeto->archivo,
            'descripcion' => $objeto->descripcion
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'eliminarFotoServicio') {
    $servicio->eliminarFotoServicio($_POST['id']);
}
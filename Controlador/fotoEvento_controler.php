<?php
include_once '../Modelo/FotoEvento.php';
$foto = new FotoEvento();

if ($_POST['funcion'] == 'crear_foto_evento') {
    $id_evento = $_POST['id_evento'];
    $descripcion = $_POST['descripcion'];
    if (($_FILES['archivo']['type'] == 'image/jpeg') || ($_FILES['archivo']['type'] == 'image/png') || ($_FILES['archivo']['type'] == 'image/gif')) {
        $archivo = uniqid() . "-" . $_FILES['archivo']['name'];
        $ruta = '../Recursos/img/eventos/fotos/' . $archivo;
        move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        $foto->crear($id_evento, $archivo, $descripcion);
    } else {
        echo "El archivo seleccionado debe ser jpeg, png o gif";
    }
}

if ($_POST['funcion'] == 'buscar_foto_evento') {
    $json = array();
    $foto->listar();
    foreach ($foto->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'id_evento' => $objeto->id_evento,
            'archivo' => '../Recursos/img/eventos/fotos/' . $objeto->archivo,
            'descripcion' => $objeto->descripcion,
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarFotoEvento') {
    $json = array();
    $id = $_POST['id'];
    $foto->cargarFoto($id);
    foreach ($foto->objetos as $objeto) {
        $json[] = array(
            'id_evento' => $objeto->id_evento,
            'archivo' => '../Recursos/img/eventos/fotos/' . $objeto->archivo,
            'descripcion' => $objeto->descripcion,
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar_foto_evento') {
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $foto->editar_foto_evento($id, $descripcion);
}

if ($_POST['funcion'] == 'eliminarFoto') {
    $foto->eliminar($_POST['id']);
    foreach ($foto->objetos as $objeto) {
        unlink('../Recursos/img/eventos/fotos/' . $objeto->archivo);
    }
}
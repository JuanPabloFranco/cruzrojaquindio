<?php
include_once '../Modelo/Imagen.php';
$foto = new Imagen();

if ($_POST['funcion'] == 'crear_foto') {   
    $id_sede = $_POST['id_sede'];
    $descripcion = $_POST['desc_foto'];
    if ($_FILES['nombre_foto']['name'] <> "") {
        if (($_FILES['nombre_foto']['type'] == 'image/jpeg') || ($_FILES['nombre_foto']['type'] == 'image/png') || ($_FILES['avatar']['type'] == 'image/gif')) {
            $nombre_foto = uniqid() . "-" . $_FILES['nombre_foto']['name'];
            $ruta = '../Recursos/img/fotos_sede/' . $nombre_foto;
            move_uploaded_file($_FILES['nombre_foto']['tmp_name'], $ruta);
            $foto->crear($nombre_foto, $descripcion, $id_sede);
        } else {
            echo "El archivo adjuntado no es aceptado";
        }
    }
    
}

if ($_POST['funcion'] == 'buscar_fotos') {
    $json = array();
    $foto->buscar_datos();
    foreach ($foto->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'id_sede' => $objeto->id_sede,
            'nombre_foto' => $objeto->nombre_foto,
            'desc_foto' => $objeto->desc_foto
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarFoto') {
    $json = array();
    $id = $_POST['id'];
    $foto->cargarFoto($id);
    foreach ($foto->objetos as $objeto) {
        $json[] = array(
            'nombre_foto' => $objeto->nombre_foto,
            'desc_foto' => $objeto->desc_foto
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar_imagen') {
    $foto->editar_imagen($_POST['id'],$_POST['desc']);    
}

if ($_POST['funcion'] == 'eliminarFoto') {
    $foto->eliminar_imagen($_POST['id']);    
}

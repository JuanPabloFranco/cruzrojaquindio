<?php
include_once '../Modelo/Configuracion.php';
$configuracion = new Configuracion();

if ($_POST['funcion'] == 'cargarInformacion') {
    $json = array();
    $configuracion->cargarInformacion();
    foreach ($configuracion->objetos as $objeto) {
        $json[] = array(
            'nombre' => $objeto->nombre,
            'texto' => $objeto->texto,
            'mision' => $objeto->mision,
            'vision' => $objeto->vision,
            'titulo' => $objeto->titulo,
            'texto2' => $objeto->texto2,
            'imagen1' => '../Recursos/img/' . $objeto->imagen1,
            'imagen2' => '../Recursos/img/' . $objeto->imagen2
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'guardarDatosBasicos') {
    $configuracion->guardarDatosBasicos($_POST['nombre'],$_POST['texto'],$_POST['mision'],$_POST['vision']);    
}
if ($_POST['funcion'] == 'guardarDatosAlternativos') {
    $configuracion->guardarDatosAlternativos($_POST['titulo'],$_POST['texto2']);    
}
if ($_POST['funcion'] == 'guardarImagen1') {
    if (($_FILES['imagen1']['type'] == 'image/jpeg') || ($_FILES['imagen1']['type'] == 'image/png') || ($_FILES['imagen1']['type'] == 'image/gif')) {
        $imagen = $_FILES['imagen1']['name'];
        $ruta = '../Recursos/img/' . $imagen;
        move_uploaded_file($_FILES['imagen1']['tmp_name'], $ruta);
        $configuracion->guardarImagen1($imagen);    
    } else {
        echo "El archivo seleccionado debe ser jpeg, png o gif";
    }

    
}
if ($_POST['funcion'] == 'guardarImagen2') {
    if (($_FILES['imagen2']['type'] == 'image/jpeg') || ($_FILES['imagen2']['type'] == 'image/png') || ($_FILES['imagen2']['type'] == 'image/gif')) {
        $imagen = $_FILES['imagen2']['name'];
        $ruta = '../Recursos/img/' . $imagen;
        move_uploaded_file($_FILES['imagen2']['tmp_name'], $ruta);
        $configuracion->guardarImagen2($imagen);    
    } else {
        echo "El archivo seleccionado debe ser jpeg, png o gif";
    }
}
if ($_POST['funcion'] == 'eliminarImagen1') {
    $configuracion->eliminarImagen1();    
}
if ($_POST['funcion'] == 'eliminarImagen2') {
    $configuracion->eliminarImagen2();    
}
<?php
include_once '../Modelo/Noticia.php';
$noticia = new Noticia();

if ($_POST['funcion'] == 'crear_noticia') {
    $noticia->crear($_POST['fecha'], $_POST['titulo'], $_POST['encabezado'], $_POST['texto'], $_POST['id_sede']);
}

if ($_POST['funcion'] == 'agregar_imagen') {
    if ($_FILES['imagen']['name'] <> "") {
        $id = $_POST['id'];
        if (($_FILES['imagen']['type'] == 'image/jpeg') || ($_FILES['imagen']['type'] == 'image/png') || ($_FILES['imagen']['type'] == 'image/gif')) {
            $imagen = uniqid() . "-" . $_FILES['imagen']['name'];
            $ruta = '../Recursos/img/post/' . $imagen;
            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
            $noticia->agregar_imagen($id, $imagen);
            foreach ($noticia->objetos as $objeto) {
                if ($objeto->imagen <> '') {
                    unlink('../Recursos/img/post/' . $objeto->imagen);
                }
            }
            $json = array();
            $json[] = array(
                'alert' => 'edit'
            );
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        } else {
            echo "El archivo adjuntado no es aceptado";
        }
    }
}

if ($_POST['funcion'] == 'buscar_noticias') {
    $json = array();
    $noticia->buscar_datos();
    foreach ($noticia->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'titulo' => $objeto->titulo,
            'imagen' => $objeto->imagen,
            'encabezado' => $objeto->encabezado,
            'texto' => $objeto->texto
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargar_noticia') {
    $json = array();
    $id = $_POST['id'];
    $noticia->cargarNoticia($id);
    foreach ($noticia->objetos as $objeto) {
        $json[] = array(
            'fecha' => $objeto->fecha,
            'titulo' => $objeto->titulo,
            'encabezado' => $objeto->encabezado,
            'texto' => $objeto->texto
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar_noticia') {
    $noticia->editar_noticia($_POST['id'], $_POST['fecha'], $_POST['titulo'], $_POST['encabezado'], $_POST['texto']);
}

if ($_POST['funcion'] == 'eliminar_imagen') {
    $noticia->eliminar_noticia($_POST['id']);
}

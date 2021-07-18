<?php
include_once '../Modelo/Nota.php';
$nota = new Nota();

if ($_POST['funcion'] == 'crear_nota') {
    $nota->crear($_POST['id_autor'],$_POST['tipo'],$_POST['dirigido'],$_POST['id_cargo'],$_POST['id_sede'],$_POST['id_usuario'],$_POST['fechaini'],$_POST['fechafin'],$_POST['descripcion']);
}

if ($_POST['funcion'] == 'buscar_nota') {
    $json = array();
    $id = $_POST['id'];
    $nota->buscar_datos($id);
    foreach ($nota->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'tipo_nota' => $objeto->tipo_nota,
            'dirigido' => $objeto->dirigido,
            'id_cargo' => $objeto->id_cargo,
            'id_sede' => $objeto->id_sede,
            'id_usuario' => $objeto->id_usuario,
            'fecha_ini' => $objeto->fecha_ini,
            'fecha_fin' => $objeto->fecha_fin,
            'descripcion_nota' => $objeto->descripcion_nota
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarNotaEdit') {
    $json = array();
    $id = $_POST['id'];
    $nota->cargarNota($id);
    foreach ($nota->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'tipo_nota' => $objeto->tipo_nota,
            'dirigido' => $objeto->dirigido,
            'id_cargo' => $objeto->id_cargo,
            'id_sede' => $objeto->id_sede,
            'id_usuario' => $objeto->id_usuario,
            'fecha_ini' => $objeto->fecha_ini,
            'fecha_fin' => $objeto->fecha_fin,
            'descripcion_nota' => $objeto->descripcion_nota
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarNotaImg') {
    $json = array();
    $id = $_POST['id'];
    $nota->cargarNota($id);
    foreach ($nota->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'tipo_nota' => $objeto->tipo_nota,
            'dirigido' => $objeto->dirigido,
            'imagen' => $objeto->imagen
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'changeImagen') {
    $id = $_POST['id'];
    if (($_FILES['imagen']['type'] == 'image/jpeg') || ($_FILES['imagen']['type'] == 'image/png') || ($_FILES['imagen']['type'] == 'image/gif')) {
        $img = uniqid() . "-" . $_FILES['imagen']['name'];
        $ruta = '../Recursos/img/notas/' . $img;
        if ($nota->cambiar_img($id, $img)) {
            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
            foreach ($nota->objetos as $objeto) {
                if ($objeto->imagen <> "") {
                    unlink('../Recursos/img/notas/' . $objeto->imagen);
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
                'alert' => 'Error al actualizar la imagén en base de datos'
            );
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }
    } else {
        $json = array();
        $json[] = array(
            'alert' => 'El formato de archivo seleccionado no es válido'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}

if ($_POST['funcion'] == 'editar_nota') {
    $nota->editar_nota($_POST['id'], $_POST['tipo'], $_POST['dirigido'], $_POST['id_cargo'], $_POST['id_sede'], $_POST['id_usuario'], $_POST['fechaini'], $_POST['fechafin'], $_POST['descripcion']);
}

if ($_POST['funcion'] == 'eliminarNota') {
    $nota->eliminarNota($_POST['id']);
}

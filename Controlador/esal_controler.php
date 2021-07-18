<?php
include_once '../Modelo/Esal.php';
$esal = new Esal();

if ($_POST['funcion'] == 'crear_esal') {
    $id_sede = $_POST['id_sede'];
    $nombre = $_POST['nombre'];
    $ano = $_POST['ano'];
    if ($_FILES['archivo']['name'] <> "") {
        $archivo = uniqid() . "-" . $_FILES['archivo']['name'];
        $ruta = '../Recursos/esal/' . $archivo;
        move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        $esal->crear($id_sede, $nombre, $ano, $archivo);
    }
}

if ($_POST['funcion'] == 'buscar_archivos') {
    $json = array();
    $esal->buscar_datos();
    foreach ($esal->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'id_sede' => $objeto->id_sede,
            'nombre' => $objeto->nombre,
            'ano' => $objeto->ano,
            'archivo' => $objeto->archivo
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarEsal') {
    $json = array();
    $id = $_POST['id'];
    $esal->cargarFoto($id);
    foreach ($esal->objetos as $objeto) {
        $json[] = array(
            'nombre' => utf8_encode($objeto->nombre),
            'ano' => $objeto->ano
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar_esal') {
    $esal->editar_esal($_POST['id'], $_POST['nombre'], $_POST['ano']);
}

if ($_POST['funcion'] == 'eliminarEsal') {
    $esal->eliminar_imagen($_POST['id']);
}

if ($_POST['funcion'] == 'listaEsalCol') {
    $ano = $_POST['ano'];
    $esal->listaEsalCol($ano);
    if (count($esal->objetos) > 0) {
        $json = array();
        foreach ($esal->objetos as $objeto) {
            $json[] = array(
                'nombre' => $objeto->nombre,
                'ano' => $objeto->ano,
                'archivo' => $objeto->archivo
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        echo 'No';
    }
}

if ($_POST['funcion'] == 'listaEsalReg') {
    $ano = $_POST['ano'];
    $id = $_POST['id'];
    $esal->listaEsalReg($ano, $id);
    if (count($esal->objetos) > 0) {
        $json = array();
        foreach ($esal->objetos as $objeto) {
            $json[] = array(
                'nombre' => $objeto->nombre,
                'ano' => $objeto->ano,
                'archivo' => $objeto->archivo
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        echo 'No';
    }
}

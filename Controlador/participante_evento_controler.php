<?php
include_once '../Modelo/ParticipanteEvento.php';
$participante = new ParticipanteEvento();

if ($_POST['funcion'] == 'listar_participantes') {
    $json = array();
    $participante->listar();
    foreach ($participante->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_participante' => $objeto->nombre_participante,
            'tipo_doc' => $objeto->tipo_doc,
            'documento' => $objeto->documento,
            'telefono' => $objeto->telefono,
            'email' => $objeto->email,
            'tipo_sangre' => $objeto->tipo_sangre,
            'nacionalidad' => $objeto->nacionalidad,
            'departamento_res' => $objeto->departamento_res,
            'municipio_res' => $objeto->municipio_res,
            'eps' => $objeto->eps,
            'fecha_inscripcion' => $objeto->fecha_inscripcion,
            'estado' => $objeto->estado
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargar_participante') {
    $json = array();
    $id = $_POST['id_participante'];
    $participante->cargarParticipante($id);
    foreach ($participante->objetos as $objeto) {
        $json[] = array(
            'nombre_participante' => $objeto->nombre_participante,
            'tipo_doc' => $objeto->tipo_doc,
            'documento' => $objeto->documento,
            'telefono' => $objeto->telefono,
            'email' => $objeto->email,
            'tipo_sangre' => $objeto->tipo_sangre,
            'nacionalidad' => $objeto->nacionalidad,
            'departamento_res' => $objeto->departamento_res,
            'municipio_res' => $objeto->municipio_res,
            'eps' => $objeto->eps,
            'fecha_inscripcion' => $objeto->fecha_inscripcion,
            'estado' => $objeto->estado
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'changeEstadoParticipante') {
    $participante->editar_estado($_POST['id'], $_POST['estado'], $_POST['id_evento']);
}

if ($_POST['funcion'] == 'inscribir_participante') {
    ini_set('date.timezone', 'America/Bogota');
    $fecha = date("Y") . "-" . date("m") . "-" . date("d");
    $participante->crear($_POST['id_evento'], $_POST['nombre_participante'], $_POST['tipo_doc'], $_POST['documento'], $_POST['fec_nac_part'], $_POST['telefono'], $_POST['email'], $_POST['tipo_sangre'], $_POST['nacionalidad'], $_POST['departamento_res'], $_POST['municipio_res'], $_POST['eps'], $fecha);    
}
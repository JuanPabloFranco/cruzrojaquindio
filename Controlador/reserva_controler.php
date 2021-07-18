<?php
include_once '../Modelo/Reserva.php';
include_once '../Modelo/Usuario.php';
$reserva = new Reserva();
$usuario = new Usuario();

if ($_POST['funcion'] == 'crear') {
    $estado_reserva = "Pendiente";
    date_default_timezone_set('America/Bogota');
    $create_at = date('m/d/Y h:i:s', time());
    $reserva->crear($_POST['id_visitante'], '1', '0000-00-00', '0000-00-00', $estado_reserva, $create_at);
}


if ($_POST['funcion'] == 'completar') {
    $estado_reserva = "Verificada";
    $id_visitante = "";
    if ($_POST['id_visitante'] == 0) {
        date_default_timezone_set('America/Bogota');
        $create_at = date('m/d/Y h:i:s', time());
        $avatar = 'avatar_default.png';
        $pass = md5($_POST['doc_id']);
        //crear visitante 
        $usuario->crear_usuario($_POST['nombre_completo'],$_POST['cel_usuario'],$_POST['doc_id'],$_POST['email_usuario'],1,4,$avatar,$pass,$_POST['id_nacionalidad'],$_POST['id_municipio'],$create_at);
        $user_id = $usuario->buscar_por_documento($_POST['doc_id']);
        echo "<pre>";
        print_r($user_id);
        echo "</pre>";

    }else{
        $id_visitante = $_POST['id_visitante'];
    }
    die("Murio");
    $reserva->completar($_POST['id'],$id_visitante, $_POST['id_descuento'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $estado_reserva, $_POST['valor_total']);
}

if ($_POST['funcion'] == 'buscar') {
    $json = array();
    $reserva->buscar();
    foreach ($reserva->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'fecha_inicio' => $objeto->fecha_inicio,
            'fecha_fin' => $objeto->fecha_fin,
            'estado_reserva' => $objeto->estado_reserva,
            'nombre_servicio' => $objeto->nombre_servicio,
            'nombre_descuento' => $objeto->nombre_descuento,
            'descuento' => $objeto->descuento,
            'cantidad' => $objeto->cantidad,
            'dia_noche' => $objeto->dia_noche,
            'dia_noche' => $objeto->dia_noche,
            'nombre_completo' => $objeto->nombre_completo,
            'doc_id' => $objeto->doc_id,
            'valor_servicio' => $objeto->valor_servicio
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargar') {
    $json = array();
    $id = $_POST['id'];
    $reserva->cargar($id);
    foreach ($reserva->objetos as $objeto) {
        $json[] = array(
            'estado_reserva' => $objeto->estado_reserva,
            'fecha_inicio' => $objeto->fecha_inicio,
            'fecha_fin' => $objeto->fecha_fin,
            'nombre_descuento' => $objeto->nombre_descuento,
            'descuento' => $objeto->descuento,
            'nombre_completo' => $objeto->nombre_completo,
            'doc_id' => $objeto->doc_id,
            'id_visitante' => $objeto->id_visitante,
            'id_descuento' => $objeto->id_descuento,
            'valor_total' => $objeto->valor_total
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar') {
    $reserva->editar($_POST['id'], $_POST['id_descuento'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['valor_total']);
}

if ($_POST['funcion'] == 'cambiar_estado') {
    $reserva->cambiar_estado($_POST['id'], $_POST['estado_reserva']);
}

if ($_POST['funcion'] == 'delete') {
    $reserva->delete($_POST['id']);
}

if ($_POST['funcion'] == 'count') {
    $reserva->count($_POST['id']);
    $count = $reserva;
    echo $count;
}


if ($_POST['funcion'] == 'reporteGeneral') {
    $json = array();
    $reserva->reporteGeneral();
    foreach ($visita->objetos as $objeto) {
        $json['data'][] = $objeto;
    }
    $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'estadisticas') {
    $json = array();
    $reserva->estadisticas();
    foreach ($visita->objetos as $objeto) {
        $json[] = array(
            'registrados' => $objeto->registrados,
            'pasadia' => $objeto->pasadia,
            'camping' => $objeto->camping,
            'quindio' => $objeto->quindio,
            'other' => $objeto->other,
            'extranjero' => $objeto->extranjero
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'listar_items') {
    $json = array();
    $reserva->listar_items();
    foreach ($reserva->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'fecha_inicio' => $objeto->fecha_inicio,
            'fecha_fin' => $objeto->fecha_fin,
            'estado_reserva' => $objeto->estado_reserva,
            'nombre_servicio' => $objeto->nombre_servicio,
            'nombre_descuento' => $objeto->nombre_descuento,
            'descuento' => $objeto->descuento,
            'cantidad' => $objeto->cantidad,
            'dia_noche' => $objeto->dia_noche,
            'dia_noche' => $objeto->dia_noche,
            'nombre_completo' => $objeto->nombre_completo,
            'doc_id' => $objeto->doc_id,
            'valor_servicio' => $objeto->valor_servicio
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

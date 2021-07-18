<?php
include_once '../Modelo/Visita.php';
include_once '../Modelo/Usuario.php';
$visita = new Visita();
$usuario = new Usuario();

if ($_POST['funcion'] == 'crear_visita') {
    $usuario->buscar_por_documento($_POST['documento']);
    date_default_timezone_set('America/Bogota');
    $create_at = date('m/d/Y h:i:s', time());
    if (isset($usuario->objetos[0]->id) && $usuario->objetos[0]->id <> "") {
        $visita->crear($usuario->objetos[0]->id, $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['id_servicio'], 'Terminada', $create_at);
    } else {
        if ($usuario->crear_usuario($_POST['nombre'], $_POST['cel_usuario'], $_POST['documento'], $_POST['email_usuario'], 1, 4, '', md5($_POST['documento']), $_POST['id_nacionalidad'], $_POST['id_municipio'], $create_at) == 'agregado') {
            $usuario->buscar_por_documento($_POST['documento']);
            if (isset($usuario->objetos[0]->id) && $usuario->objetos[0]->id <> "") {
                $visita->crear($usuario->objetos[0]->id, $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['id_servicio'], 'Terminada', $create_at);
            } else {
                echo "Error al buscar el id del visitante";
            }
        } else {
            echo "Error al crear el visitante";
        }
    }
}

if ($_POST['funcion'] == 'buscar_visitas') {
    $json = array();
    $visita->buscar_visitas();
    foreach ($visita->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_completo' => $objeto->nombre_completo,
            'estado_visita' => $objeto->estado_visita,
            'nombre_servicio' => $objeto->nombre_servicio,
            'fecha_inicio' => $objeto->fecha_inicio,
            'fecha_fin' => $objeto->fecha_fin,
            'cel_usuario' => $objeto->cel_usuario,
            'email_usuario' => $objeto->email_usuario,
            'municipio' => $objeto->municipio,
            'departamento' => $objeto->departamento
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'contar_visitas') {
    $json = array();
    $visita->contar_visitas();
    foreach ($visita->objetos as $objeto) {
        $json[] = array(
            'cantidad' => $objeto->cantidad
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'reporteGeneral') {
    $json = array();
    $visita->reporteGeneral();
    foreach ($visita->objetos as $objeto) {
        $json['data'][] = $objeto;
    }
    $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'estadisticas') {
    $json = array();
    $visita->estadisticas();
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

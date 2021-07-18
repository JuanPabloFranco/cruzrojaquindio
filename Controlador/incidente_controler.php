<?php
include_once '../Modelo/Incidente.php';
$incidente = new Incidente();

if ($_POST['funcion'] == 'crear_incidente') {
    $incidente->crear($_POST['id'], $_POST['id_region'], $_POST['fecha_creacion'], $_POST['fecha'], $_POST['hora'], $_POST['evento'], $_POST['tipo'], $_POST['departamento'], $_POST['municipio'], $_POST['direccion'], $_POST['cant_personal'], $_POST['personal'], $_POST['afectado'], $_POST['heridos'], $_POST['desaparecidos'], $_POST['muertos'], $_POST['lesionados'], $_POST['traslado'], $_POST['quien_traslado'], $_POST['viviendas_averiadas'], $_POST['viviendas_destruidas'], $_POST['familias_afectadas'], $_POST['otros'], $_POST['observaciones']);
}

if ($_POST['funcion'] == 'agregar_imagen') {
    if ($_FILES['imagen']['name'] <> "") {
        $id = $_POST['id'];
        if (($_FILES['imagen']['type'] == 'image/jpeg') || ($_FILES['imagen']['type'] == 'image/png') || ($_FILES['imagen']['type'] == 'image/gif')) {
            $imagen = uniqid() . "-" . $_FILES['imagen']['name'];
            $ruta = '../Recursos/img/incidentes/' . $imagen;
            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
            $incidente->agregar_imagen($id_incidente, $imagen);
        } else {
            echo "El archivo adjuntado no es aceptado";
        }
    }
}

if ($_POST['funcion'] == 'buscarIncidentes') {
    $json = array();
    $incidente->buscar_datos($_POST['id_region'],$_POST['id_cargo']);
    foreach ($incidente->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_region' => $objeto->nombre_region,
            'estado' => $objeto->estado,
            'fecha' => $objeto->fecha,
            'hora' => $objeto->hora,
            'evento' => $objeto->evento,
            'tipo' => $objeto->tipo,
            'departamento' => $objeto->departamento,
            'direccion' => $objeto->direccion,
            'municipio' => $objeto->municipio
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarIncidente') {
    $json = array();
    $id = $_POST['id'];
    $incidente->cargarIncidente($id);
    foreach ($incidente->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_voluntario' => $objeto->nombre_completo,
            'nombre_region' => $objeto->nombre_region,
            'fecha' => $objeto->fecha,
            'hora' => $objeto->hora,
            'estado' => $objeto->estado,
            'evento' => $objeto->evento,
            'tipo' => $objeto->tipo,
            'departamento' => $objeto->departamento,
            'municipio' => $objeto->municipio,
            'direccion' => $objeto->direccion,
            'cant_personal' => $objeto->cant_personal,
            'personal' => $objeto->personal,
            'afectado' => $objeto->afectado,
            'heridos' => $objeto->heridos,
            'desaparecidos' => $objeto->desaparecidos,
            'muertos' => $objeto->muertos,
            'lesionados' => $objeto->lesionados,
            'traslado' => $objeto->traslado,
            'quien_traslado' => $objeto->quien_traslado,
            'viviendas_averiadas' => $objeto->viviendas_averiadas,
            'viviendas_destruidas' => $objeto->viviendas_destruidas,
            'familias_afectadas' => $objeto->familias_afectadas,
            'otros' => $objeto->otros,
            'observaciones' => $objeto->observaciones
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cambiar_estado') {
    $incidente->cambiar_estado($_POST['id']);
}

if ($_POST['funcion'] == 'editar_incidente') {
    $incidente->editar_incidente($_POST['id'], $_POST['fecha'], $_POST['hora'], $_POST['evento'], $_POST['tipo'], $_POST['departamento'], $_POST['municipio'], $_POST['direccion'], $_POST['cant_personal'], $_POST['personal'], $_POST['afectado'], $_POST['heridos'], $_POST['desaparecidos'], $_POST['muertos'], $_POST['lesionados'], $_POST['traslado'], $_POST['quien_traslado'], $_POST['viviendas_averiadas'], $_POST['viviendas_destruidas'], $_POST['familias_afectadas'], $_POST['otros'], $_POST['observaciones']);
}

if ($_POST['funcion'] == 'estadisticas') {
    $json = array();
    $incidente->estadisticas($_POST['id_region'], $_POST['id_cargo']);
    foreach ($incidente->objetos as $objeto) {
        $json[] = array(
            'registrados' => $objeto->registrados,
            'nuevos' => $objeto->nuevos,
            'verificados' => $objeto->verificados,
            'personal' => $objeto->personal,
            'heridos' => $objeto->heridos,
            'desaparecidos' => $objeto->desaparecidos,
            'lesionados' => $objeto->lesionados,
            'muertos' => $objeto->muertos,
            'averiadas' => $objeto->averiadas,
            'destruidas' => $objeto->destruidas,
            'familias' => $objeto->familias
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'estadisticasRegiones') {
    $json = array();
    $incidente->estadisticasRegiones();
    foreach ($incidente->objetos as $objeto) {
        $json[] = array(
            'cantidad' => $objeto->cantidad,
            'nombre_region' => $objeto->nombre_region
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
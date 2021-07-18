<?php
include_once '../Modelo/Evento.php';
$evento = new Evento();
include_once '../Modelo/ParticipanteEvento.php';
$participante = new ParticipanteEvento();

if ($_POST['funcion'] == 'crear_evento') {
    $nombre_evento = $_POST['nombre_evento'];
    $fecha_inicial = $_POST['fecha_inicial'];
    $fecha_final = $_POST['fecha_final'];
    $total_cupos = $_POST['total_cupos'];
    $precio = $_POST['precio'];
    $tel_contacto = $_POST['tel_contacto'];
    $descripcion_evento = $_POST['descripcion_evento'];
    $id_organizador = $_POST['id_organizador'];
    $id_sede = $_POST['id_sede'];
    $id_servicio = $_POST['id_servicio'];
    if ($_FILES['imagen_evento']['name'] <> "") {
        if (($_FILES['imagen_evento']['type'] == 'image/jpeg') || ($_FILES['imagen_evento']['type'] == 'image/png') || ($_FILES['imagen_evento']['type'] == 'image/gif')) {
            $imagen_evento = uniqid() . "-" . $_FILES['imagen_evento']['name'];
            $ruta = '../Recursos/img/eventos/' . $imagen_evento;
            move_uploaded_file($_FILES['imagen_evento']['tmp_name'], $ruta);
            $evento->crear($nombre_evento, $fecha_inicial, $fecha_final, $descripcion_evento, $imagen_evento, $total_cupos, $precio, $tel_contacto, $id_organizador, $id_sede, $id_servicio);
        } else {
            echo "Tipo de archivo incorrecto";
        }
    } else {
        $imagen_evento = "logo.png";
        $evento->crear($nombre_evento, $fecha_inicial, $fecha_final, $descripcion_evento, $imagen_evento, $total_cupos, $precio, $tel_contacto, $id_organizador, $id_sede, $id_servicio);
    }
}

if ($_POST['funcion'] == 'buscar_evento') {
    $json = array();
    $evento->buscar_datos();
    foreach ($evento->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_evento' => $objeto->nombre_evento,
            'fecha_inicial' => $objeto->fecha_inicial,
            'fecha_final' => $objeto->fecha_final,
            'fecha_final' => $objeto->fecha_final,
            'total_cupos' => $objeto->total_cupos,
            'cupos_disp' => $objeto->cupos_disp,
            'tel_contacto' => $objeto->tel_contacto,
            'imagen_evento' => '../Recursos/img/eventos/' . $objeto->imagen_evento,
            'precio' => $objeto->precio,
            'nombre_servicio' => $objeto->nombre_servicio,
            'estado_evento' => $objeto->estado_evento,
            'descripcion_evento' => $objeto->descripcion_evento
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarEvento') {
    $json = array();
    $id = $_POST['id_evento'];
    $evento->cargarEvento($id);
    foreach ($evento->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre_evento' => $objeto->nombre_evento,
            'fecha_inicial' => $objeto->fecha_inicial,
            'fecha_final' => $objeto->fecha_final,
            'fecha_final' => $objeto->fecha_final,
            'total_cupos' => $objeto->total_cupos,
            'cupos_disp' => $objeto->cupos_disp,
            'tel_contacto' => $objeto->tel_contacto,
            'imagen_evento' => '../Recursos/img/eventos/' . $objeto->imagen_evento,
            'precio' => $objeto->precio,
            'nombre_servicio' => $objeto->nombre_servicio,
            'id_servicio' => $objeto->id_servicio,
            'estado_evento' => $objeto->estado_evento,
            'cupos_disp' => $objeto->cupos_disp,
            'descripcion_evento' => $objeto->descripcion_evento
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar_evento') {
    $id = $_POST['id_evento'];
    $nombre_evento = $_POST['nombre_evento'];
    $fecha_inicial = $_POST['fecha_inicial'];
    $fecha_final = $_POST['fecha_final'];
    $total_cupos = $_POST['total_cupos'];
    $participante->contarParticipante($id);
    foreach ($participante->objetos as $objeto) {
        $json[] = array(
            'cantidad' => $objeto->cantidad
        );
    }
    $cupos_disp = $total_cupos - $json[0]['cantidad'];
    $precio = $_POST['precio'];
    $tel_contacto = $_POST['tel_contacto'];
    $descripcion_evento = $_POST['descripcion_evento'];
    $id_servicio = $_POST['id_servicio'];
    $evento->editar_evento($id, $nombre_evento, $fecha_inicial, $fecha_final, $descripcion_evento, $total_cupos, $precio, $tel_contacto, $id_servicio, $cupos_disp);
}

if ($_POST['funcion'] == 'editar_imagen') {
    $id = $_POST['id'];
    if (($_FILES['imagen_evento']['type'] == 'image/jpeg') || ($_FILES['imagen_evento']['type'] == 'image/png') || ($_FILES['imagen_evento']['type'] == 'image/gif')) {
        $imagen_evento = uniqid() . "-" . $_FILES['imagen_evento']['name'];
        $ruta = '../Recursos/img/eventos/' . $imagen_evento;
        move_uploaded_file($_FILES['imagen_evento']['tmp_name'], $ruta);
        $evento->editar_imagen($id, $imagen_evento);
        foreach ($evento->objetos as $objeto) {
            if ($objeto->imagen_evento <> 'logo.png') {
                unlink('../Recursos/img/eventos/' . $objeto->imagen_evento);
            }
        }
        echo "update";
    } else {
        echo "El archivo seleccionado debe ser jpeg, png o gif";
    }
}

if ($_POST['funcion'] == 'changeEstadoEvento') {
    $evento->changeEstadoEvento($_POST['id']);
}

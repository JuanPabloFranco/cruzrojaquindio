<?php
include_once '../Modelo/Msj_contacto.php';
$msj = new Msj_contacto();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

if ($_POST['funcion'] == 'crear_mensaje') {
    $id_sede = $_POST['id_sede'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['msj'];
    $fecha = date("Y-m-d");
    $msj->crear($id_sede, $nombre, $email, $asunto, $mensaje,$fecha);
}

if ($_POST['funcion'] == 'buscar_msj') {
    $json = array();
    $msj->buscar_datos();
    foreach ($msj->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre' => $objeto->nombre,
            'email' => $objeto->email,
            'asunto' => $objeto->asunto,
            'mensaje' => $objeto->mensaje,
            'estado_msj' => $objeto->estado_msj,
            'fecha' => $objeto->fecha
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cargarMsj') {
    $json = array();
    $id = $_POST['id'];
    $msj->cargarMsj($id);
    foreach ($msj->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre' => $objeto->nombre,
            'email' => $objeto->email,
            'asunto' => $objeto->asunto,
            'mensaje' => $objeto->mensaje,
            'estado_msj' => $objeto->estado_msj,
            'fecha' => $objeto->fecha
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'changeVisto') {
    $msj->changeVisto($_POST['id']);    
}

if ($_POST['funcion'] == 'changeRes') {
    $msj->changeRes($_POST['id']);    
}

if ($_POST['funcion'] == 'contar_msj') {
    $json = array();
    $id_sede = $_POST['id_sede'];
    $msj->contar_msj($id_sede);
    foreach ($msj->objetos as $objeto) {
        $json[] = array(
            'cantidad' => $objeto->cantidad
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;   
}
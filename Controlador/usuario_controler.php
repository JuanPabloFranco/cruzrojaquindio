<?php
include_once '../Modelo/Usuario.php';
$usuario = new Usuario();
session_start();
if ($_POST['funcion'] == 'buscar_datos_general') {
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->buscar_datos_general($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        $nac = new DateTime($objeto->fecha_nac);
        $edad = $nac->diff($fecha_actual);
        $edad_years = $edad->y;
        $json[] = array(
            'dir_usuario' => $objeto->dir_usuario,
            'doc_id' => $objeto->doc_id,
            'edad_usuario' => $edad_years,
            'fecha_nac' => $objeto->fecha_nac,
            'genero' => $objeto->genero,
            'tel_usuario' => $objeto->tel_usuario,
            'cel_usuario' => $objeto->cel_usuario,
            'fecha_nac' => $objeto->fecha_nac,
            'email_usuario' => $objeto->email_usuario,
            'nombre_cargo' => $objeto->nombre_cargo,
            'nombre_tipo' => $objeto->nombre_tipo,
            'avatar' => '../Recursos/img/avatars/' . $objeto->avatar,
            'nombre_sede' => $objeto->nombre_sede,
            'inf_usuario' => $objeto->inf_usuario
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'llenar_datos') {
    $json = array();
    $id_usuario = $_POST['id_usuario'];
    $usuario->buscar_datos_general($id_usuario);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'nombre_completo' => $objeto->nombre_completo,
            'doc_id' => $objeto->doc_id,
            'dir_usuario' => $objeto->dir_usuario,
            'tel_usuario' => $objeto->tel_usuario,
            'cel_usuario' => $objeto->cel_usuario,
            'genero' => $objeto->genero,
            'lugar_nac' => $objeto->lugar_nac,
            'fecha_nac' => $objeto->fecha_nac,
            'email_usuario' => $objeto->email_usuario,
            'inf_usuario' => $objeto->inf_usuario,
            'twitter' => $objeto->twitter,
            'facebook' => $objeto->facebook,
            'instagram' => $objeto->instagram
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar_general') {
    $usuario->editar_general($_POST['id_usuario'], $_POST['nombre'], $_POST['doc_id'], $_POST['fecha_nac'], $_POST['lugarNac'], $_POST['telefono'], $_POST['celular'], $_POST['direccion'], $_POST['email'], $_POST['inf_usuario'], $_POST['twitter'], $_POST['fb'], $_POST['instagram'], $_POST['genero']);
}

if ($_POST['funcion'] == 'changePass') {
    $nameUser = $_POST['nameUser'];
    $id_usuario = $_POST['id_usuario'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $usuario->update_pass($id_usuario, $nameUser, $oldpass, $newpass);
}
if ($_POST['funcion'] == 'changeAvatar') {
    $id_usuario = $_SESSION['id_user'];
    if (($_FILES['avatar']['type'] == 'image/jpeg') || ($_FILES['avatar']['type'] == 'image/png') || ($_FILES['avatar']['type'] == 'image/gif')) {
        $avatar = uniqid() . "-" . $_FILES['avatar']['name'];
        $ruta = '../Recursos/img/avatars/' . $avatar;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $ruta);
        $usuario->cambiar_avatar($id_usuario, $avatar);
        foreach ($usuario->objetos as $objeto) {
            if ($objeto->avatar <> 'avatar_default.png') {
                unlink('../Recursos/img/avatars/' . $objeto->avatar);
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
            'alert' => 'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}

if ($_POST['funcion'] == 'buscar_gestion_usuario') {
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->buscar_datos_adm();
    foreach ($usuario->objetos as $objeto) {
        $nac = new DateTime($objeto->fecha_nac);
        $edad = $nac->diff($fecha_actual);
        $edad_years = $edad->y;
        $json[] = array(
            'id' => $objeto->id,
            'nombre_completo' => $objeto->nombre_completo,
            'edad' => $edad_years,
            'fecha_nac' => $objeto->fecha_nac,
            'cel_usuario' => $objeto->cel_usuario,
            'tel_usuario' => $objeto->tel_usuario,
            'dir_usuario' => $objeto->dir_usuario,
            'genero' => $objeto->genero,
            'email_usuario' => $objeto->email_usuario,
            'nombre_tipo' => $objeto->nombre_tipo,
            'tipo_usuario' => $objeto->id_tipo_usuario,
            'avatar' => '../Recursos/img/avatars/' . $objeto->avatar,
            'nombre_cargo' => $objeto->nombre_cargo,
            'nombre_sede' => $objeto->nombre_sede,
            'twitter' => $objeto->twitter,
            'facebook' => $objeto->facebook,
            'instagram' => $objeto->instagram,
            'estado' => $objeto->estado,
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if ($_POST['funcion'] == 'crear_usuario') {
    $nombre = $_POST['nombre'];
    $documento = $_POST['documento'];
    $id_cargo = $_POST['id_cargo'];
    $id_sede = $_POST['id_sede'];
    $avatar = 'avatar_default.png';
    $tipo = 3;
    $pass = md5($documento);
    $usuario->crear_usuario($nombre, $documento, $id_cargo, $id_sede, $tipo, $avatar, $pass);
}

if ($_POST['funcion'] == 'ascender') {
    $id = $_POST['id'];
    $pass = md5($_POST['pass']);
    $usuario->ascender($id, $pass, $_SESSION['id_user']);
}

if ($_POST['funcion'] == 'descender') {
    $id = $_POST['id'];
    $pass = md5($_POST['pass']);
    $usuario->descender($id, $pass, $_SESSION['id_user']);
}

if ($_POST['funcion'] == 'activacion') {
    $id = $_POST['id'];
    $pass = md5($_POST['pass']);
    $estado = $_POST['estado'];
    $usuario->activacion($id, $pass, $_SESSION['id_user'], $estado);
}

if ($_POST['funcion'] == 'restablecer_login') {
    $id = $_POST['id'];
    $pass = md5($_POST['pass']);
    $usuario->restablecer_login($id, $pass, $_SESSION['id_user']);
}

if ($_POST['funcion'] == 'buscarAvatar') {
    $json = array();
    $usuario->buscar_avatar($_POST['id']);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'avatar' => '../Recursos/img/avatars/' . $objeto->avatar
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'update_familiar') {
    $id = $_POST['id_usuario'];
    $madre = $_POST['madre'];
    $ocuMadre = $_POST['ocuMadre'];
    $telMadre = $_POST['telMadre'];
    $padre = $_POST['padre'];
    $ocuPadre = $_POST['ocuPadre'];
    $telPadre = $_POST['telPadre'];
    $conEmergencia = $_POST['conEmergencia'];
    $parentezco = $_POST['parentezco'];
    $telEmergencia = $_POST['telEmergencia'];
    $usuario->update_familiar($id, $madre, $ocuMadre, $telMadre, $padre, $ocuPadre, $telPadre, $conEmergencia, $parentezco, $telEmergencia);
}

if ($_POST['funcion'] == 'buscarInfUsuario') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->cargarusuarioEdit($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'nombre_madre' => $objeto->nombre_madre,
            'ocupacion_madre' => $objeto->ocupacion_madre,
            'tel_madre' => $objeto->tel_madre,
            'nombre_padre' => $objeto->nombre_padre,
            'ocupacion_padre' => $objeto->ocupacion_padre,
            'tel_padre' => $objeto->tel_padre,
            'contacto_emergencia' => $objeto->contacto_emergencia,
            'parentezco_emergencia' => $objeto->parentezco_emergencia,
            'cel_emergencia' => $objeto->cel_emergencia,

            'formacion_prof' => $objeto->formacion_prof,
            'ocupacion' => $objeto->ocupacion,
            'lab_emp' => $objeto->lab_emp,
            'dir_lab' => $objeto->dir_lab,
            'tel_lab' => $objeto->tel_lab,
            'cargo_lab' => $objeto->cargo_lab,

            'eps' => $objeto->eps,
            'carnet' => $objeto->carnet,
            'tipo_sangre' => $objeto->tipo_sangre,
            'pension' => $objeto->pension,
            'arl' => $objeto->arl,
            'caja_compensacion' => $objeto->caja_compensacion,

            'estado_civil' => $objeto->estado_civil,
            'estrato' => $objeto->estrato,
            'grupo_etnico' => $objeto->grupo_etnico,
            'personas_cargo' => $objeto->personas_cargo,
            'cabeza_familia' => $objeto->cabeza_familia,
            'hijos' => $objeto->hijos,
            'fuma' => $objeto->fuma,
            'fuma_frecuencia' => $objeto->fuma_frecuencia,
            'bebidas' => $objeto->bebidas,
            'bebe_frecuencia' => $objeto->bebe_frecuencia,
            'deporte' => $objeto->deporte,
            'deporte_frecuencia' => $objeto->deporte_frecuencia,
            'talla_camisa' => $objeto->talla_camisa,
            'talla_pantalon' => $objeto->talla_pantalon,
            'talla_calzado' => $objeto->talla_calzado,
            'tipo_vivienda' => $objeto->tipo_vivienda,
            'licencia_conduccion' => $objeto->licencia_conduccion,
            'licencia_descr' => $objeto->licencia_descr,
            'act_tiempo_libre' => $objeto->act_tiempo_libre
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'update_sociodemografica') {
    $id = $_POST['id_usuario'];
    $estrato = $_POST['estrato'];
    $estado_civil = $_POST['estado_civil'];
    $grupo_etnico = $_POST['grupo_etnico'];
    $personas_cargo = $_POST['personas_cargo'];
    $cabeza_familia = $_POST['cabeza_familia'];
    $hijos = $_POST['hijos'];
    $fuma = $_POST['fuma'];
    $fuma_frecuencia = $_POST['fuma_frecuencia'];
    $bebidas = $_POST['bebidas'];
    $bebe_frecuencia = $_POST['bebe_frecuencia'];
    $deporte = $_POST['deporte'];
    $deporte_frecuencia = $_POST['deporte_frecuencia'];
    $talla_camisa = $_POST['talla_camisa'];
    $talla_pantalon = $_POST['talla_pantalon'];
    $talla_calzado = $_POST['talla_calzado'];
    $tipo_vivienda = $_POST['tipo_vivienda'];
    $licencia_conduccion = $_POST['licencia_conduccion'];
    $licencia_descr = $_POST['licencia_descr'];
    $act_tiempo_libre = $_POST['act_tiempo_libre'];
    $usuario->update_sociodemografica($id, $estrato, $estado_civil, $grupo_etnico, $personas_cargo, $cabeza_familia, 
    $hijos, $fuma, $fuma_frecuencia, $bebidas, $bebe_frecuencia, $deporte, $deporte_frecuencia, 
    $talla_camisa, $talla_pantalon, $talla_calzado, $tipo_vivienda, $licencia_conduccion, $licencia_descr, $act_tiempo_libre);
}

if ($_POST['funcion'] == 'crear_estudio') {
    $id = $_POST['id_usuario'];
    $nivel = $_POST['nivel'];
    $tipo = $_POST['tipo'];
    $titulo = $_POST['titulo'];
    $institucion = $_POST['institucion'];
    $año = $_POST['año'];
    $ciudad = $_POST['ciudad'];
    $usuario->crear_estudio($id, $nivel, $tipo, $titulo, $institucion, $año, $ciudad);
}

if ($_POST['funcion'] == 'buscarEstudios') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarEstudios($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nivel' => $objeto->nivel,
            'tipo_nivel' => $objeto->tipo_nivel,
            'titulo' => $objeto->titulo,
            'institucion' => $objeto->institucion,
            'ano' => $objeto->ano,
            'ciudad' => $objeto->ciudad
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'crear_otro_estudio') {
    $id = $_POST['id_usuario'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $usuario->crear_otro_estudio($id, $tipo, $descripcion);
}

if ($_POST['funcion'] == 'buscarOtrosEstudios') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarOtrosEstudios($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'tipo' => $objeto->tipo,
            'descripcion' => $objeto->descripcion
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'update_laboral') {
    $id = $_POST['id_usuario'];
    $profesion = $_POST['profesion'];
    $ocupacion = $_POST['ocupacion'];
    $empresa = $_POST['empresa'];
    $cargo = $_POST['cargo'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $usuario->update_laboral($id, $profesion, $ocupacion, $empresa, $cargo, $direccion, $telefono);
}

if ($_POST['funcion'] == 'buscarMedicamentos') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarMedicamento($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre' => $objeto->nombre,
            'indicaciones' => $objeto->indicaciones
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'buscarMedicamento') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarMedicamento($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre' => $objeto->nombre,
            'indicaciones' => $objeto->indicaciones
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'buscarEnfermedades') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarEnfermedades($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre' => $objeto->nombre
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'buscarAlergias') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarAlergias($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'tipo' => $objeto->tipo,
            'nombre' => $objeto->nombre
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'buscarCirugias') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarCirugias($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'nombre' => $objeto->nombre
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'buscarLesiones') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarLesiones($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'tipo' => $objeto->tipo,
            'nombre' => $objeto->nombre
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'buscarAntecedentes') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarAntecedentes($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'nombre' => $objeto->nombre
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'buscarCursos') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarCursos($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'fecha' => $objeto->fecha,
            'institucion' => $objeto->institucion,
            'descripcion' => $objeto->descripcion,
            'horas' => $objeto->horas
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'crear_medicamento') {
    $id = $_POST['id_usuario'];
    $medicamento = $_POST['medicamento'];
    $indicaciones = $_POST['indicaciones'];
    $usuario->crear_medicamento($id, $medicamento, $indicaciones);
}

if ($_POST['funcion'] == 'crear_enfermedad') {
    $id = $_POST['id_usuario'];
    $enfermedad = $_POST['enfermedad'];
    $usuario->crear_enfermedad($id, $enfermedad);
}

if ($_POST['funcion'] == 'crear_alergia') {
    $id = $_POST['id_usuario'];
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $usuario->crear_alergia($id, $tipo, $nombre);
}

if ($_POST['funcion'] == 'crear_cirugia') {
    $id = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $usuario->crear_cirugia($id, $nombre);
}

if ($_POST['funcion'] == 'crear_lesion') {
    $id = $_POST['id_usuario'];
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $usuario->crear_lesion($id, $tipo, $nombre);
}

if ($_POST['funcion'] == 'crear_antecedente') {
    $id = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $usuario->crear_antecedente($id, $nombre);
}

if ($_POST['funcion'] == 'crear_curso') {
    $id = $_POST['id_usuario'];
    $fecha = $_POST['fecha'];
    $institucion = $_POST['institucion'];
    $descripcion = $_POST['descripcion'];
    $horas = $_POST['horas'];
    $usuario->crear_curso($id, $fecha, $institucion, $descripcion, $horas);
}

if ($_POST['funcion'] == 'update_salud') {
    $id = $_POST['id_usuario'];
    $eps = $_POST['eps'];
    $carnet = $_POST['carnet'];
    $tipo_sangre = $_POST['tipo_sangre'];
    $arl = $_POST['arl'];
    $pension = $_POST['pension'];
    $caja_compensacion = $_POST['caja_compensacion'];
    $usuario->update_salud($id, $eps, $carnet, $tipo_sangre, $arl, $pension, $caja_compensacion);
}

if ($_POST['funcion'] == 'eliminar_estudio') {
    $id = $_POST['id'];
    $usuario->delEstudio($id);
}

if ($_POST['funcion'] == 'eliminar_otro_estudio') {
    $id = $_POST['id'];
    $usuario->delOtroEstudio($id);
}

if ($_POST['funcion'] == 'eliminar_medicamento') {
    $id = $_POST['id'];
    $usuario->delMedicamento($id);
}

if ($_POST['funcion'] == 'eliminar_enfermedad') {
    $id = $_POST['id'];
    $usuario->delEnfermedad($id);
}

if ($_POST['funcion'] == 'eliminar_alergia') {
    $id = $_POST['id'];
    $usuario->delAlergia($id);
}

if ($_POST['funcion'] == 'eliminar_cirugia') {
    $id = $_POST['id'];
    $usuario->delCirugia($id);
}

if ($_POST['funcion'] == 'eliminar_lesion') {
    $id = $_POST['id'];
    $usuario->delLesion($id);
}

if ($_POST['funcion'] == 'eliminar_antecedente') {
    $id = $_POST['id'];
    $usuario->delAntecedente($id);
}

if ($_POST['funcion'] == 'eliminar_curso') {
    $id = $_POST['id'];
    $usuario->delCurso($id);
}

if ($_POST['funcion'] == 'crear_soporte') {
    $id_usuario = $_POST['id_usuario'];
    $tipo_soporte = $_POST['tipo_soporte'];
    $nombre_soporte = $_POST['nombre_soporte'];
    if (($_FILES['soporte']['type'] == 'image/jpeg') || ($_FILES['soporte']['type'] == 'image/png') || ($_FILES['soporte']['type'] == 'image/gif')) {
        $soport = uniqid() . "-" . $_FILES['soporte']['name'];
        $ruta = '../Recursos/img/soportes_usuario/' . $soport;
        move_uploaded_file($_FILES['soporte']['tmp_name'], $ruta);
        $usuario->crear_soporte($id_usuario, $tipo_soporte, $nombre_soporte, $soport);
    } else {
        echo 'El tipo de archivo seleccionado no es válido';
    }
}

if ($_POST['funcion'] == 'buscarSoportes') {
    $json = array();
    $id = $_POST['id_usuario'];
    $usuario->buscarSoportes($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id,
            'tipo_soporte' => $objeto->tipo_soporte,
            'nombre_soporte' => $objeto->nombre_soporte,
            'soporte' => $objeto->soporte
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'eliminar_soporte') {
    $id = $_POST['id'];
    $usuario->delSoporte($id);
    unlink('../Recursos/img/soportes_usuario/' . $_POST['soporte']);
}

if ($_POST['funcion'] == 'cargarCc') {
    $json = array();
    $id = $_POST['id'];
    $usuario->cargarCc($id);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'doc_id' => $objeto->doc_id,
            'id_sede' => $objeto->id_sede,
            'id_cargo' => $objeto->id_cargo
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'update_cc') {
    $id = $_POST['id'];
    $doc = $_POST['doc'];
    $id_cargo = $_POST['id_cargo'];
    $id_sede = $_POST['id_sede'];
    $usuario->update_cc($id, $doc, $id_sede, $id_cargo);
}

if ($_POST['funcion'] == 'reporteGeneral') {
    $json = array();
    $id_sede = $_POST['id_sede'];
    $id_tipo = $_POST['id_tipo'];
    $id_cargo = $_POST['id_cargo'];
    $usuario->reporteGeneral($id_sede, $id_tipo, $id_cargo);
    foreach ($usuario->objetos as $objeto) {
        $json['data'][] = $objeto;
    }
    $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'estadisticas') {
    $json = array();
    $usuario->estadisticas($_POST['id_sede'], $_POST['id_cargo']);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'registrados' => $objeto->registrados,
            'activos' => $objeto->activos,
            'inactivos' => $objeto->inactivos,
            'faltantes' => $objeto->faltantes
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}


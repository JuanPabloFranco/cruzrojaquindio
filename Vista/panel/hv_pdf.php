<?php
ob_start();
$fecha = date("Y-m-d");
?><html>

<body>
    <?php
    require '../Recursos/fpdf/plantillas/PDFCarta.php';
    include_once '../Conexion/consulSQL.php';
    $pdf = new PDFCarta('P', 'mm', array(216, 280));

    // estado civil 28
    $sqlusuario = "SELECT U.nombre_completo, U.doc_id, U.dir_usuario, U.tel_usuario, U.cel_usuario, U.email_usuario, U.fecha_nac, U.avatar, U.formacion_prof, U.ocupacion, U.lab_emp, U.cargo_lab, U.dir_lab, U.tel_lab, 
    U.nombre_madre, U.ocupacion_madre, U.tel_madre, U.nombre_padre, U.ocupacion_padre, U.tel_padre, U.contacto_emergencia, U.parentezco_emergencia, U.cel_emergencia,U.eps, U.carnet, U.tipo_sangre, U.soporte_cedula, 
    U.lugar_nac, U.estado_civil, U.personas_cargo, U.hijos, U.fuma, U.fuma_frecuencia, U.bebidas, U.bebe_frecuencia, U.deporte, U.deporte_frecuencia, U.talla_camisa, U.talla_pantalon, U.talla_calzado, U.grupo_etnico, 
    U.tipo_vivienda, U.cabeza_familia, U.licencia_conduccion, U.licencia_descr, U.act_tiempo_libre, U.estrato, U.pension, U.arl, U.caja_compensacion FROM usuario U WHERE id=" . $_GET['id'];
    $vecResVol = mysqli_fetch_row(ejecutarSQL::consultar($sqlusuario));
    $medicamentos = ejecutarSQL::consultar("SELECT * FROM medicamentos WHERE id_usuario=" . $_GET['id']);
    $enfermedades = ejecutarSQL::consultar("SELECT * FROM enfermedad WHERE id_usuario=" . $_GET['id']);
    $alergias = ejecutarSQL::consultar("SELECT * FROM alergias WHERE id_usuario=" . $_GET['id']);
    $lesiones = ejecutarSQL::consultar("SELECT * FROM lesiones WHERE id_usuario=" . $_GET['id']);
    $cirugias = ejecutarSQL::consultar("SELECT * FROM cirugias WHERE id_usuario=" . $_GET['id']);
    $antecedentes = ejecutarSQL::consultar("SELECT * FROM antecedentes WHERE id_usuario=" . $_GET['id']);
    $estudios = ejecutarSQL::consultar("SELECT * FROM estudios WHERE id_usuario=" . $_GET['id']);
    $otros_estudios = ejecutarSQL::consultar("SELECT * FROM otros_estudios WHERE id_usuario=" . $_GET['id']);
    $cursos = ejecutarSQL::consultar("SELECT * FROM cursos WHERE id_usuario=" . $_GET['id']);
    $soportes = ejecutarSQL::consultar("SELECT * FROM soportes_usuario WHERE id_usuario=" . $_GET['id'] . " ORDER BY FIELD (tipo_soporte,'Documento de Identidad','EPS ó Médico','Estudio Acádemico','Curso')");

    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetMargins(10, 23, 23);

    $pdf->Ln(20);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(195, 4, utf8_decode('1. INFORMACIÓN GENERAL'), 1, 0, 'C', 1);
    //Nombre
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(69, 3, 'NOMBRES Y APELLIDOS', 1, 0, 'C', 1);
    $pdf->Cell(40, 3, 'No. DE DOCUMENTO', 1, 0, 'C', 1);
    $pdf->Cell(25, 3, utf8_decode('TELÉFONO'), 1, 0, 'C', 1);
    $pdf->Cell(25, 3, utf8_decode('CELULAR'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(69, 4, utf8_decode($vecResVol[0]), 1, 0, 'C', 1);
    $pdf->Cell(40, 4, utf8_decode($vecResVol[1]), 1, 0, 'C', 1);
    $pdf->Cell(25, 4, utf8_decode($vecResVol[3]), 1, 0, 'C', 1);
    $pdf->Cell(25, 4, utf8_decode($vecResVol[4]), 1, 0, 'C', 1);
    $pdf->Image('../Recursos/img/avatars/' . $vecResVol[7], 171, 34.2, 33, 35);

    // DATOS RENGLON 2
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(95, 3, utf8_decode('DIRECCIÓN DE RESIDENCIA'), 1, 0, 'C', 1);
    $pdf->Cell(64, 3, utf8_decode('EMAIL'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(95, 4, utf8_decode($vecResVol[2]), 1, 0, 'C', 1);
    $pdf->Cell(64, 4, utf8_decode($vecResVol[5]), 1, 0, 'C', 1);
    
    
    // DATOS RENGLON 2
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(30, 3, 'FECHA DE NACIMIENTO', 1, 0, 'C', 1);
    $pdf->Cell(49, 3, utf8_decode('LUGAR DE NACIMIENTO'), 1, 0, 'C', 1);
    $pdf->Cell(36, 3, utf8_decode('LICENCIA DE CONDUCCIÓN'), 1, 0, 'C', 1);
    $pdf->Cell(14, 3, utf8_decode('CAMISA'), 1, 0, 'C', 1);
    $pdf->Cell(15, 3, utf8_decode('PANTALÓN'), 1, 0, 'C', 1);
    $pdf->Cell(15, 3, utf8_decode('CALZADO'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 4, utf8_decode($vecResVol[6]), 1, 0, 'C', 1);
    $pdf->Cell(49, 4, utf8_decode($vecResVol[27]), 1, 0, 'C', 1);
    $pdf->Cell(36, 4, utf8_decode($vecResVol[43]." / ".$vecResVol[44]), 1, 0, 'C', 1);
    $pdf->Cell(14, 4, utf8_decode($vecResVol[37]), 1, 0, 'C', 1);
    $pdf->Cell(15, 4, utf8_decode($vecResVol[38]), 1, 0, 'C', 1);
    $pdf->Cell(15, 4, utf8_decode($vecResVol[39]), 1, 0, 'C', 1);


    // DATOS RENGLON 3
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(30, 3, utf8_decode('ESTADO CIVIL'), 1, 0, 'C', 1);
    $pdf->Cell(20, 3, 'ESTRATO', 1, 0, 'C', 1);
    $pdf->Cell(29, 3, utf8_decode('GRUPO ETNICO'), 1, 0, 'C', 1);
    $pdf->Cell(30, 3, utf8_decode('TIPO VIVIENDA'), 1, 0, 'C', 1);
    $pdf->Cell(30, 3, utf8_decode('CABEZA FAMILIA'), 1, 0, 'C', 1);
    $pdf->Cell(20, 3, utf8_decode('HIJOS'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 4, utf8_decode($vecResVol[28]), 1, 0, 'C', 1);
    $pdf->Cell(20, 4, utf8_decode($vecResVol[46]), 1, 0, 'C', 1);
    $pdf->Cell(29, 4, utf8_decode($vecResVol[40]), 1, 0, 'C', 1);
    $pdf->Cell(30, 4, utf8_decode($vecResVol[41]), 1, 0, 'C', 1);
    $pdf->Cell(30, 4, utf8_decode($vecResVol[42]), 1, 0, 'C', 1);
    $pdf->Cell(20, 4, utf8_decode($vecResVol[30]), 1, 0, 'C', 1);
    
    // DATOS RENGLON 4
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(79, 3, utf8_decode('DEPORTES QUE PRACTICA'), 1, 0, 'C', 1);
    $pdf->Cell(80, 3, utf8_decode('FRECUENCIA DEPORTE'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(79, 4, utf8_decode($vecResVol[35]), 1, 0, 'C', 1);
    $pdf->Cell(80, 4, utf8_decode($vecResVol[36]), 1, 0, 'C', 1);

    // DATOS RENGLON 4
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(195, 3, utf8_decode('ACTIVIDADES DE TIEMPO LIBRE'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(195, 4, utf8_decode($vecResVol[45]), 1, 0, 'C', 1);

    // DATOS RENGLON 4
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(31, 3, utf8_decode('PERSONAS A CARGO'), 1, 0, 'C', 1);
    $pdf->Cell(82, 3, utf8_decode('CIGARRILLO Y FRECUENCIA EN QUE FUMA'), 1, 0, 'C', 1);
    $pdf->Cell(82, 3, utf8_decode('BEBIDAS ALCOHOLICAS Y FRECUENCIA DE CONSUMO'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(31, 4, utf8_decode($vecResVol[29]), 1, 0, 'C', 1);
    $pdf->Cell(82, 4, utf8_decode($vecResVol[31]), 1, 0, 'C', 1);
    $pdf->Cell(82, 4, utf8_decode($vecResVol[32]), 1, 0, 'C', 1); 

    // DATOS RENGLON 4
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(97, 3, utf8_decode('FORMACIÓN PROFESIONAL'), 1, 0, 'C', 1);
    $pdf->Cell(98, 3, utf8_decode('OCUPACIÓN Y OFICIO'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(97, 4, utf8_decode($vecResVol[8]), 1, 0, 'C', 1);
    $pdf->Cell(98, 4, utf8_decode($vecResVol[9]), 1, 0, 'C', 1);

    // DATOS RENGLON 5
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(97, 3, utf8_decode('EMPRESA EN QUE LABORA'), 1, 0, 'C', 1);
    $pdf->Cell(98, 3, utf8_decode('CARGO'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(97, 4, utf8_decode($vecResVol[10]), 1, 0, 'C', 1);
    $pdf->Cell(98, 4, utf8_decode($vecResVol[11]), 1, 0, 'C', 1);

    // DATOS RENGLON 6
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(155, 3, utf8_decode('DIRECCIÓN LABORAL'), 1, 0, 'C', 1);
    $pdf->Cell(40, 3, utf8_decode('TELÉFONO'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(155, 4, utf8_decode($vecResVol[12]), 1, 0, 'C', 1);
    $pdf->Cell(40, 4, utf8_decode($vecResVol[13]), 1, 0, 'C', 1);

    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(195, 4, utf8_decode('2. INFORMACIÓN FAMILIAR'), 1, 0, 'C', 1);

    // DATOS RENGLON 7
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(79, 3, utf8_decode('NOMBRE DE LA MADRE'), 1, 0, 'C', 1);
    $pdf->Cell(80, 3, utf8_decode('OCUPACIÓN U OFICIO'), 1, 0, 'C', 1);
    $pdf->Cell(36, 3, utf8_decode('TELÉFONO'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(79, 4, utf8_decode($vecResVol[14]), 1, 0, 'C', 1);
    $pdf->Cell(80, 4, utf8_decode($vecResVol[15]), 1, 0, 'C', 1);
    $pdf->Cell(36, 4, utf8_decode($vecResVol[16]), 1, 0, 'C', 1);

    // DATOS RENGLON 8
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(79, 3, utf8_decode('NOMBRE DEL PADRE'), 1, 0, 'C', 1);
    $pdf->Cell(80, 3, utf8_decode('OCUPACIÓN U OFICIO'), 1, 0, 'C', 1);
    $pdf->Cell(36, 3, utf8_decode('TELÉFONO'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(79, 4, utf8_decode($vecResVol[17]), 1, 0, 'C', 1);
    $pdf->Cell(80, 4, utf8_decode($vecResVol[18]), 1, 0, 'C', 1);
    $pdf->Cell(36, 4, utf8_decode($vecResVol[19]), 1, 0, 'C', 1);
    // DATOS RENGLON 9
    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(79, 3, utf8_decode('EN CASO DE EMERGENCIA LLAMAR A'), 1, 0, 'C', 1);
    $pdf->Cell(80, 3, utf8_decode('PARENTEZCO'), 1, 0, 'C', 1);
    $pdf->Cell(36, 3, utf8_decode('CELULAR'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(79, 4, utf8_decode($vecResVol[20]), 1, 0, 'C', 1);
    $pdf->Cell(80, 4, utf8_decode($vecResVol[21]), 1, 0, 'C', 1);
    $pdf->Cell(36, 4, utf8_decode($vecResVol[22]), 1, 0, 'C', 1);

    $pdf->Ln(8);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(195, 4, utf8_decode('3. INFORMACIÓN MÉDICA'), 1, 0, 'C', 1);

    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(10, 4, utf8_decode('EPS'), 1, 0, 'C', 1);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 4, utf8_decode($vecResVol[23]), 1, 0, 'C', 1);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(32, 4, utf8_decode('TIPO SANGRE'), 1, 0, 'C', 1);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(40, 4, utf8_decode($vecResVol[25]), 1, 0, 'C', 1);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(30, 4, utf8_decode('CARNET No.'), 1, 0, 'C', 1);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(38, 4, utf8_decode($vecResVol[24]), 1, 0, 'C', 1);

    $pdf->Ln(4);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(10, 4, utf8_decode('ARL'), 1, 0, 'C', 1);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 4, utf8_decode($vecResVol[23]), 1, 0, 'C', 1);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(32, 4, utf8_decode('PENSIÓN'), 1, 0, 'C', 1);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(40, 4, utf8_decode($vecResVol[25]), 1, 0, 'C', 1);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(30, 4, utf8_decode('CAJA COMPENSACIÓN'), 1, 0, 'C', 1);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(38, 4, utf8_decode($vecResVol[24]), 1, 0, 'C', 1);

    if (mysqli_num_rows($medicamentos) > 0) {
        $pdf->Ln(4);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(195, 4, utf8_decode('MEDICAMENTOS'), 1, 0, 'C', 1);
        $pdf->Ln(4);
        $pdf->Cell(70, 4, utf8_decode('NOMBRE MEDICAMENTO'), 1, 0, 'C', 1);
        $pdf->Cell(125, 4, utf8_decode('DOSIS O INDICACIONES'), 1, 0, 'C', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 10);
        while ($med = mysqli_fetch_array($medicamentos)) {
            $pdf->Ln(4);
            $pdf->Cell(70, 4, utf8_decode($med['nombre']), 1, 0, 'C', 1);
            $pdf->Cell(125, 4, utf8_decode($med['indicaciones']), 1, 0, 'C', 1);
        }
    }

    if (mysqli_num_rows($enfermedades) > 0) {
        $pdf->Ln(4);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(195, 4, utf8_decode('ENFERMEDADES'), 1, 0, 'C', 1);
        $pdf->Ln(4);
        $pdf->Cell(40, 4, utf8_decode("Nombre Enfermedad"), 1, 0, 'C', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 10);
        $enferm = "";
        $cant = 0;
        while ($enf = mysqli_fetch_array($enfermedades)) {
            $cant += 1;
            if ($cant >= 2) {
                $enferm .= (", " . $enf['nombre']);
            } else {
                $enferm .= $enf['nombre'];
            }
        }
        $pdf->Cell(155, 4, utf8_decode($enferm), 1, 0, 'L', 1);
    }

    if (mysqli_num_rows($alergias) > 0) {
        $pdf->Ln(4);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(195, 4, utf8_decode('ALERGIAS'), 1, 0, 'C', 1);
        $pdf->Ln(4);
        $pdf->Cell(40, 4, utf8_decode("Nombre Alergia"), 1, 0, 'C', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 10);
        $alerg = "";
        $cant = 0;
        while ($alergia = mysqli_fetch_array($alergias)) {
            $cant += 1;
            if ($cant >= 2) {
                $alerg .= (", " . $alergia['nombre'] . "(" . $alergia['tipo'] . ")");
            } else {
                $alerg .= ($alergia['nombre'] . "(" . $alergia['tipo'] . ")");
            }
        }
        $pdf->Cell(155, 4, utf8_decode($alerg), 1, 0, 'L', 1);
    }

    if (mysqli_num_rows($cirugias) > 0) {
        $pdf->Ln(4);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(195, 4, utf8_decode('CIRUGÍAS'), 1, 0, 'C', 1);
        $pdf->Ln(4);
        $pdf->Cell(40, 4, utf8_decode("Nombre Cirugía"), 1, 0, 'C', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 10);
        $cirug = "";
        $cant = 0;
        while ($cirugia = mysqli_fetch_array($cirugias)) {
            $cant += 1;
            if ($cant >= 2) {
                $cirug .= (", " . $cirugia['nombre']);
            } else {
                $cirug .= $cirugia['nombre'];
            }
        }
        $pdf->Cell(155, 4, utf8_decode($cirug), 1, 0, 'L', 1);
    }

    if (mysqli_num_rows($lesiones) > 0) {
        $pdf->Ln(4);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(195, 4, utf8_decode('LESIONES'), 1, 0, 'C', 1);
        $pdf->Ln(4);
        $pdf->Cell(40, 4, utf8_decode("Nombre Lesión"), 1, 0, 'C', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 10);
        $les = "";
        $cant = 0;
        while ($lesion = mysqli_fetch_array($lesiones)) {
            $cant += 1;
            if ($cant >= 2) {
                $les .= (", " . $lesion['nombre'] . "(" . $lesion['tipo'] . ")");
            } else {
                $les .= ($lesion['nombre'] . "(" . $lesion['tipo'] . ")");
            }
        }
        $pdf->Cell(155, 4, utf8_decode($les), 1, 0, 'L', 1);
    }

    if (mysqli_num_rows($antecedentes) > 0) {
        $pdf->Ln(4);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(195, 4, utf8_decode('ANTECEDENTES'), 1, 0, 'C', 1);
        $pdf->Ln(4);
        $pdf->Cell(40, 4, utf8_decode("Nombre Antecedente"), 1, 0, 'C', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 10);
        $ante = "";
        $cant = 0;
        while ($antecedente = mysqli_fetch_array($antecedentes)) {
            $cant += 1;
            if ($cant >= 2) {
                $ante .= (", " . $antecedente['nombre']);
            } else {
                $ante .= $antecedente['nombre'];
            }
        }
        $pdf->Cell(155, 4, utf8_decode($ante), 1, 0, 'L', 1);
    }

    $pdf->Ln(8);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(195, 4, utf8_decode('4. EDUCACIÓN Y EXPERIENCIA PROFESIONAL'), 1, 0, 'C', 1);

    if (mysqli_num_rows($estudios) > 0) {
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 10);
        while ($estudio = mysqli_fetch_array($estudios)) {
            $pdf->Ln(4);
            $pdf->SetFillColor(232, 232, 232);
            $pdf->Cell(30, 4, utf8_decode('Estudio'), 1, 0, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(50, 4, utf8_decode($estudio['nivel'] . " " . $estudio['tipo_nivel']), 1, 0, 'L', 1);
            $pdf->SetFillColor(232, 232, 232);
            $pdf->Cell(20, 4, utf8_decode('Título'), 1, 0, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(70, 4, utf8_decode($estudio['titulo']), 1, 0, 'L', 1);
            $pdf->SetFillColor(232, 232, 232);
            $pdf->Cell(10, 4, utf8_decode('Año'), 1, 0, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(15, 4, utf8_decode($estudio['ano']), 1, 0, 'C', 1);
            $pdf->Ln(4);
            $pdf->SetFillColor(232, 232, 232);
            $pdf->Cell(30, 4, utf8_decode('Institución'), 1, 0, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(85, 4, utf8_decode($estudio['institucion']), 1, 0, 'L', 1);
            $pdf->SetFillColor(232, 232, 232);
            $pdf->Cell(20, 4, utf8_decode('Ciudad'), 1, 0, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(60, 4, utf8_decode($estudio['ciudad']), 1, 0, 'L', 1);
        }
    }

    if (mysqli_num_rows($otros_estudios) > 0) {
        $pdf->Ln(4);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(48, 4, utf8_decode('OTROS ESTUDIOS'), 1, 0, 'C', 1);
        $pdf->Cell(147, 4, utf8_decode('DESCRIPCIÓN'), 1, 0, 'C', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 10);
        while ($otro = mysqli_fetch_array($otros_estudios)) {
            $pdf->Ln(4);
            $pdf->Cell(48, 4, utf8_decode($otro['tipo']), 1, 0, 'C', 1);
            $pdf->Cell(147, 4, utf8_decode($otro['descripcion']), 1, 0, 'C', 1);
        }
    }

    if (mysqli_num_rows($cursos) > 0) {
        $pdf->Ln(8);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195, 4, utf8_decode('5. CURSOS, TALLERES U CAPACITACIONES EN LAS CUALES HA PARTICIPADO'), 1, 0, 'C', 1);
        $pdf->Ln(4);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(20, 3, utf8_decode('FECHA'), 1, 0, 'C', 1);
        $pdf->Cell(60, 3, utf8_decode('INSTITUCIÓN'), 1, 0, 'C', 1);
        $pdf->Cell(100, 3, utf8_decode('DESCRIPCIÓN'), 1, 0, 'C', 1);
        $pdf->Cell(15, 3, utf8_decode('HORAS'), 1, 0, 'C', 1);
        $pdf->Ln(3);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 10);
        while ($curso = mysqli_fetch_array($cursos)) {
            $pdf->Cell(20, 4, utf8_decode($curso['fecha']), 1, 0, 'C', 1);
            $pdf->Cell(60, 4, utf8_decode($curso['institucion']), 1, 0, 'C', 1);
            $pdf->Cell(100, 4, utf8_decode($curso['descripcion']), 1, 0, 'C', 1);
            $pdf->Cell(15, 4, utf8_decode($curso['horas']), 1, 0, 'C', 1);
            $pdf->Ln(4);
        }
    }

    if (mysqli_num_rows($soportes) > 0) {
        while ($soporte = mysqli_fetch_array($soportes)) {
            $pdf->AddPage();
            $pdf->Ln(5);
            $y = $pdf->GetY();
            $pdf->Image('../Recursos/img/soportes_usuario/' . $soporte['soporte'], 30, $pdf->GetY() + 3, 155);
        }
    }

    $title = utf8_decode($vecResVol[0]) . " / " . $fecha;
    $pdf->SetTitle($title);
    $pdf->SetAuthor('COMPANY');
    $pdf->Output();
    ?></body>

</html>
<?php
ob_end_flush();
?>
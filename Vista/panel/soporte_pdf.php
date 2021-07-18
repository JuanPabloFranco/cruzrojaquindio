<?php
ob_start();
$fecha = date("Y-m-d");
?><html>

<body>
    <?php
    require '../Recursos/fpdf/plantillas/PDFCarta.php';
    include_once '../Conexion/consulSQL.php';
    $pdf = new PDFCarta('P', 'mm', array(216, 280));


    $sqlSoporte = "SELECT S.estado_soporte, S.descripcion_soporte, S.soporte, S.fecha_registro, V.nombre_completo, R.nombre_region FROM contacto_soporte S JOIN voluntarios V ON S.id_voluntario=V.id JOIN regiones R ON V.id_region=R.id WHERE S.id=" . $_GET['id'];
    $vecResVol = mysqli_fetch_row(ejecutarSQL::consultar($sqlSoporte));
    $msj = ejecutarSQL::consultar("SELECT R.respuesta, R.fecha_com, V.nombre_completo FROM respuesta_soporte R JOIN voluntarios V ON R.id_voluntario=V.id WHERE id_soporte=" . $_GET['id']);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetMargins(10, 23, 23);

    $pdf->Ln(20);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(195, 6, utf8_decode('SOPORTE FESESYSTEM'), 1, 0, 'C', 1);
    //Nombre
    $pdf->Ln(12);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(40, 3, 'ESTADO', 1, 0, 'C', 1);
    $pdf->Cell(40, 3, 'FECHA DE REGISTRO', 1, 0, 'C', 1);
    $pdf->Cell(115, 3, utf8_decode('NOMBRE Y REGIÓN DEL TÍTULAR'), 1, 0, 'C', 1);
    $pdf->Ln(3);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(40, 6, utf8_decode($vecResVol[0]), 1, 0, 'C', 1);
    $pdf->Cell(40, 6, utf8_decode($vecResVol[3]), 1, 0, 'C', 1);
    $pdf->Cell(115, 6, utf8_decode($vecResVol[4] . " (" . $vecResVol[5] . ")"), 1, 0, 'C', 1);
    $pdf->Ln(6);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->Cell(195, 6, utf8_decode('DESCRIPCIÓN SOLICITUD'), 1, 0, 'C', 1);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Ln(6);
    $pdf->SetFont('Arial', '', 11);
    $pdf->MultiCell(195, 6, utf8_decode($vecResVol[1]), 1, 'L', 1);
    
    if (mysqli_num_rows($msj) > 0) {
        $pdf->Ln(4);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(30, 4, utf8_decode('Fecha'), 1, 0, 'C', 1);
        $pdf->Cell(60, 4, utf8_decode('Titular del comentario'), 1, 0, 'C', 1);
        $pdf->Cell(105, 4, utf8_decode('Comentario'), 1, 0, 'C', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Ln(4);
        while ($m = mysqli_fetch_array($msj)) {            
            $pdf->Cell(30, 4, utf8_decode($m['fecha_com']), 1, 0, 'C', 1);
            $pdf->Cell(60, 4, utf8_decode($m['nombre_completo']), 1, 0, 'C', 1);
            $pdf->MultiCell(105, 4, utf8_decode($m['respuesta']), 1, 'L', 1);
        }
    }

    if ($vecResVol[2] <> "") {
        $y = $pdf->GetY();
        $pdf->Cell(190, $pdf->GetY(), $pdf->Image('../Recursos/img/soporte/' . $vecResVol[2], 20, $pdf->GetY() + 3, 175), 0, 1, 'C', 0);
    }

    $title = 'SOPORTE No. ' . " " . utf8_decode($_GET['id']);
    $pdf->SetTitle($title);
    $pdf->SetAuthor('ESE COLOMBIA');
    $pdf->Output();
    ?></body>

</html>
<?php
ob_end_flush();
?>
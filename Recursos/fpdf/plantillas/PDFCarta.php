<?php

require '../Recursos/fpdf/fpdf.php';
include '../Conexion/consulSQL.php';


class PDFCarta extends FPDF {

    function Header() {
        $this->Image('../Recursos/img/banner_hv.png', 1, 1, 214);
    }

    function Footer() {
        $region = mysqli_fetch_row(ejecutarSQL::consultar("SELECT R.nombre_sede, R.tel_sede, R.email FROM usuario V JOIN sedes R on V.id_sede=R.id WHERE V.id=" . $_GET['id']));
        $this->SetY(-20);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 8, utf8_decode('ESE Región '.$region[0]), 0, 0, 'C');
        $this->Ln(4);
        $this->Cell(0, 8,utf8_decode('Teléfono: '. $region[1]), 0, 0, 'C');
        $this->Ln(4);
        $this->SetTextColor(116, 149, 111);
        $this->Cell(0, 8,'Email: '. $region[2], 0, 0, 'C');
    }
}

?>

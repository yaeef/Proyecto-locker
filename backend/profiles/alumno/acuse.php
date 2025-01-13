<?php
    require "../../FPDF/fpdf.php";
    require "../../../db/conection/conection.php";
    session_start();
    if($_SESSION['estado'] == 'H')
    {
        class PDF extends FPDF {

            function Header() {
                $this->Image('../../../frontend/img/IPN-LogoA.png', 10, 8, 50);
                $this->SetFont('Arial', 'B', 15);
                $this->Cell(80);
                $this->Cell(30, 10, utf8_decode('Instituto Politécnico Nacional'), 0, 1, 'C');
                $this->Cell(190, 10, utf8_decode('ESCUELA SUPERIOR DE CÓMPUTO'), 0, 0, 'C');
                $this->Image('../../../frontend/img/logoESCOM.png', 150, 8, 50);
                $this->Ln(30);
            }
            function Footer() {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, utf8_decode('Locker | ESCOM'), 0, 0, 'L'); 
                $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'R');        
            }
        }
    
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Ln(10); // Espacio extra
        $pdf->Cell(0, 10, utf8_decode('Acuse de Solicitud '), 0, 1, 'R');
        $pdf->SetFont('Arial', '', 12);
    
        $pdf->Ln(10);
        $pdf->Cell(0, 10, utf8_decode('Fecha: ') . date('d/m/Y'), 0, 1,'R');
        $pdf->Cell(0, 10, utf8_decode('Estimado/a [' . ucwords($_SESSION['nombre']) . '],'), 0, 1);
        $pdf->MultiCell(0, 10, utf8_decode('Por la presente, confirmamos que su solicitud para la asignación de un casillero ha sido recibida y procesada con éxito. A continuación, se detallan los datos correspondientes:'), 0, 1);
        $pdf->Ln(10); 
        $pdf->Cell(0, 10, utf8_decode('Nombre Completo :' . ucwords($_SESSION['nombre']))." " . ucfirst($_SESSION['paterno']). " " . ucfirst($_SESSION['materno']), 0, 1);
        $pdf->Cell(0, 10, utf8_decode('Boleta: ' . $_SESSION['boleta'] ), 0, 1);
        $pdf->Cell(0, 10, utf8_decode('Periodo: 2024-2025/2 (febrero-agosto)'), 0, 1);
        $pdf->Cell(0, 10, utf8_decode('Casillero Asignado: ' . $_SESSION['casillero']), 0, 1);
        $pdf->Ln(10); 
        $pdf->MultiCell(0, 10, utf8_decode('Por favor, tenga en cuenta las siguientes instrucciones para el uso y mantenimiento del casillero:'), 0, 1);
        $pdf->MultiCell(0, 10, utf8_decode('1. El casillero asignado es de uso exclusivo del solicitante mencionado anteriormente.'));
        $pdf->MultiCell(0, 10, utf8_decode('2. Asegúrese de mantener su casillero cerrado y asegurado en todo momento.'));
        $pdf->MultiCell(0, 10, utf8_decode('3. La institución no se hace responsable por la pérdida o daño de objetos personales guardados en el casillero.'));
    
        $pdf->Output();
    }
    
?>

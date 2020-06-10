<?php
require('../fpdf.php');
include_once "../../healthCare/dataLayer/databaseConn.php";
class PDF extends FPDF
{

// Simple table
function createTable()
{
			$db = new databaseConn();
            $sql = "SELECT doctor.username ,doctor.specialization ,appointment.date
                    FROM doctor INNER JOIN appointment
                    ON doctor.doctor_id=appointment.doctor_id
                    AND appointment.patient_id='1'";
            $data = $db->select_data($sql);
			$header = array('Doctor Name', 'doctor specalization', 'date');
    // Header
        $this->Cell(40,9,$header[0],1);
		$this->Cell(50,9,$header[1],1);
		$this->Cell(40,9,$header[2],1);
		$this->Ln();
		while($row = mysqli_fetch_array($data)){
				$this->Cell(40,6,$row[0],1);
				$this->Cell(50,6,$row[1],1);
				$this->Cell(40,6,$row[2],1);
				$this->ln();
		}
}
}
$pdf = new PDF();
// Column headings

// Data loading
$data = $pdf->LoadData();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->Output();
?>
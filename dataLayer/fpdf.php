<?php
session_start();
require('fpdf/fpdf.php');
include_once "databaseConn.php";
class PDF extends FPDF
{

// Simple table
function createTable()
{          $patientid=$_SESSION['userID'];
			$db = new databaseConn();
            $sql = "SELECT doctor.username ,doctor.specialization ,appointment.date
                    FROM doctor INNER JOIN appointment
                    ON doctor.doctor_id=appointment.doctor_id
                    AND appointment.patient_id='$patientid'";
            $data = $db->select_data($sql);
			$header = array('Doctor Name', 'Doctor Specalization', 'Date');
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
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->createTable();
$pdf->Output();
?>
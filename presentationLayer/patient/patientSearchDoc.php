<?php
session_start();
?>
<!doctype html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>D&P Portal</title>
    <link rel="stylesheet" href="../css/patientSearchDoc.css">
    <link rel="stylesheet" href="../css/feedback.css">
    <link rel="stylesheet" href="../css/mainView.css">
    <script src="../common/functions.js"></script>
</head>
<body>
<?php
    include "patientView.php";
?>
<div style="padding:0 20px;">
    <br>
    <h3 style="margin-left:5%;margin-bottom: 0;margin-top: 0">Search for the right doctor for you, And book the right
        time for you</h3>
    <br>
    <div>
        <form style="margin-left:5%;" name="searchDoctorForm" class="searchDoctorForm" method="POST">
            <div style="float:left;">
                <label for="searchDoctorName"><b>Doctor Name :</b></label>
                <input type="text" pattern="[a-zA-Z]+" placeholder="Enter Name" name="searchDoctorName" required>
            </div>
            <div style="margin-left: 3%;float:left;">
                <label for="clinicLoc"><b>Choose Location:</b></label>
                <select id="clinicLoc" name="clinicLoc" required>
                    <option value="">Choose Clinic Location</option>
                    <option value="Ain Shams">Ain Shams</option>
                    <option value="Al Matareya">Al Matareya</option>
                    <option value="Al Rehab">Al Rehab</option>
                    <option value="Basateen">Basateen</option>
                    <option value="Dar Al Salam">Dar Al Salam</option>
                    <option value="Down Town">Down Town</option>
                    <option value="El Shorouk">El Shorouk</option>
                    <option value="El Tahrir">El Tahrir</option>
                    <option value="Ezbt-Elnakhl">Ezbt-Elnakhl</option>
                    <option value="Helwan">Helwan</option>
                    <option value="Maadi">Maadi</option>
                    <option value="Mokattam">Mokattam</option>
                    <option value="Nasr City">Nasr City</option>
                </select>
            </div>
            <div style="margin-left: 3%;float:left;">
                <label for="docSpec"><b>Choose Specialization:</b></label>
                <select id="docSpec" name="docSpec" required>
                    <option value="">Choose Doctor Specialization</option>
                    <option value="Pediatrician">Pediatrician</option>
                    <option value="Obstetrician">Obstetrician</option>
                    <option value="Surgeon">Surgeon</option>
                    <option value="Psychiatrist">Psychiatrist</option>
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Dermatologist">Dermatologist</option>
                    <option value="Endocrinologist">Endocrinologist</option>
                    <option value="Nephrologist">Nephrologist</option>
                    <option value="Ophthalmologist">Ophthalmologist</option>
                    <option value="Neurologist">Neurologist</option>
                    <option value="Radiologist">Radiologist</option>
                </select>
            </div>
            <div style="margin-left: 3%;float:left;">
                <label for="appointmentDay"><b>Search by date</b> </label>
                <input type="date" id="appointmentDay" name="appointmentDay"></div>
            <button type="submit" name="searchBtn" class="searchBtn">Search</button>
        </form>
    </div>
    <br>
    <button onclick="showForm('bafc')" class="bookBtn">Book</button>
    <div id="bafc" class="bookAppFormContainer">
        <form name="bookAppForm" class="bookAppForm" method="POST">
            <label for="bookappointmentDay"><b>book appointment date</b> </label>
            <input type="date" id="bookappointmentDay" name="bookappointmentDay" requierd>
            <label for="time"><b>hour</b></label>
            <input type="text" pattern="[0-9]+" maxlength="2" id="booktime" name="booktime" placeholder="hour in 24 form" required>
            <label for="clinicID"><b>Clinic ID: </b></label>
            <input type="text" pattern="[0-9]+" placeholder="Enter ID" name="clinicID" required>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" pattern="[a-zA-Z]+" name="cardname" placeholder="John More Doe" required>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444"required>
            <label for="expmonth">Exp </label>
            <input type="text" id="expmonth" name="expmonth" placeholder="03/22" required>
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" pattern="[0-9]{3}" maxlength="3" name="cvv" placeholder="352" required>
            <button name="bookingBtn" class="bookingBtn" type="submit">Complete Booking</button>
        </form>
    </div>
</div>
<div style="margin-left: 10%">
<?php

include_once "../../dataLayer/databaseConn.php";

$db = new databaseConn();
$doctorName="";
if(isset($_POST["searchBtn"])){
    $doctorName = $_POST["searchDoctorName"];
    $location = $_POST["clinicLoc"];
    $specalization = $_POST["docSpec"];
    $date = $_POST["appointmentDay"];
    $sql = "SELECT doctor_id FROM doctor WHERE specialization = '$specalization'";
    $result = $db->select_data($sql);
    if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc()){
            $doctorID=$row["doctor_id"];
            $sql2 = "SELECT clinic.clinic_id, clinic.park_price, clinic.book_price, clinic.start_time, clinic.end_time
						FROM clinic
						WHERE location='$location' AND doctor_id=$doctorID";
            $result2 = $db->select_data($sql2);
            if ($result2->num_rows > 0){
                while($row=$result2->fetch_assoc()){
                    $clinicID=$row["clinic_id"];
                    $parkprice=$row["park_price"];
                    $bookprice=$row["book_price"];
                    $start=$row["start_time"];
                    $end=$row["end_time"];
                    $totalprice=$parkprice+$bookprice;
                    echo "available appointments";
                    echo "<table><tr><th>clinic id</th><th>doctor name</th><th>location</th><th>date</th><th>hour</th><th>total price</th></tr>";
                    for($h=$start;$h<$end;$h++){
                        $sql3 = "SELECT * FROM appointment
									WHERE clinic_id=$clinicID AND date='$date' AND hour=$h";
                        $result3=$db->select_data($sql3);
                        if($result3->num_rows == 0){
                            echo "<tr><td>".$clinicID."</td><td>$doctorName</td><td>$location</td><td>".$date."</td><td>".$h."</td><td>$totalprice</td></tr>";
                        }
                    }
                    echo "</table>";
                }
            }else{
                echo "0 results";
            }
        }
    }else{
        echo "0 results";
    }
}

else if(isset($_POST["bookingBtn"])){
    $patientID=$_SESSION['userID'];
    $bookDate=$_POST["bookappointmentDay"];
    $bookHour=$_POST["booktime"];
    $bookClinicID=$_POST["clinicID"];
    $cardName=$_POST["cardname"];
    $cardNum=$_POST["cardnumber"];
    $cardExp=$_POST["expmonth"];
    $cardCVV=$_POST["cvv"];
    $sql2="SELECT doctor_id FROM clinic WHERE clinic_id='$bookClinicID'";
    $result2 = $db->select_data($sql2);
    if($result2->num_rows > 0) {
        while($row=$result2->fetch_assoc()){$doctorID=$row['doctor_id'];}
    }
    $sql3="SELECT * FROM appointment WHERE clinic_id=$bookClinicID AND hour=$bookHour AND date='$bookDate'";
    $result3 = $db->select_data($sql3);
    if($result3->num_rows > 0) {
        $message = "appointment is not available";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        $sql4="INSERT INTO appointment (patient_id,doctor_id,clinic_id,hour,date,confirmed)
						VALUES ($patientID,$doctorID,$bookClinicID,$bookHour,$bookDate,0)";
        if($db->insert_data($sql4)){
            $message = "appointment booked succefully";
            echo "<script type='text/javascript'>alert('$message');</script>";
            $sql5="SELECT appointment_id FROM appointment WHERE clinic_id=$bookClinicID AND hour=$bookHour AND date=$bookDate";
            $result5 = $db->select_data($sql5);
            if($result5->num_rows > 0) {
                while($row=$result5->fetch_assoc()){$appointmentID=$row['appointment_id'];}
            }
            $sql6="INSERT INTO ceditcard (appointment_id,name,card_number,cvv,date_of_expiry)
							VALUES ($appointmentID,'$cardName','$cardNum','$cardCVV','$cardExp')";
            if($db->insert_data(($sql6))){
                $message2 = "credit card accepted";
                echo "<script type='text/javascript'>alert('$message2');</script>";
            }
        }
    }
}
?>
</div>


</body>

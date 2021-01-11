<!doctype html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>D&P Portal</title>
    <link rel="stylesheet" href="../css/mainView.css">
    <link rel="stylesheet" href="../css/feedback.css">
    <script src="../common/functions.js"></script>
</head>
<body>
<?php
    include "doctorView.php";
?>
<br>
<div style="padding:0 20px;">
    <h3 style="margin-left:10%;margin-top: 0;">Search for your patients here</h3>
</div>
<div style="margin-left: 10%;padding:0 20px;">
    <form method="get">
        <label for="patientID">Patient ID</label>
        <input type="text" placeholder="Enter id" name="patientID" id ="patientID" required>
        <button class="btn" pattern="[0-9]+" name = "searchBtn" type="submit">Search</button>
    </form>
</div>
<?php
include_once "../../dataLayer/databaseConn.php";
    session_start();
    $db = new databaseConn();
    if (isset($_GET["searchBtn"])){
        $patientid=$_GET['patientID'];
        $sql = "SELECT doctor.username ,doctor.specialization ,appointment.date
        FROM doctor INNER JOIN appointment
        ON doctor.doctor_id=appointment.doctor_id
        AND appointment.patient_id='$patientid'";
        $result = $db->select_data($sql);
        if ($result->num_rows > 0) {
            echo "<table><tr><th>doctorname</th><th>doctor specalization</th><th>date</th></tr>";
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["username"]."</td><td>".$row["specialization"]."</td><td>".$row["date"]."</td></tr>";
            }
            echo "</table>";
        }else{
            if($db->select_data("select * from patient where patient_id=$patientid")->num_rows>0)
            echo "<h2 style='margin-left: 10%'>This patient Doesn't have medical history</h2>";
            else
                echo "<h2 style='margin-left: 10%'>This is no patient with this id</h2>";
        }

    }
?>

</body>
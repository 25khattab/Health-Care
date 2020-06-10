<?php
session_start();

?>
<!doctype html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>D&P Portal</title>
    <link rel="stylesheet" href="../css/feedback.css">
    <link rel="stylesheet" href="../css/mainView.css">
    <script src="../common/functions.js"></script>
</head>
<body>
    <?php
    include "patientView.php";
    ?>
    <div style="padding:0 20px;">
        <h2 style="margin-bottom: 0;">Welcome <?php echo $_SESSION['userName'];?></h2>
        <h3 style="margin-left:10%;margin-top: 0;">See Your Past Visits To Doctors From Here</h3>
    </div>
    <br>
    <a style="text-decoration:none ;float:right;margin-right: 10%; font-size:larger ;color:green" href="../../dataLayer/fpdf.php" target="_blank">View PDF</a>
    <div style="margin-left: 10%;padding:0 20px;">
        <?php

        include_once "../../dataLayer/databaseConn.php";

        $db = new databaseConn();
        $patientid=$_SESSION['userID'];
        $sql = "SELECT doctor.username ,doctor.specialization ,appointment.date
                    FROM doctor INNER JOIN appointment
                    ON doctor.doctor_id=appointment.doctor_id
                    AND appointment.patient_id='$patientid'
                    AND appointment.confirmed=1";

        $result = $db->select_data($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Doctor Name</th><th>Doctor Specalization</th><th>Date</th></tr>";
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["username"]."</td><td>".$row["specialization"]."</td><td>".$row["date"]."</td></tr>";
            }
            echo "</table>";
        }else{
            echo "<h2 style='margin-left: 10%'>This patient Doesn't have medical history</h2>";

        }

        ?>
    </div>
</body>
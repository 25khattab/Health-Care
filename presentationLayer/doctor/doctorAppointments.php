<?php
session_start();
?>
<!doctype html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>D&P Portal</title>
    <link rel="stylesheet" href="../css/mainView.css">
    <link rel="stylesheet" href="../css/update.css">
    <link rel="stylesheet" href="../css/feedback.css">
    <script src="../common/functions.js"></script>
</head>
<body>
<?php
include "doctorView.php";
?>

<br>
<h2 style="margin-left: 10%">see your appointments for today</h2>
<div  style="margin-left: 10%">

    <?php
    include_once "../../dataLayer/databaseConn.php";

    $conn=new databaseConn();
    $docid=$_SESSION["userID"];
    $result = $conn->select_data("SELECT clinic.clinic_id,clinic.location,appointment.hour
                                            FROM clinic,appointment
                                            WHERE clinic.clinic_id=appointment.clinic_id
                                            AND appointment.doctor_id = $docid
                                            AND appointment.confirmed=1
                                            AND appointment.date = '".date("Y-m-d")."';");
    echo   "<table>
            <tr>
            <th>clinic ID</th>
            <th>Location</th>
            <th>Hour</th>
            </tr>";
        if ($result->num_rows>0)
        while($row = $result->fetch_assoc()){
            echo "<tr><td>".$row['clinic_id']."</td>";
            echo "<td>".$row['location']."</td>";
            echo"<td>".$row['hour']."</td>";
            echo"</tr>";}
    echo "</table>";

    ?>
</div>



</body>
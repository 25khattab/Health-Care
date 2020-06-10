<?php
session_start();
?>
<!doctype html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>D&P Portal</title>
    <link rel="stylesheet" href="../css/patientBookings.css">
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
    <h3 style="margin-left:10%;margin-bottom: 0;margin-top: 0">See Your Upcoming Appointments With Doctors</h3>
    <h3 style="margin-left:30%;margin-top: 0">And if you are busy you can cancel your booking by just one click.</h3>
</div>
<br>
</div>
<div style="padding:0 20px;margin-left:10%;">
    <div style="float :left;margin-right: 5%"><form method="post" >
            <label for="appointmentDay">Search by date </label>
            <input type="date"  id="appointmentDay" name="appointmentDay">
            <button class="btn" type="submit" name="searchbtn" >Search</button>
        </form></div>

    <div id="cancelAppDiv" style="float :left;display: inline;">
        <form method="post">
            <label for="cancelApp">cancel your booking with appointment id</label>
            <input type="text" pattern="[0-9]+" placeholder="Enter id" name="cancelApp" id ="cancelApp" required>
            <button class="btn" type="submit" name="cancelbtn"> cancel</button>
        </form>
    </div>

</div>
<br clear="both">
<div style ="margin-left:10%;">

    <?php

    include_once "../../dataLayer/databaseConn.php";
    $conn=new databaseConn();

    if (isset($_POST['cancelbtn']))
    {
        $ID=$_POST['cancelApp'] ;
        $query1= "DELETE from ceditcard where appointment_id = $ID" ;
        $query2= "DELETE from appointment where appointment_id = $ID" ;
        if(($conn->update_data($query1)&&$conn->update_data($query2))>0)
        {

            echo '<script language="javascript">';
            echo 'alert("Appointment Canceled Successfully")';
            echo '</script>';
        }
        else {echo '<script language="javascript">';
            echo 'alert("Something Went Wrong Try Again")';
            echo '</script>';}
    }


    else if (isset($_POST['searchbtn']))
    {
        $Date=$_POST['appointmentDay'] ;
        $patient_id=$_SESSION["userID"];
        $query2 = "SELECT * FROM appointment where date = '$Date' AND patient_id='$patient_id' AND confirmed='1'" ;
        $result = $conn->select_data($query2);
        $resultCheck= mysqli_num_rows($result);
        if ($resultCheck>0)
        {
            echo "Your Upcoming Appointments : ";
            echo "<table border = 1 ; style =width:40%;padding: 35px; text-align: left>
                          <tr>
                          <th>Appointment ID</th>
                          <th>Date</th>
                          <th>Hour</th>
                          <th>Confirmed</th>
                          </tr>";
            while ($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                echo "<td>" . $row['appointment_id'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['hour'] . "</td>";
                if ($row['confirmed']==1)echo "<td>" . "True" . "</td>" ;
                else{echo "<td>" . "False" . "</td>";}
                echo "</tr>";
            }
            echo "</table>";
        }
        else { echo "There are no Upcoming Appointments ." ; }
    }

    ?>
</div>

</body>
<?php
session_start();
?>
<!doctype html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>D&P Portal</title>
    <link rel="stylesheet" href="../css/mainView.css">
    <script src="../common/functions.js"></script>
</head>
<body>
<ul class="NavBar">
    <h4 style="margin-left:2%;float: left">D&P Portal</h4>
    <li><a href="adminConfirm.php">Confirm Appointments</a></li>
    <li><a href="adminUpdate.php">Edit Your account</a></li>
    <li><a href="../../applicationLayer/logout.php">Logout</a> </li>
</ul>
<div style="padding:0 20px;">
    <h2 style="margin-bottom: 0;">Welcome <?php echo $_SESSION['userName'];?></h2>
    <h3 style="margin-left:10%;margin-top: 0;">Manage your clinics from here</h3>
</div>
</div>
<div style="padding:0 20px;margin-left:10%;">
    <div style="float :left;margin-right: 5%"><form method="post" >
            <label for="appointmentDay">Search by date </label>
            <input type="date" id="appointmentDay" name="appointmentDay">
            <button class="btn" type="submit" name="searchbtn" >Search</button>
        </form></div>

    <div id="confirmAppDiv" style="float :left;display: inline;">
        <form method="post">
            <label for="confirmApp">confirm booking of patients with appointment id</label>
            <input type="text" placeholder="Enter id" name="confirmApp" id ="confirmApp" required>
            <button class="btn" type="submit" name="confirmBtn">Confirm</button>
        </form>
    </div>

</div>
<br clear="both">
<div style ="margin-left:10%;">

    <?php

    include_once "../../dataLayer/databaseConn.php";
    $conn=new databaseConn();

    if (isset($_POST['confirmBtn']))
    {
        $ID=$_POST['confirmApp'] ;
        $query1= "UPDATE appointment SET confirmed='1' where appointment_id = $ID" ;

        if($conn->update_data($query1))
        {
            $userEmail=$_SESSION['userEmail'];
            mail("$userEmail","Appointment with doctor","you have successfully booked an appointment ");
            echo '<script language="javascript">';
            echo 'alert("Appointment Confirmed Successfully")';
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
        $query2 = "SELECT * FROM appointment where date = '$Date' AND patient_id='$patient_id' AND confirmed='0'" ;
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

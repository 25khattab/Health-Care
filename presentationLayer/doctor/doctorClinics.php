<?php
session_start();
?>
<!doctype html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>D&P Portal</title>
    <link rel="stylesheet" href="../css/mainView.css">
    <link rel="stylesheet" href="../css/doctorClinics.css">
    <link rel="stylesheet" href="../css/feedback.css">
    <script src="../common/functions.js"></script>
</head>
<body>

<?php
include "doctorView.php";
?>
<div style="padding:0 20px;">
    <h2 style="margin-bottom: 0;">Welcome <?php echo $_SESSION['userName'];?></h2>
    <h3 style="margin-left:10%;margin-top: 0;">Manage your clinics from here</h3>
</div>

    <div>
        <button onclick="showForm('acf')" class="showAddClinicFormBtn">Add Clinic</button>
        <div id="acf" class="addClinicFormContainer">
            <form class="addClinicForm" method="post">
                <label for="clinicLoc"><b>Clinic Location</b></label>
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
                <label for="clinicHours"><b>Clinic Hours</b></label>
                        <!-- this will be for hours -->
                <div id="clinicHours" >
                    <div style="float:left;margin-left: 5%">
                        <label for="timeFrom"><b>From</b></label>
                        <input type="text"  pattern="[0-9]+" maxlength="2" id="timeFrom name=" timeFrom"  required>
                    </div>
                    <div style="float:left; margin-left: 5%">
                        <label  for="timeTo"><b>To</b></label>
                        <input type="text" pattern="[0-9]+" maxlength="2" id="timeTo" name="timeTo" required>
                    </div>
                </div>
                <br style="clear:both;"/>
                <label for="bookingPrice"><b>Booking Price</b></label>
                <input type="text"  pattern="[0-9]+" placeholder="Enter price" name="bookingPrice" id="bookingPrice" required>
                <label for="parkingPrice"><b>Parking Price</b></label>
                <input type="text" pattern="[0-9]+" placeholder="Enter price" name="parkingPrice" id="parkingPrice" required>
                <label for="clinicPhoneNum"><b>Clinic PhoneNumber</b></label>
                <input type="text" pattern="[0-9]+" maxlength="11" placeholder="Enter Phone Number" name="clinicPhoneNum" required>

                <button class="addClinicBtn" name ="addClinicBtn"type="submit">Add</button>
            </form>
        </div>
    </div>
<div style="margin-left: 10%">
    <?php
    include_once "../../dataLayer/databaseConn.php";
    $conn=new databaseConn();
    $result = $conn->select_data("select * from clinic where doctor_id= '".$_SESSION["userID"]."'");
    if(mysqli_num_rows($result)>0){
        echo "<table>
    <tr>
<th>location:</th>
    <th>phone number:</th>
<th>from:</th>
<th>to:</th>
    <th>booking price:</th>
    <th>parking price:</th>
    </tr>";
        if ($result->num_rows>0)
            while($row = $result->fetch_assoc()){
                echo "<tr><td>".$row['location']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo"<td>".$row['start_time']."</td>";
                echo"<td>".$row['end_time']."</td>";
                echo"<td>".$row['book_price']."</td>";
                echo"<td>".$row['park_price']."</td>";
                echo"</tr>";}
        echo "</table>";}
    else echo "you don't have any clinics yet";
    if(isset($_POST["addClinicBtn"])){

        $clinicLoc =$_POST['clinicLoc'];
        $timeFrom =$_POST['timeFrom'];
        $timeTo =$_POST['timeTo'];
        $bookingPrice =$_POST['bookingPrice'];
        $parkingPrice =$_POST['parkingPrice'];
        $clinicPhoneNum =$_POST['clinicPhoneNum'];
        $docID=$_SESSION['userID'];
        $result = $conn->insert_data("INSERT INTO clinic (doctor_id,location,phone,park_price ,book_price, start_time,end_time  ) VALUES ($docID,'$clinicLoc','$clinicPhoneNum',$parkingPrice,$bookingPrice,$timeFrom,$timeTo)");
        echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>
</div>


</body>

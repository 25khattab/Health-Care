
<!doctype html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>D&P Portal</title>
    <link rel="stylesheet" href="../css/mainView.css">
    <link rel="stylesheet" href="../css/organSearch.css">
    <link rel="stylesheet" href="../css/feedback.css">
    <script src="../common/functions.js"></script>
</head>
<body>
<?php
include "doctorView.php";
?>
<br>
<br>
<form class="organSearchForm" method="post" name="organSearchForm">
    <div style="float:left;margin-right:10% ;">
        <h3>Choose Organ you would like to search for:</h3>
        <select id="organ" name="organ" required>
            <option value="">Select an organ</option>
            <option value="liver">Portion of the Liver</option>
            <option value="lung">Lung</option>
            <option value="kidney">Kidney</option>
            <option value="pancreas">Pancreas</option>
            <option value="intestine">Intestine</option>
            <option value="eye">Eye</option>
        </select>
    </div>
    <div style="float:left;margin-right:10% ;">
        <h3>Choose blood type:</h3>
        <select id="bloodType" name="bloodType" required>
            <option value="">Select your blood type</option>
            <option value="a+">A+</option>
            <option value="a-">A-</option>
            <option value="b+">B+</option>
            <option value="b-">B-</option>
            <option value="ab+">AB+</option>
            <option value="ab-">AB-</option>
            <option value="o+">O+</option>
            <option value="o-">O-</option>
        </select>
    </div>

    <button type="submit" name="searchBtn" class="searchBtn" >Search</button>
</form>
<br clear="both">
<div style="margin-left: 10%">
<?php
session_start();
include_once "../../dataLayer/databaseConn.php";
if(isset($_POST["searchBtn"])) {
    $blood_type = $_POST['bloodType'];
    $organ = $_POST['organ'];

    $query = "SELECT  * from organ where blood_type='$blood_type' and organ='$organ' ;";
    $db=new databaseConn();
    $result = $db->select_data($query);
    $result_check = mysqli_num_rows($result);

    echo '    
            <h3> Organ Donor </h3>';
    if ($result_check > 0) {
        echo "<table border = 1 ; style =width:40%;padding: 35px; text-align: left>
                          <tr>
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Blood Type</th>
                          <th>Organ</th>
                          <th>Phone Number</th>
                          </tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['blood_type'] . "</td>";
            echo "<td>" . $row['organ'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "There is no organ donor yet .";
    }
}
?>
</div>

</body>
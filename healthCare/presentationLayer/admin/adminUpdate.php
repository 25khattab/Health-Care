<?php
require '../../applicationLayer/update.php'
?>
<!doctype html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>D&P Portal</title>
    <link rel="stylesheet" href="../css/mainView.css">
    <link rel="stylesheet" href="../css/update.css">
    <script src="../common/functions.js"></script>
</head>
<body>
<ul class="NavBar">
    <h4 style="margin-left:2%;float: left">D&P Portal</h4>
    <li><a href="adminConfirm.php">Confirm Appointments</a></li>
    <li><a href="adminUpdate.php">Edit Your account</a></li>
    <li><a href="../../applicationLayer/logout.php">Logout</a> </li>
</ul>
<form class="updateAccountForm" method="post">
    <h1>Edit Your Account</h1>
    <hr>
    <div style="float:left;margin-right:20px;">
        <label for="updateName"><b>Name</b></label>
        <input type="text"  pattern="[a-zA-Z]+" placeholder="Enter Name" name="updateName" value="<?php echo$_SESSION['userName']?>" required>
    </div>
    <br style="clear:both;"/>
    <div style="float:left;">
        <label for="updateEmail"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="updateEmail" value="<?php echo$_SESSION['userEmail']?>" required>
    </div>
    <br style="clear:both;"/>
    <div style="float:left;margin-right:20px;">
        <label for="updatePass"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="updatePass" value="<?php echo$_SESSION['userPass']?>" required>
    </div>
    <br style="clear:both;"/>
    <br>
    <button type="submit" name ="updateBtn" class="updateBtn">Update Data</button>

</form>

</body>

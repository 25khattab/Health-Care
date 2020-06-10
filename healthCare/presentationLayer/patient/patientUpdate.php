<?php
    require '../../applicationLayer/update.php'
?>
<!doctype html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>D&P Portal</title>
    <link rel="stylesheet" href="../css/update.css">
    <link rel="stylesheet" href="../css/feedback.css">
    <link rel="stylesheet" href="../css/mainView.css">
    <script src="../common/functions.js"></script>
</head>
<body>
<?php
    include "patientView.php";
?>

<form class="updateAccountForm" method="post">
    <h1>Edit Your Account</h1>
    <hr>
    <div style="float:left;margin-right:20px;">
        <label for="updateName"><b>Name</b></label>
        <input type="text" pattern="[a-zA-Z]+" placeholder="Enter Name" name="updateName" value="<?php echo$_SESSION['userName']?>" required>
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
    <div style="float:left;">
        <label for="updatePhone"><b>Phone Number</b></label>
        <input type="text" pattern="[0-9]+" maxlength="11" placeholder="Enter Phone Number" name="updatePhone" value="<?php echo$_SESSION['userPhone']?>" required>
    </div>
    <br>
    <button type="submit" name ="updateBtn" class="updateBtn">Update Data</button>

</form>

</body>
</html>
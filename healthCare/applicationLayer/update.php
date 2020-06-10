<?php
require_once "../../dataLayer/databaseConn.php";
session_start();
$db= new databaseConn();
$result=$db->getUpdateUserData($_SESSION['userType'],$_SESSION['userID']);
$_SESSION['userName']=$result[0];
$_SESSION['userEmail']=$result[1];
$_SESSION['userPass']=$result[2];

if($_SESSION['userType']!="admin")
    $_SESSION['userPhone']=$result[3];

if(isset($_POST["updateBtn"])){
    $userID=$_SESSION['userID'];
    $userName=$_POST['updateName'];
    $userEmail=$_POST['updateEmail'];
    $userPsw=$_POST['updatePass'];
    if($_SESSION['userType']!="admin")
        $userPhoneNum=$_POST['updatePhone'];
    $userType=$_SESSION['userType'];
    $userType_id=$userType."_id";
    if($_SESSION['userType']!="admin")
        $sql_query="UPDATE $userType set username='$userName',password='$userPsw',email='$userEmail',phone='$userPhoneNum' where $userType_id = '$userID'";
    else
        $sql_query="UPDATE $userType set username='$userName',password='$userPsw',email='$userEmail' where $userType_id = '$userID'";
    $db->insert_data($sql_query);
    $result=$db->getUpdateUserData($_SESSION['userType'],$_SESSION['userID']);
    $_SESSION['userName']=$result[0];
    $_SESSION['userEmail']=$result[1];
    $_SESSION['userPass']=$result[2];
    if($_SESSION['userType']!="admin")
        $_SESSION['userPhone']=$result[3];
}

?>

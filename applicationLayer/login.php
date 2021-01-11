<?php
include_once("../dataLayer/databaseConn.php");
session_start();
if(isset($_POST['loginBtn'])) {
    $db= new databaseConn();
    $userEmail=$_POST['loginEmail'];
    $userPass=$_POST['loginPsw'];
    $userType=$_POST['loginType'];

    $result=$db->check_login($userEmail,$userPass,$userType);
    if($result != null) {
        $_SESSION['userEmail']=$userEmail;
        $_SESSION['userType']=$userType;
        $_SESSION['userName']=$result[0];
        $_SESSION['userID']=$result[1];
        if($userType=="patient") {
            header("location: ../presentationLayer/patient/patientMHistory.php");
        }
        else if ($userType=="doctor"){
            header("location: ../presentationLayer/doctor/doctorClinics.php");
        }
        else if ($userType=='organ'){
            header("location:../presentationLayer/organDonor/organDonorUpdate.php");
        }
        else if ($userType=='admin'){
            header("location:../presentationLayer/admin/adminConfirm.php");
        }
    }else {
        echo '<script language="javascript">';
        echo 'alert("Wrong email or password")';
        echo '</script>';
        header("refresh:0;url=../presentationLayer/welcome.php");

    }
}
else{
    echo "you shouldn't be here";
}

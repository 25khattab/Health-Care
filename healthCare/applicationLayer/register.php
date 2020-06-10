<?php
include_once "../dataLayer/databaseConn.php";
session_start();
if (isset($_POST["signUpBtn"])){
    $db= new databaseConn();
    $userType=$_POST['type'];
    $userName=$_POST['signUpName'];
    $userEmail=$_POST['signUpEmail'];
    $userPsw=$_POST['signUpPsw'];
    $userPhoneNum=$_POST['signUpPhoneNum'];
    $userAge=$_POST['signUpAge'];
    $userGender=$_POST['gender'];
    if($userType=="patient"){
        $sql_query="INSERT INTO $userType(username,password,email,phone,gender) VALUES('$userName','$userPsw','$userEmail','$userPhoneNum','$userGender') ";
        if($db->insert_data($sql_query)==true){
            $_SESSION['userEmail']=$userEmail;
            $_SESSION["userName"]=$userName;
            $_SESSION["userID"]=$db->getUserID($userType,$userEmail);
            $_SESSION['userType']=$userType;
            header("location:../presentationLayer/patient/patientMHistory.php");
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Email Already Registered Try To Login")';
            echo '</script>';
            header("refresh:0;url=../presentationLayer/welcome.php");
        }
    }
    else if ($userType=="doctor"){
        $docSpec=$_POST["docSpec"];
        $sql_query="INSERT INTO $userType(username,password,email,phone,gender,specialization) VALUES('$userName','$userPsw','$userEmail','$userPhoneNum','$userGender','$docSpec') ";
        if($db->insert_data($sql_query)==true){
            $_SESSION['userEmail']=$userEmail;
            $_SESSION["userName"]=$userName;
            $_SESSION["userID"]=$db->getUserID($userType,$userEmail);
            $_SESSION['userType']=$userType;
            header("location:../presentationLayer/doctor/doctorClinics.php");
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Email Already Registered Try To Login")';
            echo '</script>';
            header("refresh:0;url=../presentationLayer/welcome.php");
        }
    }
    else if ($userType=="organ") {
        $organ = $_POST["organ"];
        $bloodType=$_POST["bloodType"];

        $_SESSION['userType']=$userType;
        $sql_query = "INSERT INTO $userType(username,password,email,phone,gender,blood_type,organ) VALUES('$userName','$userPsw','$userEmail','$userPhoneNum','$userGender','$bloodType','$organ') ";
        echo $sql_query;
        if ($db->insert_data($sql_query) == true) {
            $_SESSION["userName"] = $userName;
            $_SESSION["userID"]=$db->getUserID($userType,$userEmail);
            header("location:../presentationLayer/organDonor/organDonorUpdate.php");
        } else {
            echo $sql_query;
            echo '<script language="javascript">';
            echo 'alert("Email Already Registered Try To Login")';
            echo '</script>';
            header("refresh:0;url=../presentationLayer/welcome.php");
        }
    }

}
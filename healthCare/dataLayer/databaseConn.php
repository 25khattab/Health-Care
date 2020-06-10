<?php
include_once "singleton.php";

class databaseConn
{

    public function insert_data($sql_query){
        $db=singleton::getInstance();
        $mysqli=$db->getConnection();
        return $mysqli->query($sql_query);
    }
    public function update_data($sql_query){
        $db=singleton::getInstance();
        $mysqli=$db->getConnection();
        $mysqli->query($sql_query);
        return mysqli_affected_rows($mysqli);
    }
    public function select_data($sql_query){
        $db=singleton::getInstance();
        $mysqli=$db->getConnection();
        return $mysqli->query($sql_query);
    }
    public function check_login($userEmail,$userPass,$userType){
        $db=singleton::getInstance();
        $mysqli=$db->getConnection();
        $userType_id=$userType.'_id';
        $sql_query="SELECT username,$userType_id FROM $userType WHERE email = '$userEmail' and password = '$userPass'";
        $result=$mysqli->query($sql_query);
        if(mysqli_num_rows($result)==1){
            return mysqli_fetch_row($result);
        }
        else {
            return null;
        }
    }

    public function getUserID($userType,$userEmail){
        $db=singleton::getInstance();
        $mysqli=$db->getConnection();
        $userType_id=$userType.'_id';
        $result=mysqli_fetch_row($mysqli->query("select $userType_id from $userType where email = '$userEmail'"))[0];
        return $result;
    }
    public function getUpdateUserData($userType,$userID){
        $db=singleton::getInstance();
        $mysqli=$db->getConnection();
        $userType_id=$userType.'_id';
        if($userType=="admin")
            $result=mysqli_fetch_row($mysqli->query("select username,email,password
 from $userType where $userType_id = '$userID'"));
        else
            $result=mysqli_fetch_row($mysqli->query("select username,email,password,phone from $userType where $userType_id = '$userID'"));
        return $result;

    }


}
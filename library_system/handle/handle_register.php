<?php
    session_start();//啟用Session功能
    function connSQL()
    {
        $dbhost = '127.0.0.1';
        $dbuser = 'root';
        $dbpass = 'ciisciis';
        $dbname = 'library system';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
        mysqli_query($conn, "SET NAMES 'utf8'");
        mysqli_select_db($conn, $dbname);
        return $conn;
    }
    
    function check_acc_exist($acc){
        $sql = "SELECT * FROM member WHERE account = '$acc'";
        $conn = connSQL(); //連接資料庫
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
        $row = mysqli_fetch_array($result);
        if($row['account']==$acc){
            return true;
        }else{
            return false;
        }
    }

    function insert_db($reg_acc,$reg_pwd,$reg_name,$reg_stdid,$reg_tele,$reg_email){
        $sql = "INSERT INTO member VALUES ('$reg_acc', '$reg_pwd', '$reg_stdid');";
        $sql2 = "INSERT INTO 學生 VALUES ('$reg_stdid', '$reg_name', '$reg_tele', '$reg_email');";
        $conn = connSQL(); //連接資料庫
        if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
            $URL="../index.php?register=success";
            header("Location: $URL");
        } else {
            $URL="../index.php?register=error";
            header("Location: $URL");
        }
    }

    $reg_acc=$_POST["account"];
    $reg_pwd=md5($_POST["password"]);
    $reg_pwd_twice=md5($_POST["password_twice"]);
    $reg_name=$_POST["name"];
    $reg_stdid=$_POST["student_id"];
    $reg_tele=$_POST["telephone"];
    $reg_email=$_POST["Email"];
    if($reg_acc=="" || $reg_pwd=="" || $reg_name=="" || $reg_stdid==""  || $reg_tele==""  || $reg_email=="" ){
        $URL="../register.php?register=error"; //有欄位未填寫
        header("Location: $URL");// 將網址導回
    }else if($reg_pwd!=$reg_pwd_twice) {
        $URL="../register.php?register=pwd_error"; //密碼不一致
        header("Location: $URL");// 將網址導回
    }else if(check_acc_exist($reg_acc)){ //帳號已經存在
        $URL="../register.php?register=account_exist"; 
        header("Location: $URL");// 將網址導回
    }else{
        insert_db($reg_acc,$reg_pwd,$reg_name,$reg_stdid,$reg_tele,$reg_email);
    }
?>
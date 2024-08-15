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
    $isbn = $_POST['ISBN'];
    $stdid = $_POST['stdid'];
    $sql = "UPDATE `book` SET 是否被租借 = '否' , 租借學號 = '' WHERE ISBN = '$isbn';";
    $conn = connSQL();
    $result = mysqli_query($conn,$sql);
    if($result){
        $URL = "../return_book.php?return=success";
        header("Location:$URL");
    }else{
        $URL = "../return_book.php?return=error";
        header("Location:$URL");
    }
?>
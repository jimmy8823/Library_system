<?php
    include("sendmail.php");
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
    $isbn = $_POST["ISBN"];
    $stdid = $_POST["stdid"];
    $renting_stdid = $_POST["renting_stdid"];
    $action = $_POST["action"];
    $book = $_POST["book"];
    if($action == '0'){
        $sql = "SELECT * FROM 學生 WHERE 學號 = '$renting_stdid';";
        echo $sql;
        $conn = connSQL();
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        echo $row['信箱'];
        sendmail($row['信箱'],$book);
        $URL = "../rent_book.php?send=success";
         header("Location:$URL");
    }else{
        $sql = "UPDATE `book` SET 是否被租借 = '是' , 租借學號 = '$stdid' WHERE ISBN = '$isbn';";
        echo $sql;
        $conn = connSQL();
        $result = mysqli_query($conn,$sql);
        if($result){
            $URL = "../rent_book.php?rent=success";
            header("Location:$URL");
        }else{
            $URL = "../rent_book.php?rent=error";
            header("Location:$URL");
        }
    }
    ?>  
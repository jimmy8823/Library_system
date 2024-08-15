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
    $conn = connSQL();
    $sql = "DELETE FROM book WHERE ISBN = '$isbn'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $URL = "../book_manage.php?delete=success";
        header("Location:$URL");
    }else{
        $URL = "../book_manage.php?delete=error";
        header("Location:$URL");
    }
?>
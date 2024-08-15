<?php
    session_start();
    include("sendmail.php");

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
    function check_isbn_exist($isbn){
        $sql = "SELECT * FROM book WHERE ISBN = '$isbn'";
        $conn = connSQL(); //連接資料庫
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
        $row = mysqli_fetch_array($result);
        echo $sql;
        if(!$row)
            return false;
        else
            return true;
    }
    function add_book($isbn,$book,$author,$cate){
        $sql = "INSERT INTO book VALUES ('$isbn', '$book', '$author','$cate','否','');";
        $conn = connSQL(); //連接資料庫
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
        if($result){
            $URL = "../book_manage.php?add=success";
            header("Location:$URL");
        }else{
            $URL = "../book_manage.php?add=error";
            header("Location:$URL");
        }
    }   
    function send_add($bookname){
        $sql = "SELECT * FROM 學生,member WHERE 學生.學號 = member.學號";
        $conn = connSQL(); //連接資料庫
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
        while($row = mysqli_fetch_array($result)){
            sendmail_add($row['信箱'],$bookname);
        }
    }
    $isbn = $_POST['ISBN'];
    $book = $_POST['name'];
    $author = $_POST['author'];
    $cate = $_POST['cate'];
    if($cate=="choose category" || $book=="" || $author=="" ||$isbn==""){
        $URL = "../book_manage.php?input=error";
        header("Location:$URL");
    }else if(check_isbn_exist($isbn)){
        $URL = "../book_manage.php?isbn=exist";
        header("Location:$URL");
    }else{
        send_add($book);
        add_book($isbn,$book,$author,$cate);
    }
?>
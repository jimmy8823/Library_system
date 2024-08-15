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

    $user_acc=$_POST["account"];
    $user_pwd=md5($_POST["password"]);
    $sql = "SELECT * FROM member WHERE account = '$user_acc'";
    $conn = connSQL(); //連接資料庫
    $result = mysqli_query($conn, $sql) or die('MySQL query error');
    $row = mysqli_fetch_array($result);
    if($user_acc == $row['account'] && $user_pwd == $row['password']){
        // 登入成功,寫入session與cookie
        $_SESSION['mylogin'] = true;//將此值記錄於Session變數
        $mananger = $row['manager'];
        if($mananger){
            $_SESSION['manager'] = true;
        }else{
            $_SESSION['manager'] = false;
        }
        //echo "登入狀態:".$_SESSION['mylogin']."<Br>";//測試讀出Session
        $sql = "SELECT * FROM 學生 WHERE 學號 = \"" . $row['學號'] . "\";";
        //echo $sql;
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
        $row = mysqli_fetch_array($result);
        $name = $row['姓名'];
        $stdid = $row['學號'];
        setcookie("stdid", $stdid,0,"/");//寫入cookie
        setcookie("name", $name,0,"/");//寫入cookie
        //echo "姓名:".$_COOKIE['name']."<Br>";//測試讀出cookie
        //成功登入導到首頁
        $URL="../index.php?name=$name"; 
        header("Location: $URL");// 將網址導回首頁
    }else{
        //echo "登入失敗";
        $URL="../login.php?login=error"; //在網址中帶錯誤訊息回去
        header("Location: $URL");// 將網址導回登入
    }   
?>
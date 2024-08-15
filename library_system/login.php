<!DOCTYPE html>
<?php
    include 'header.php';
    //當未登入或是密碼輸入錯誤時被導回來的時$_GET['login'] 會等於 error
    $login=isset($_GET['login']) ? $_GET['login'] : ''; //if判斷是否存在(條件):成立時顯示 ? 不成立顯示空值
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<head>
  <style>
    label {
        font-size: 20px;
      }
  </style>
  <!--bootstrap-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" language="javascript">
    
  </script>
</head>

<body>
  
  <?php
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
  ?>
   <div style="text-align:center;"><h1>登入</h1></div>
    <div class="container">
      <form action="./handle/handle_login.php" method="post">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">帳號</label>
            <div class="col-sm-10">
            <input type="account" class="form-control" style="width: 300px" name="account">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">密碼</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" style="width: 300px" name="password">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
        <?php
			if($login=='error'){ //當密碼錯誤，或尚未登入時，顯示提示文字
		    	echo "<center><font color='red'>*帳號或密碼錯誤!</font></center>";
	    	}
		?>
    </div>

</body>

</html>
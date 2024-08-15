<!DOCTYPE html>
<?php
    include 'header.php';
    $register=isset($_GET['register']) ? $_GET['register'] : '';
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

    <div class="container">
      <h1>註冊帳號</h1>
      <form action="./handle/handle_register.php" method="post">
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
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">再次輸入密碼</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" style="width: 300px" name="password_twice">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">姓名</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" style="width: 300px" name="name">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">學號</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" style="width: 300px" name="student_id">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">電話</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" style="width: 300px" name="telephone">
            </div>
        </div>
        <div class="row mb-3">
            <label  class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="mail" class="form-control" style="width: 300px" name="Email">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">註冊</button>
        </form>
        <?php 
          if($register=='error'){ 
            echo "<center><font color='red'>*資料未填確實</font></center>";
          }
          if($register=='account_exist'){ 
		    	  echo "<center><font color='red'>*帳號已經註冊</font></center>";
	    	  }
          if($register=='pwd_error'){ 
		    	  echo "<center><font color='red'>*密碼不一致</font></center>";
	    	  }
		?>
    </div>

</body>

</html>
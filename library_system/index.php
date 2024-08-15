<!DOCTYPE html>
<?php
  include 'header.php'; //引入表頭
  $input=isset($_GET['input']) ? $_GET['input'] : '';
  $register=isset($_GET['register']) ? $_GET['register'] : '';
  $logout=isset($_GET['logout']) ? $_GET['logout'] : '';
  $permission=isset($_GET['permission']) ? $_GET['permission'] : '';
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
  <div style="text-align:center;"><h1>書籍查詢系統</h1></div>
    <div class="container">
      <form action="search_result.php" method="post">
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label col-form-label-lg">類別</label>
          <div class="col-sm-10">
            <select class="form-select form-check-inputwidth="300" style="width: 300px" aria-label="Default select example" name ="cate" id="cate">
              <option value = "choose category">choose category</option>
                <?php
                $sql = "SELECT DISTINCT 類別 FROM book";
                $conn = connSQL(); //連接資料庫
                $result = mysqli_query($conn, $sql) or die('MySQL query error');
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <option value =<?php echo $row['類別']?>> <?php echo $row['類別']?> </option>
                <?php
                }
                ?>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label col-form-label-lg">書名</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="book_name" name="name" width="300" style="width: 300px">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label col-form-label-lg">作者</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="author" width="300" name="author" style="width: 300px">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label col-form-label-lg">ISBN</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="ISBN" name="ISBN" style="width: 300px">
          </div>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary" onclick = "check_form_input()" >搜尋</button>
        </div>
      </form>
        <?php
          if($input=='error'){ //當查詢皆無輸入，顯示提示文字
            echo "<center><font color='red'>*請至少填入一個欄位!</font></center>";
          }
          if($register=="success"){
          ?>
            <script type="text/javascript">
                alert('註冊成功 !');
            </script>
          <?php
          }
          ?>
          <?php
          if($logout==true){
          ?>
            <script type="text/javascript">
                alert('已登出 !');
            </script>
          <?php
          }
          ?>
          <?php
          if($permission=="deny"){
          ?>
            <script type="text/javascript">
                alert('您不是管理人員，因此無法進行管理書籍操作 !');
            </script>
          <?php
          }
          ?>
          
    </div>
  </div>

</body>

</html>
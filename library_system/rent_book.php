<!DOCTYPE html>
<?php
  include 'header.php';
  $input=isset($_GET['input']) ? $_GET['input'] : '';
  $rent=isset($_GET['rent']) ? $_GET['rent'] : '';
  $send=isset($_GET['send']) ? $_GET['send'] : '';
  if(!$_SESSION['mylogin']){
    $URL = "login.php";
    header("Location:$URL");
}
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
  <div style="text-align:center;"><h1>書籍租借系統</h1></div>
    <div class="container">
        <h2>請先搜尋欲借閱的書籍</h2>
        <form action="rent_search.php" method="post">
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
    </div>
    <?php
        if($input=='error'){ //當查詢皆無輸入，顯示提示文字
            echo "<center><font color='red'>*請至少填入一個欄位!</font></center>";
        }
        if($rent=='success'){ //租借成功
    ?>
            <script type="text/javascript" language="javascript">
                alert("租借成功 !");
            </script>
    <?php
        }
        if($rent=='error'){
     ?>
            <script type="text/javascript" language="javascript">
              alert("發生錯誤 !");
            </script>
    <?php
        }
        if($send=='success'){
    ?>
            <script type="text/javascript" language="javascript">
              alert("寄信成功 !");
            </script>
    <?php
        }
    ?>
</body>

</html>
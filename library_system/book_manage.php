<!DOCTYPE html>
<?php
    include 'header.php'; //引入表頭
    $input = isset($_GET['input']) ? $_GET['input'] : '';
    $isbn = isset($_GET['isbn']) ? $_GET['isbn'] : '';
    $add = isset($_GET['add']) ? $_GET['add'] : '';
    $delete = isset($_GET['delete']) ? $_GET['delete'] : '';
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
    if(!$_SESSION['mylogin']){
        $URL = "login.php";
        header("Location:$URL");
    }
    if(!$_SESSION['manager']){
        $URL = "index.php?permission=deny";
        header("Location:$URL");
    }
    if($delete == "success"){?>
        <script type="text/javascript" language="javascript">
            alert("刪除成功 !");
        </script>
    <?php
    }if($delete == "error"){?>
        <script type="text/javascript" language="javascript">
            alert("刪除時發生錯誤 !");
        </script>
    <?php
    }if($add == "success"){?>
        <script type="text/javascript" language="javascript">
            alert("新增成功 !");
        </script>
    <?php
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
  <link rel="stylesheet" type="text/css" href="./css/style.css" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" language="javascript">
  </script>
</head>

<body>
<div style="text-align:center;"><h1>書籍管理系統</h1></div>
  <div class="container">
    <h2>管理書籍</h2>
      <form method="post">
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
          <button type="submit" class="btn btn-primary" formaction="./handle/handle_add.php" formmethod="post">新增</button>
          <button type="submit" class="btn btn-danger" formaction="delete_search.php" formmethod="post">刪除</button>
        </div>
      </form>
        <?php
        if($input=='error'){ //當查詢皆無輸入，顯示提示文字
            echo "<center><font color='red'>*請確實填寫每項欄位!</font></center>";
        }
        if($input=='derror'){ 
            echo "<center><font color='red'>*請填寫至少一項欄位!</font></center>";
        }
        if($isbn=='exist'){ 
            echo "<center><font color='red'>*此書已經存在(ISBN)!</font></center>";
        }
        ?>
    </div>
  </div>
</body>
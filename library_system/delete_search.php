<!DOCTYPE html>
<?php
  include("header.php")
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
  <link rel="stylesheet" type="text/css" href="./css/style.css" >
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
  <div id="fade">
    <div class="container">
      <h1>刪除書籍</h1>
        <?php
          $category = $_POST["cate"];
          $name = $_POST["name"];
          $author = $_POST["author"];
          $ISBN = $_POST["ISBN"];
          if($category=="choose category" && $name=="" && $author=="" &&$ISBN==""){
            $URL="book_manage.php?input=derror"; //在網址中帶錯誤訊息回去
            header("Location: $URL");// 將網址導回登入
          }
          $sql = "SELECT * FROM book WHERE ";
          $first = 1;
          if($category!="choose category"){
            $sql .= "類別 = '$category' ";
            $first=0;
          }
          if($name!=""){
            if($first==0){
              $sql.= "AND ";
            }
            $sql .= "書名 LIKE '%$name%' ";
            $first = 0;
          }
          if($author!=""){
            if($first==0){
              $sql.= "AND ";
            }
            $sql .= "作者 LIKE '%$author%' ";
            $first = 0;
          }
          if($ISBN!=""){
            if($first==0){
              $sql.= "AND ";
            }
            $sql .= "ISBN LIKE '%$ISBN%' ";
            $first = 0;
          }
          echo $sql;
          $conn = connSQL(); //連接資料庫
          $result = mysqli_query($conn, $sql) or die('MySQL query error');
          $i = 1;
        ?>
        <form action="./handle/handle_delete.php" method="post">
            <table class="table">
            <thead>
                <tr>
                <th scope="col" class="table-primary">#</th>
                <th scope="col" class="table-primary">書名</th>
                <th scope="col" class="table-primary">作者</th>
                <th scope="col" class="table-primary">是否被租借中</th>
                <th scope="col" class="table-primary">租借學號</th>
                <th scope="col" class="table-primary">刪除</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th class="table-success" scope="row"><?php echo $i ?></th>
                    <td class="table-success"><?php echo $row['書名'] ?></td>
                    <td class="table-success"><?php echo $row['作者'] ?></td>
                    <td class="table-success"><?php echo $row['是否被租借'] ?></td>
                    <td class="table-success"><?php echo $row['租借學號'] ?></td>
                    <td class="table-success"><button type="submit" class="btn btn-danger">刪除</button></td>
                    <input type="hidden" value =<?php echo $_COOKIE['stdid'] ?> name ="stdid">
                    <input type="hidden" value =<?php echo $row['ISBN'] ?> name ="ISBN">
                </tr>     
                <?php
                $i++;
                }
                ?>
            </tbody>
            </table>
        </form>
      </div>
    </div>
  </div>

</body>

</html>
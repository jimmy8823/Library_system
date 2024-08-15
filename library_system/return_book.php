<!DOCTYPE html>
<?php
  include 'header.php';
    if(!$_SESSION['mylogin']){
        $URL = "login.php";
        header("Location: $URL");
    }
    $return = isset($_GET['return']) ? $_GET['return'] : ''; //if判斷是否存在(條件):成立時顯示 ? 不成立顯示空值
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
  <div id="fade">
    <div class="container">
      <!--首頁-->
      <h1>您目前所租借的書籍如下</h1>
        <?php
            $stdid = $_COOKIE["stdid"];
            $sql = "SELECT * FROM book WHERE 租借學號 = '$stdid';";
            $conn = connSQL();
            $result = mysqli_query($conn,$sql);
        ?>
        <form action="./handle/handle_return.php" method="post">
            <table class="table">
            <thead>
                <tr>
                <th scope="col" class="table-primary">#</th>
                <th scope="col" class="table-primary">書名</th>
                <th scope="col" class="table-primary">作者</th>
                <th scope="col" class="table-primary">租借學號</th>
                <th scope="col" class="table-primary">歸還</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <th class="table-success" scope="row"><?php echo $i ?></th>
                    <td class="table-success"><?php echo $row['書名'] ?></td>
                    <td class="table-success"><?php echo $row['作者'] ?></td>
                    <td class="table-success"><?php echo $row['租借學號'] ?></td>
                    <td class="table-success"><button type="submit" class="btn btn-primary">歸還</button></td>
                    <input type="hidden" value =<?php echo $row['ISBN'] ?> name ="ISBN">
                    <input type="hidden" value =<?php echo $_COOKIE['stdid'] ?> name ="stdid">
                </tr>     
                <?php
                    $i++;
                }
                ?>
            </tbody>
            </table>
        </form>
        <?php
            if($return=='success'){
        ?>
                <script type="text/javascript" language="javascript">
                    alert("歸還成功");
                </script>
        <?php
            }
        ?>
      </div>
    </div>
  </div>

</body>

</html>
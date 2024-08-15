<!DOCTYPE html>
<?php
    session_start();
    error_reporting(0);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./css/style.css" >
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand">Library System</a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">查詢系統</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="rent_book.php">租書</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="return_book.php">還書</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="book_manage.php">管理書籍</a>
      </li>
    </ul>
    <?php 
        if($_SESSION['mylogin']){
            echo "歡迎回來 ! " . $_COOKIE['name']; 
            ?>
            <a>&nbsp  </a>
            <form action ="logout.php">
                <button type="submit" class="btn btn-outline-danger">登出</button>
            </form>
        <?php
        }else{  
        ?>
            <form class ="d-flex">
                <button class="btn btn-outline-success" type="submit" formaction="login.php">Login</button>
                <a>&nbsp</a>
                <button class="btn btn-outline-success" type="submit" formaction="register.php">Sign up</button>
            </form>
        <?php
        }
        ?>
    </form>
  </div>
</div>
</nav>
</body>
</html>
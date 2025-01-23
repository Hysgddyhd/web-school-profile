<?php 


  session_start();

var_dump($_SESSION);

if(isset($_GET['error'])){
  echo "<font color='red'> Operation Failed: Insufficient Permission</font><br>";
}
if(isset($_GET['level'])){
  if ($_GET['level']=="none") {
   header("Location:account.php");
  }else{
    echo "<font color='red'>Access blocked: Insufficient Permission</font><br>";
  }
}
include_once "account_crud.php"; 

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lamp Store Index</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
      html {
        width:100%;
        height:100%;
        background:url(logo.png) center center no-repeat;
        min-height:100%;
      }
    </style>
</head>
<body>
    <nav class="navbar nav-tabs">
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="index.php">Home</a>
        </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">Products
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="products.php">Add Product</a></li>
              <li><a href="products_details.php">Database</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">HR
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="customers.php">Customer</a></li>
              <li><a href="staffs.php">Staff</a></li>
            </ul>
          </li>
        <li><a href="orders.php">Order</a></li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user">User</span>
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="account.php"><span class="glyphicon glyphicon-log-in">log in</a></span></li>
              <li><a href="account.php?logout=true"><span class="glyphicon glyphicon-log-in">log out</span></a></li>
          </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-offset-2 col-md-offset-4">
          <div class="col-sm-10">
            <h3>Welcome to Decent Lamp Store</h3>
          </div>
          
        </div>
      </div>
      <div class="col-sm-offset-2 col-md-offset-4">
        <div class="col-sm-2 col-md-3 col-lg-4">
          <a role="button" class="btn btn-primary bottom" href="../index.html" target="_self">return</a>          
        </div>
      </div>    
    </div>
    
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>
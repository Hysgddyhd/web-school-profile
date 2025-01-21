<?php
 session_start();
 if(time()-$_SESSION["login_time_stamp"] >300)  
     {
         session_unset();
         session_destroy();
         header("Location:account.php");
     }
include_once 'database.php';
 //initial database
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 //prepare sql statement
    $stmt = $conn->prepare("INSERT INTO tbl_orders_a197547(fld_order_num, fld_staff_num,
      fld_customer_num) VALUES(:oid, :sid, :cid)");
   
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    //create an unique order id
    $oid = uniqid('O', true);
    $sid = $_POST['sid'];
    $cid = $_POST['cid'];
     //run
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])&&$_SESSION['level']=="admin") {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_orders_a197547 SET fld_staff_num = :sid,
      fld_customer_num = :cid WHERE fld_order_num = :oid");
   
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $oid = $_POST['oid'];
    $sid = $_POST['sid'];
    $cid = $_POST['cid'];
     
    $stmt->execute();
 
    header("Location: orders.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])&&$_SESSION['level']=="admin") {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_orders_a197547 WHERE fld_order_num = :oid");
   
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
       
    $oid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: orders.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])&&$_SESSION['level']=="admin") {
   
    try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_orders_a197547 WHERE fld_order_num = :oid");
   
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
       
    $oid = $_GET['edit'];
     
    $stmt->execute();
 
    $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
  if ($_SESSION['level']=="normal"&&(isset($_GET['update'])||isset($_GET['delete']))) {
      echo "<font color='red'> Operation Failed: Insufficient Permission</font>";
      $editRow="";
  }else if ($_SESSION['level']=="normal"&&isset($_GET['edit'])){
  $newURL="orders.php?error=true";
  header('Location: '.$newURL);
}else if($_SESSION['level']==""){
     $newURL="index.php?level=none";
     header('Location: '.$newURL);
  }
?>
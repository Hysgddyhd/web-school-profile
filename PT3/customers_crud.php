<?php
 //initial datacase config
session_start();
if(time()-$_SESSION["login_time_stamp"] >300)  
    {
        session_unset();
        session_destroy();
        header("Location:account.php");
    }
include_once 'database.php';
 //prepare  database connection 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])&&$_SESSION['level']=="admin") {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_customers_a197547_pt2(fld_customer_num, fld_customer_fname,
      fld_customer_lname, fld_customer_gender, 
      fld_customer_birthday,fld_customer_phone) VALUES(:cid, :fname, :lname,
      :gender,:birthday, :phone)");
   //bind para and 
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(":birthday",$birthday,PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
       //get value from post
    $cid = $_POST['cid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender =  $_POST['gender'];
        $birthday=$_POST['birthday'];

    $phone = $_POST['phone'];
       //run!
    $stmt->execute();
    }
 //indicate error
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])&&$_SESSION['level']=="admin") {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_customers_a197547_pt2 SET fld_customer_num = :cid,
      fld_customer_fname = :fname, fld_customer_lname = :lname,
      fld_customer_gender = :gender, 
      fld_customer_birthday=:birthday, fld_customer_phone = :phone
      WHERE fld_customer_num = :oldcid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(":birthday",$birthday,PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
       
    $cid = $_POST['cid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender =  $_POST['gender'];
    $birthday=$_POST['birthday'];
    $phone = $_POST['phone'];
    $oldcid = $_POST['oldcid'];
       
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])&&$_SESSION['level']=="admin") {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_customers_a197547_pt2 WHERE fld_customer_num = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])&&$_SESSION['level']=="admin") {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a197547_pt2 WHERE fld_customer_num = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['edit'];
     
    $stmt->execute();
 
    $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
if ($_SESSION['level']=="normal"&&(isset($_GET['update'])||isset($_GET['delete']))) {
    echo "<font color='red'> Operation Failed: Insufficient Permission</font>";
    $editRow="";
}else if ($_SESSION['level']=="normal"&&(isset($_POST['create'])||isset($_GET['edit']))){
  $newURL="customers.php?error=true";
  header('Location: '.$newURL);
}else if($_SESSION['level']==""){
     $newURL="index.php?level=none";
     header('Location: '.$newURL);
  }
 //unset conn
  $conn = null;
 
?>
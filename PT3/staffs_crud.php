<?php
 
include_once 'database.php';
if(time()-$_SESSION["login_time_stamp"] >300)  
    {
        session_unset();
        session_destroy();
        header("Location:account.php");
    }
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a197547_pt2(fld_staff_num, fld_staff_fname, fld_staff_lname,
      fld_staff_gender,fld_staff_marital, fld_staff_phone, fld_staff_email,fld_staff_password,fld_staff_level) VALUES(:sid, :fname, :lname, :gender,:marital,:phone, :email,:password,:level)");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':marital',$marital,PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password',$password,PDO::PARAM_STR);
    $stmt->bindParam(':level',$level,PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender =  $_POST['gender'];
    $marital=$_POST['marital'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password=$_POST['password'];
    $level=$_POST['level'];
         
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  header("Location:staffs.php");
}
 
//Update
if (isset($_POST['update'])) {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_staffs_a197547_pt2 SET
      fld_staff_num = :sid, fld_staff_fname = :fname,
      fld_staff_lname = :lname, fld_staff_gender = :gender,
      fld_staff_marital=:marital,
       fld_staff_phone = :phone,
        fld_staff_email = :email,
        fld_staff_password = :password,
        fld_staff_level = :level 
      WHERE fld_staff_num = :oldsid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':marital',$marital,PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password',$password,PDO::PARAM_STR);
    $stmt->bindParam(":level",$level,PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $marital=$_POST['marital'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password=$_POST['password'];
    $level=$_POST['level'];
    $oldsid = $_POST['oldsid'];
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a197547_pt2 where fld_staff_num = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a197547_pt2 where fld_staff_num = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['edit'];
     
    $stmt->execute();
 
    $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
  if($_SESSION['level']=="normal"){
     $newURL="index.php?level=normal";
     header('Location: '.$newURL);
  }else if($_SESSION['level']==""){
     $newURL="index.php?level=none";
     header('Location: '.$newURL);
  }
 
?>
<?php
 //contain database setup
include_once 'database.php';
 //pdo connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 //prepare sql statement
      $stmt = $conn->prepare("INSERT INTO tbl_products_a123456(fld_product_num,
        fld_product_name, fld_product_price, fld_product_brand, fld_product_condition,
        fld_product_year, fld_product_quantity,fld_product_image) VALUES(:pid, :name, :price, :brand,
        :cond, :year, :quantity,'')");
     //bind all parameters with loacl variable
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':cond', $cond, PDO::PARAM_STR);
      $stmt->bindParam(':year', $year, PDO::PARAM_INT);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
       //get value from post
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $cond = $_POST['cond'];
    $year = $_POST['year'];
    $quantity = $_POST['quantity'];
     //execute sql statement
    $stmt->execute();
    }
 //indicate error response to ui
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
 
  try {
 //prepare sql statement
      $stmt = $conn->prepare("UPDATE tbl_products_a123456 SET fld_product_num = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_brand = :brand,
        fld_product_condition = :cond, fld_product_year = :year, fld_product_quantity = :quantity
        WHERE fld_product_num = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':cond', $cond, PDO::PARAM_STR);
      $stmt->bindParam(':year', $year, PDO::PARAM_INT);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $cond = $_POST['cond'];
    $year = $_POST['year'];
    $quantity = $_POST['quantity'];
    $oldpid = $_POST['oldpid'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 //delete sql statement 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a123456 WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a123456 WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
?>
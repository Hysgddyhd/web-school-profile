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
      $stmt = $conn->prepare("INSERT INTO tbl_products_a197547_pt2(fld_product_num,
        fld_product_name, fld_product_brand, fld_product_price, fld_product_position, fld_product_material, fld_product_specialty, fld_product_quantity) VALUES(:pid, :name, :brand, :price,
        :position, :material,:specialty, :quantity)");
     //bind all parameters with loacl variable
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_STR);
      $stmt->bindParam(':position', $position, PDO::PARAM_STR);
      $stmt->bindParam(':material', $material, PDO::PARAM_STR);
      $stmt->bindParam(':specialty',$specialty,PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
       //get value from post
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $brand =  $_POST['brand'];
    $price = $_POST['price'];
    $position=$_POST['position'];
    $material=$_POST["material"];
    $specialty=$_POST['specialty'];
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
      $stmt = $conn->prepare("UPDATE tbl_products_a197547_pt2 SET fld_product_num = :pid,
        fld_product_name = :name,fld_product_brand = :brand,fld_product_price = :price, 
        fld_product_position = :position, fld_product_material = :material, fld_product_specialty = :specialty,
        fld_product_quantity=:quantity 
        WHERE fld_product_num = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_STR);
      $stmt->bindParam(':position', $position, PDO::PARAM_STR);
      $stmt->bindParam(':material', $material, PDO::PARAM_STR);
      $stmt->bindParam(':specialty',$specialty,PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       //get value from post
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $brand =  $_POST['brand'];
    $price = $_POST['price'];
    $position=$_POST['position'];
    $material=$_POST["material"];
    $specialty=$_POST['specialty'];
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
      $stmt = $conn->prepare("DELETE FROM tbl_products_a197547_pt2 WHERE fld_product_num = :pid");
     
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
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a197547_pt2 WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
?>
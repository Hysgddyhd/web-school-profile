<?php  
  include_once 'database.php'
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Bike Ordering System : Products Details</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <?php 
      try {
          $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
          $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          $stmt=$conn->prepare("SELECT*From tbl_products_a197547_pt2  where fld_product_num = :pid");
          $stmt->bindParam(':pid',$pid,PDO::PARAM_STR);
          $pid=$_GET['pid'];
          $stmt->execute();
          $readRow = $stmt->fetch(PDO::FETCH_ASSOC);
        }
      catch(PDOException $e) {
        echo "<p>".$e."</p>";
      }
     ?>
    Product ID: <?php echo $readRow['fld_product_num']; ?> <br>
    Name: <?php echo $readRow['fld_product_name']; ?> <br>
    Brand: <?php echo $readRow['fld_product_brand']; ?> <br>
    Price: RM <?php echo $readRow['fld_product_price']; ?> <br>
    Room Position: <?php foreach (explode(';',$readRow['fld_product_position'],-1) as $value) {
          echo $value.', ';
        }; ?> <br>
    Material: <?php echo $readRow['fld_product_material']; ?> <br>
    Specialty: <?php echo '<p>';foreach (explode(';',$readRow['fld_product_specialty'],-1) as $value) {
          echo $value." ";
        }; echo ".</p>";?>
    Quantity:
    <?php 
    echo $readRow["fld_product_quantity"]."<br>";
     ?><br>
    <img src ="products/<?php if (strcmp($readRow["fld_product_image"], "")!=0) {
      echo $readRow['fld_product_image'].'.png';
    } else {
      echo "../../img/noPhoto.png";
    }
     ?>" width="50%" height="50%">
  </center>
</body>
</html>
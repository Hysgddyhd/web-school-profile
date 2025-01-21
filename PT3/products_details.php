<?php  
  session_start();
  if($_SESSION['level']==""){
       $newURL="index.php?level=none";
       header('Location: '.$newURL);
  }
  include_once 'database.php';
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Bike Ordering System : Products Details</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar nav-tabs">
    <ul class="nav nav-tabs">
      <li>
        <a href="index.php">Home</a>
      </li>
        <li class="dropdown active">
          <a class="dropdown-toggle" data-toggle="dropdown">Products
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="products.php">Add Product</a></li>
            <li class="dropdown-item active"><a  href="products_details.php">Database</a></li>
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
    </ul>
  </nav>
  <div class="container">
  </div>
    <table class="table table-bordered table-hover table-responsive">
        <?php 
        if (isset($_GET['pid'])) {
          try {
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
     <thead>
       <tr>
         <td>Product ID:</td>
         <td><?php echo $readRow['fld_product_num']; ?> </td>
       </tr>
     </thead><br>
     <tr>
       <td> Name: </td>
       <td><?php echo $readRow['fld_product_name']; ?> <br></td>
     </tr>
     <tr>
       <td>Brand:</td>
       <td> <?php echo $readRow['fld_product_brand']; ?> <br></td>
     </tr>
     <tr>
       <td>Price:(RM) </td>
       <td> <?php echo $readRow['fld_product_price']; ?> <br></td>
     </tr>
     <tr>
       <td> Room Position:</td>
       <td><?php foreach (explode(';',$readRow['fld_product_position'],-1) as $value) {
          echo $value.', ';
        }; ?> <br></td>
     </tr>
     <tr>
       <td>Material:</td>
       <td><?php echo $readRow['fld_product_material']; ?> <br></td>
     </tr>
     <tr>
       <td> Specialty:</td>
       <td><?php echo '<p>';foreach (explode(';',$readRow['fld_product_specialty'],-1) as $value) {
          echo $value." ";
        }; echo ".</p>";?></td>
     </tr>
     <tr>
       <td>Quantity:</td>
       <td><?php 
    echo $readRow["fld_product_quantity"]."<br>";
     ?><br></td>
     </tr>
     <tr>
       <td>Image</td>
       <td><img src ="products/<?php if (strcmp($readRow["fld_product_image"], "")!=0) {
      echo $readRow['fld_product_image'].'.png';
    } else {
      echo "../../img/noPhoto.png";
    }
     ?>" width="50%" height="50%"></td>
     </tr>
     <tfoot>
       <tr>
         <td colspan="2"><a role="button" class="btn btn-default" href="products_details.php">Database</a></td>
       </tr>
     </tfoot>
  </table>
  <?php  
    } else{ ?>
  <div class="container">
    <div class="col-sm-8 col-sm-offset-4">
      <h3>Lamp Database</h3>  
    </div>  
  </div>
  <table class="table table-bordered table-hover table-responsive">
      <thead class="thead">
        <tr>
          <td>Product ID</td>
          <td>Name</td>
          <td>Price(RM)</td>
          <td>Place Position</td>
          <td></td>
        </tr>         
      </thead>
      <tbody>
  <?php 
  try {
            if (isset($_GET["page"])) {
              $page=$_GET['page'];
            } else {
              $page=1;
            }
            $startRow=($page-1)*5;
            $stmt=$conn->prepare("SELECT*FROM tbl_products_a197547_pt2");
            $stmt->execute();
            $result=$stmt->fetchAll();
            $maxPage=ceil(count($result)/5);
            $stmt=$conn->prepare("SELECT*FROM tbl_products_a197547_pt2 order by fld_product_num asc limit $startRow,5");
            $stmt->execute();
            $result=$stmt->fetchAll();
          }
            catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            }foreach ($result as $readRow) {
              // code...
        ?>
        <tr>
          <td><?php echo $readRow['fld_product_num']; ?></td>
          <td><?php echo $readRow['fld_product_name']; ?></td>
          <td><?php echo $readRow['fld_product_price']; ?></td>
          <td><?php foreach (explode(';',$readRow['fld_product_position'],-1) as $value) {
            echo $value.'<br>';
          }; ?>
            
          </td>

          <td>
            <div class="btn-group btn-group-xs ">
              <a type="button" class="btn btn-info btn-sm" href="products_details.php?pid=<?php echo $readRow['fld_product_num']; ?>">Details</a>
              <a type="button" class="btn btn-default btn-sm" href="products.php?edit=<?php echo $readRow['fld_product_num']; ?>">Edit</a>
              <a type="button" class="btn btn-warning btn-sm" href="products.php?delete=<?php echo $readRow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
            </div>          
          </td>
        
          <?php
            }
            $conn = null;
          ?>
            </tr>
          </tbody>
          <tfoot>
            
          </tfoot>
        </table>
        <div class="justify-content-center btn-group">
          <a role="button" class="btn btn-default <?php if($page==1) echo "disabled"; ?>" href="products_details.php?page=<?php echo $page-1; ?>">«</a>
          <?php
          for ($i=1; $i <=$maxPage; $i++) { 
           ?>
           <a role="button" class="btn btn-default" href="products_details.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
         <?php } ?>
          <a role="button" class="btn btn-default <?php if($page==$maxPage) echo "disabled"; ?>" href="products_details.php?page=<?php echo $page+1; ?>">»</a>
        </div>
  <?php } ?>
      
    
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>
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
<?php
  if (isset($_GET['delete'])) {
    $target_dir = "products/";
    $target_file = $target_dir . $_GET['pid'].".png";
    
      $url="products_details?pid=".$_GET['pid'];
      header('Location: ',$url);
    }
  if (isset($_POST['pid'])){
    echo "right source"."<br>";
    $target_dir = "products/";
    $target_file = $target_dir . $_GET['pid'].".png";
    //delete image if delete flag is set
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
   
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
   
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
   
    // Allow certain file formats
    if($imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpg") {
      echo "Sorry, only PNG & GIF & JPG files are allowed.";
      $uploadOk = 0;
    }
   
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<br>"."Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
      die();
    } 

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

      try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //update picture path 
          $stmt = $conn->prepare("UPDATE tbl_products_a197547_pt2 SET fld_product_image =:picture WHERE fld_product_num=:id");
     
          // Bind the parameters
       // $stmt->bindParam(':user', $name, PDO::PARAM_STR);

        $stmt->bindParam(':id',$_POST['pid'],PDO::PARAM_STR);
        $stmt->bindParam(':picture',$_POST['pid'],PDO::PARAM_STR);
          
        $stmt->execute();
      echo "succes change picture";
   
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    } else {
        echo "Sorry, there was an error uploading your file.";
    }

  }

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
         <td><a role="button" class="btn btn-default" href="products_details.php">Database</a></td>
         <form action="products_details.php?pid=<?php echo $_GET['pid'];  ?>" method="post"  enctype="multipart/form-data">
           <td>
              <input class="btn btn-default" type='file' name='fileToUpload' id='fileToUpload' required>
              <input type="hidden" name="pid" value="<?php echo $_GET['pid']; ?>">
              <input class="btn btn-success" title="upload image" type="submit" name="upload" value="upload">
                <button class="btn btn-danger" title="Delete image uploaded" ><a href="products_details.php?pid=<?php echo $_GET['pid']; ?>&delete=<?php if (isset($_GET['pid'])) {
                  echo "true";
                } ?>">Delete</a></button>
           </td>
         </form>
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
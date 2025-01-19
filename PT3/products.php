<?php
  include_once 'products_crud.php';
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Bike Ordering System : Products</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-default">
    <ul class="nav nav-tabs">
      <li >
        <a href="index.php">Home</a>
      </li>
        <li class="dropdown active">
          <a class="dropdown-toggle" data-toggle="dropdown">Products
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="active"><a href="products.php">Add Product</a></li>
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
    </ul>
  </nav>
  <div class="container">
<!--form body-->   
    <div class="form-group">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-4">
          <h3>Insert New Lamp</h3>  
        </div>       
      </div>
      <form action="products.php" method="post" class="form-horizontal form-group">
        <br>
        <div class="row">
          <div class="col-sm-4">
            <label for="productId">Product ID</label>
          </div>
          <div class="col-sm-8">
            <input class="form-control" id="productId"  name="pid" type="text" value="<?php if(isset($_GET['edit'])) echo $editRow['fld_product_num']; ?>" required> 
          </div>    
        </div>  
        <br>
        <div class="row">
          <div class="col-sm-4">
            <label for="productName">Name</label>
          </div>
          <div class="col-sm-8">
            <input name="name" class="form-control" id="productName" type="text" value="<?php if(isset($_GET['edit'])) echo $editRow['fld_product_name']; ?>" required>     
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-4">
            <label for="productBrand">Brand</label>
          </div>
          <div class="col-sm-8">
            <select class="custom-select  custom-select-sm form-control" id="productBrand" name="brand" required>
              <?php 
                $brand_list=array("Fenmzee","G Keni","  CHLORANTHUS","Nintiue","Kakanuo","EDISHINE","Nourison","Zafferano","OORUN");
                foreach ($brand_list as $brand){
               ?>
               <!--show all brand in products-->
               <option <?php echo 'value="'.$brand.'"'; if (isset($_GET['edit'])) {
                 if($editRow['fld_product_brand']==$brand)
                  echo "selected";
               }?> ><?php echo $brand ?></option>
               <?php 
                }
                $stmt=null;
                ?>
            </select>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-4">
            <label for="productPrice">Price</label>
          </div>
          <div class="col-sm-8">
            <input class="form-control" id="productPrice" name="price" type="text" value="<?php if(isset($_GET['edit'])) echo $editRow['fld_product_price']; ?>" required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-4">
            <label for="">Room Position</label>
          </div>
          <div class="col-sm-8">
            <select class=" form-control" id="prouct_pos">
              <option value="lobby">lobby</option>
              <option value="livingRoom">living room</option>
              <option value="bedroom">bedroom</option>
              <option value="study">study</option>
              <option value="bathroom">bathroom</option>
              <option value="Balcony">balcony</option>
              <option value="outside">outside</option>
            </select>
            <mark class="btn-sm  btn-primary" role="button" onclick="addPosition()"><span class="glyphicon glyphicon-plus"></span>add</mark>
            <mark class="btn-sm  btn-primary btn-warning" name="position" role="button" onclick="clearPosition()"><span class="glyphicon glyphicon-trash"></span>clear</mark>
          </div>
          
        </div>
        <div class="row">
          <div class="col-sm-8 col-sm-offset-4">
            <input class="form-control" disabled name="position" id="position" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_product_position"] ?>"  required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-4">
            <label for="productMaterial">material</label>
          </div>
          <div class="col-sm-8">
            <input  class="form-control" id="productMaterial" name="material"  type="text"value="<?php if(isset($_GET['edit'])) echo $editRow['fld_product_material']; ?>">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-4 ">
            <label for="productSpec">specialty</label>
          </div>
          <div class="col-sm-8 " >
            <textarea class="form-control" id="productSpec" name="specialty" maxlength="255"><?php if(isset($_GET['edit'])) echo $editRow['fld_product_specialty']; ?></textarea required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-4">
            <label for="productQ">Quantity</label>
          </div>
          <div class="col-sm-8">
            <input class="form-control" id="productQ" name="quantity" type="number" value="<?php if(isset($_GET['edit'])) echo $editRow['fld_product_quantity']; ?>" required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-4">
            <?php if (isset($_GET['edit'])) { ?>
            <input  type="hidden" name="oldpid" value="<?php echo $editRow['fld_product_num']; ?>">
            <button class="btn btn-success" type="submit" name="update">Update</button>
            <?php } else { ?> 
          </div>
          <div class="col-md-8 col-sm-8 col-xs-8">
            <button class="btn btn-primary" type="submit" name="create">Create</button>
            <button class="btn btn-danger" type="reset">Clear</button>
            <?php } ?> 
          </div>
        </div>          
      </form>
    </div>
<!--table body-->   
    <br>
    <div class="col-sm-8 col-sm-offset-4">
          <h3>Lamp Database</h3>  
    </div>     
    <hr>
    <br>
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
            }
            foreach ($result as $readRow) {
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
      <a role="button" class="btn btn-default <?php if($page==1) echo "disabled"; ?>" href="products.php?page=<?php echo $page-1; ?>">«</a>
      <?php
      for ($i=1; $i <=$maxPage; $i++) { 
       ?>
       <a role="button" class="btn btn-default" href="products.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
     <?php } ?>
      <a role="button" class="btn btn-default <?php if($page==$maxPage) echo "disabled"; ?>" href="products.php?page=<?php echo $page+1; ?>">»</a>
    </div>
  </div>
  <hr>
</body>
<script type="text/javascript">
  function addPosition() {
    var a = document.getElementById("prouct_pos");
  var text = a.options[a.selectedIndex].value;
  document.getElementById("position").value+=text+";"
  //window.alert(text)

  }
  function clearPosition(){
    document.getElementById("position").value=""
  }
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>
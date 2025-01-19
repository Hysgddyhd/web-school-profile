<?php 
  include_once("orders_details_crud.php");
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Decent Lamp Store: Order Details</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar nav-tabs">
    <ul class="nav nav-tabs">
      <li>
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
      <li class="active"><a href="orders.php">Order</a></li>
    </ul>
  </nav>
  <div class="container">

    <div class="row">
      <div class="col-sm-8 col-sm-offset-4">
        <h3>Insert New Order Detail</h3>  
      </div>       
    </div><br>
     <!--table--> 
     <?php 
       try{
             $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
             $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             $stmt=$conn->prepare("SELECT * FROM tbl_orders_a197547,tbl_staffs_a197547_pt2,tbl_customers_a197547_pt2 
               WHERE tbl_orders_a197547.fld_order_num=:oid and 
               tbl_orders_a197547.fld_staff_num=tbl_staffs_a197547_pt2.fld_staff_num 
               and tbl_orders_a197547.fld_customer_num=tbl_customers_a197547_pt2.fld_customer_num; ");
             $stmt->bindParam(":oid",$_GET['oid'],PDO::PARAM_STR);
             $stmt->execute();
             $readRow=$stmt->fetch(PDO::FETCH_ASSOC);
           }
           catch(PDOException $e) {
               echo $e;
           }
      ?>
    <table class="table table-bordered table-striped table-responsive">
      <thead>
        <tr>
          <td>Order ID:</td>
          <td><?php echo $_GET['oid']; ?></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Order Date:</td>
          <td><?php echo $readRow["fld_order_date"]; ?></td>
        </tr>
        <tr>
          <td>Staff:</td>
          <td> <?php echo $readRow["fld_staff_fname"]." ".$readRow["fld_staff_lname"]; ?></td>
        </tr>
        <tr>
          <td>Customer:</td>
          <td><?php echo $readRow["fld_customer_fname"]." ".$readRow["fld_customer_lname"]; ?></td>
        </tr>        
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </tfoot>
    </table>
    <?php $conn= null; ?>
    <hr>

    <!--form body-->   
    <div class="form-group">
      <form action="orders_details.php" method="post">
        <div class="row">
          <div class="col-sm-4">
            <label for="orderProduct">Product</label>
          </div>
          <div class="col-sm-8">
            <select class="form-control"id="orderProduct" name="pid"required>
              <?php 
                  try{$conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $stmt=$conn->prepare("SELECT * FROM tbl_products_a197547_pt2");
                    $stmt->execute();
                    $result=$stmt->fetchAll();
                    //var_dump($result);
                  }
                  catch(PDOException $e) {
                      echo $e;
                    }
                    foreach ($result as $item){
               ?>
               <option  value="<?php echo $item["fld_product_num"]; ?>"><?php echo $item["fld_product_brand"]." ".$item["fld_product_name"]; ?></option>
               <?php 
                  }
                  $conn=null;
                ?>
            </select>
          </div>    
        </div><br>   

        <div class="row">
          <div class="col-sm-4">
            <label for="productQuantity">Quantity</label>
          </div>
          <div class="col-sm-8">
            <input class="form-control" id="productQuantity" required name="quantity" type="number">
          </div>    
        </div><br>   

        <input type="hidden" name="oid" value="<?php echo $readRow['fld_order_num'] ?>">
        
        <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-8 col-xs-offset-2 col-sm-offset-4">  
            <button class="btn btn-success" type="submit" name="addproduct">Add Product</button>
            <button class="btn btn-danger" type="reset">Clear</button>
          </div>
        </div> 
      </form>
    </div>
    <!--table body-->   
    <br>
    <hr>
    <div class="col-sm-8 col-sm-offset-4">
          <h3>Order Detail Database</h3>  
    </div>  
    <table class="table table-bordered table-hover table-responsive">
      <thead>
        <tr>
        <td>Order Detail ID</td>
        <td>Product</td>
        <td>Quantity</td>
        <td></td>
      </tr>
      </thead>
      <tbody>
        <?php 
          try{
            $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
              $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              $stmt=$conn->prepare("SELECT * FROM tbl_orders_a197547,tbl_orders_details_a197547,tbl_products_a197547_pt2 WHERE tbl_orders_a197547.fld_order_num=:oid and 
                tbl_orders_details_a197547.fld_order_num=tbl_orders_a197547.fld_order_num and 
                tbl_orders_details_a197547.fld_product_num=tbl_products_a197547_pt2.fld_product_num;  ");
              $stmt->bindParam(":oid",$_GET['oid'],PDO::PARAM_STR);
              $stmt->execute();
              $result=$stmt->fetchAll();
              //var_dump($result);
            }
            catch(PDOException $e) {
                echo $e;
            }
            foreach ($result as $item){
         ?>

        <tr>
          <td><?php echo $item['fld_order_detail_num']; ?></td>
          <td><?php echo $item["fld_product_name"] ?></td>
          <td><?php echo $item["fld_order_detail_quantity"] ?></td>
          <td>
            <a type="button" class="btn btn-warning btn-sm" href="orders_details.php?delete=<?php echo $item['fld_order_detail_num'] ?>&oid=<?php echo $_GET['oid']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </tr>
        <?php 
          }
          $conn=null;
         ?>
       </tbody>
       <tfoot>
         
       </tfoot>
    </table>
    <hr>
    <div class="row">
      <div class="col-xs-4 col-xs-offset-2 col-sm-offset-4 col-sm-4">
        <a role="button" class="btn btn-info" href="invoice.php?oid=<?php echo $_GET["oid"]; ?>" target="_blank"><span class="glyphicon glyphicon-check"></span>Generate Invoice</a>
      </div>
    </div>
    
  </div>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>
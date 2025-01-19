<?php 
  include_once("orders_crud.php");
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Bike Ordering System : Orders</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">   
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar nav-tabs">
    <ul class="nav nav-tabs">
      <li>
        <a href="index.php">Home</a>
      </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Products
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="products.php">Add Product</a></li>
            <li><a href="products_details.php">Database</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">HR
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
    <!--form body-->   
    <div class="form-group">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-4">
          <h3>Insert New Order</h3>  
        </div>       
      </div>
      <form action="orders.php" method="post" class="form-horizontal form-group">

        <div class="row">
          <div class="col-sm-4">
            <label for="productId">Order ID</label>
          </div>
          <div class="col-sm-8">
            <input class="form-control" id="productId" name="oid" type="text"readonly value="<?php if(isset($_GET['edit'])) echo $editRow['fld_order_num']; ?>" required> 
          </div>    
        </div><br>   

        <div class="row">
          <div class="col-sm-4">
            <label for="productDate">Order Date</label>
          </div>
          <div class="col-sm-8">
            <input class="form-control" id="productDate" name="orderdate" type="text" readonly value="<?php if(isset($_GET['edit'])) echo $editRow['fld_order_date']; ?>" required> 
          </div>    
        </div><br>   

        <div class="row">
          <div class="col-sm-4">
            <label for="orderStaff">Staff</label>
          </div>
          <div class="col-sm-8">
            <select class="form-control" id="orderStaff" name="sid" required>
            <?php 
            try {
              $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
              $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              $stmt=$conn->prepare("select fld_staff_num,fld_staff_fname,fld_staff_lname from tbl_staffs_a197547_pt2");
              $stmt->execute(); 
              $result=$stmt->fetchAll();
            } catch (PDOException $e) {
              echo $e;
            }
            foreach($result as $staff){
            ?>
              <option value="<?php echo $staff["fld_staff_num"] ?>" <?php if  ((isset($_GET['edit'])) &&(strcmp($staff["fld_staff_num"], $editRow['fld_staff_num'])==0)) echo "selected"; ?> ><?php echo $staff["fld_staff_fname"]." ".$staff["fld_staff_lname"]; ?></option>
            <?php 
              }
              $conn=null
             ?>
           </select>
          </div>    
        </div><br>   



        <div class="row">
          <div class="col-sm-4">
            <label for="productCustomer">Customer</label>
          </div>
          <div class="col-sm-8">
            <select name="cid" class="form-control" id="productCustomer" required>
              <?php 
                try {
                  $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                  $stmt=$conn->prepare("select fld_customer_num,fld_customer_fname,fld_customer_lname from tbl_customers_a197547_pt2");
                  $stmt->execute(); 
                  $result=$stmt->fetchAll();
                } catch (PDOException $e) {
                  echo $e;
                }
                foreach($result as $customer){
              ?>
                <option value="<?php echo $customer["fld_customer_num"] ?>" <?php if  ((isset($_GET['edit'])) &&(strcmp($customer["fld_customer_num"], $editRow['fld_customer_num'])==0)) echo "selected"; ?> ><?php echo $customer["fld_customer_fname"]." ".$customer["fld_customer_lname"]; ?></option>
              <?php 
                }
                $conn=null
               ?>
            </select><br>
          </div>    
        </div><br> 

        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-4">
            <?php if (isset($_GET['edit'])) { ?>
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
          <h3>Order Database</h3>  
    </div>     
    <hr>
    <br>
    <table class="table table-bordered table-hover table-responsive">
      <thead class="thead">
        <tr>
        <td>Order ID</td>
        <td>Order Date</td>
        <td>Staff ID</td>
        <td>Customer ID</td>
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
            $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt=$conn->prepare("select * from tbl_orders_a197547");
            $stmt->execute(); 
            $result=$stmt->fetchAll();
            //get max page
            $maxPage=ceil(count($result)/5);

            $stmt=$conn->prepare("select * from tbl_orders_a197547 order by fld_order_num asc limit $startRow,5");
            $stmt->execute(); 
            $result=$stmt->fetchAll();
          } catch (PDOException $e) {
            echo $e;
        }
        foreach ($result as $order){

         ?>
        <tr>
        <td><?php echo $order["fld_order_num"]; ?></td>
        <td><?php echo $order["fld_order_date"]; ?></td>
        <td><?php echo $order["fld_staff_num"]; ?></td>
        <td><?php echo $order["fld_customer_num"]; ?></td>
        <td>
          <div class="btn-group btn-group-xs ">
            <a type="button" class="btn btn-info btn-sm" href="orders_details.php?oid=<?php echo $order["fld_order_num"]; ?>">Details</a>
            <a type="button" class="btn btn-default btn-sm" href="orders.php?edit=<?php echo $order['fld_order_num']; ?>">Edit</a>
            <a type="button" class="btn btn-warning btn-sm" href="orders.php?delete=<?php echo $order['fld_order_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
          </div>     
        </td>
      </tr>

      <?php 
        }
        $conn=null;
       ?>
     </tbody>
     <tfoot>
       
     </tfoot>
    </table>
    <div class="justify-content-center btn-group">
      <a role="button" class="btn btn-default <?php if($page==1) echo "disabled"; ?>" href="orders.php?page=<?php echo $page-1; ?>">«</a>
      <?php
      for ($i=1; $i <=$maxPage; $i++) { 
       ?>
       <a role="button" class="btn btn-default" href="orders.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
     <?php } ?>
      <a role="button" class="btn btn-default <?php if($page==$maxPage) echo "disabled"; ?>" href="orders.php?page=<?php echo $page+1; ?>">»</a>
    </div>
  </div>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>
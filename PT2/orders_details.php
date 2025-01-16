<?php 
  include_once("orders_details_crud.php");
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>My Bike Ordering System : Order Details</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    Order ID: <?php echo $_GET['oid']; ?><br>
    <?php 
      try{
            $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt=$conn->prepare("SELECT * FROM tbl_orders_a123456,tbl_staffs_a123456,tbl_customers_a123456 
              WHERE tbl_orders_a123456.fld_order_num=:oid and 
              tbl_orders_a123456.fld_staff_num=tbl_staffs_a123456.fld_staff_num 
              and tbl_orders_a123456.fld_customer_num=tbl_customers_a123456.fld_customer_num; ");
            $stmt->bindParam(":oid",$_GET['oid'],PDO::PARAM_STR);
            $stmt->execute();
            $readRow=$stmt->fetch(PDO::FETCH_ASSOC);
          }
          catch(PDOException $e) {
              echo $e;
          }
     ?>
    Order Date: <?php echo $readRow["fld_order_date"]; ?> <br>
    Staff: <?php echo $readRow["fld_staff_fname"].$readRow["fld_staff_lname"]; ?> <br>
    Customer: <?php echo $readRow["fld_customer_fname"].$readRow["fld_customer_lname"]; ?> <br>
    <?php $conn= null; ?>
    <hr>
    <form action="orders_details.php" method="post">
      Product
      <select name="pid">
        <?php 
            try{$conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
              $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              $stmt=$conn->prepare("SELECT * FROM tbl_products_a123456");
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
      Quantity
      <input name="quantity" type="text">
      <input type="hidden" name="oid" value="<?php echo $readRow['fld_order_num'] ?>">
      <button type="submit" name="addproduct">Add Product</button>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Order Detail ID</td>
        <td>Product</td>
        <td>Quantity</td>
        <td></td>
      </tr>
      <?php 
        try{
          $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt=$conn->prepare("SELECT * FROM tbl_orders_a123456,tbl_orders_details_a123456,tbl_products_a123456 WHERE tbl_orders_a123456.fld_order_num=:oid and 
              tbl_orders_details_a123456.fld_order_num=tbl_orders_a123456.fld_order_num and 
              tbl_orders_details_a123456.fld_product_num=tbl_products_a123456.fld_product_num;  ");
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
          <a href="orders_details.php?delete=<?php echo $item['fld_order_detail_num'] ?>&oid=<?php echo $_GET['oid']; ?>">Delete</a>
        </td>
      </tr>
      <?php 
        }
        $conn=null;
       ?>
    </table>
    <hr>
    <a href="invoice.php?oid=<?php echo $_GET["oid"]; ?>" target="_blank">Generate Invoice</a>
  </center>
</body>
</html>
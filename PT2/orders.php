<?php 
  include_once("orders_crud.php");
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>My Bike Ordering System : Orders</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="orders.php" method="post">
      Order ID
      <input name="oid" type="text"  readonly value="<?php if(isset($_GET['edit'])) echo $editRow['fld_order_num']; ?>"> <br>
      Order Date
      <input name="orderdate" type="text" readonly value="<?php if(isset($_GET['edit'])) echo $editRow['fld_order_date']; ?>"> <br>      Staff
      <select name="sid">
      <?php 
        try {
          $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
          $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          $stmt=$conn->prepare("select fld_staff_num,fld_staff_fname,fld_staff_lname from tbl_staffs_a123456");
          $stmt->execute(); 
          $result=$stmt->fetchAll();
        } catch (PDOException $e) {
          echo $e;
        }
        foreach($result as $staff){
      ?>
        <option value="<?php echo $staff["fld_staff_num"] ?>" <?php if  ((isset($_GET['edit'])) &&(strcmp($staff["fld_staff_num"], $editRow['fld_staff_num'])==0)) echo "selected"; ?> ><?php echo $staff["fld_staff_fname"].$staff["fld_staff_lname"]; ?></option>
      <?php 
        }
        $conn=null
       ?>
       </select> <br>
      Customer
      <select name="cid">
        <?php 
          try {
            $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt=$conn->prepare("select fld_customer_num,fld_customer_fname,fld_customer_lname from tbl_customers_a123456");
            $stmt->execute(); 
            $result=$stmt->fetchAll();
          } catch (PDOException $e) {
            echo $e;
          }
          foreach($result as $customer){
        ?>
          <option value="<?php echo $customer["fld_customer_num"] ?>" <?php if  ((isset($_GET['edit'])) &&(strcmp($customer["fld_customer_num"], $editRow['fld_customer_num'])==0)) echo "selected"; ?> ><?php echo $customer["fld_customer_fname"].$customer["fld_customer_lname"]; ?></option>
        <?php 
          }
          $conn=null
         ?>
      </select> <br>
      <?php if (isset($_GET['edit'])) { ?>
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Order ID</td>
        <td>Order Date</td>
        <td>Staff ID</td>
        <td>Customer ID</td>
        <td></td>
      </tr>
        <?php 
           try {
            $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt=$conn->prepare("select * from tbl_orders_a123456");
            $stmt->execute(); 
            $result=$stmt->fetchAll();
          } catch (PDOException $e) {
            echo $e;
        }
        foreach ($result as $order){

         ?>
        <tr>
        <td><?php echo $order["fld_order_num"] ?></td>
        <td><?php echo $order["fld_order_date"] ?></td>
        <td><?php echo $order["fld_staff_num"] ?></td>
        <td><?php echo $order["fld_customer_num"] ?></td>
        <td>
          <a href="orders_details.php?oid=<?php echo $order["fld_order_num"] ?>">Details</a>
          <a href="orders.php?edit=<?php echo $order["fld_order_num"] ?>">Edit</a>
          <a href="orders.php?delete=<?php echo $order["fld_order_num"] ?>">Delete</a>
        </td>
      </tr>
      <?php 
        }
        $conn=null;
       ?>
    </table>
  </center>
</body>
</html>
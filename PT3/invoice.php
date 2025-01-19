<?php
  include_once 'database.php';
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Decent Lamp Ordering System : Invoice</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <div class="container col-md-11 col-md-offset-1">
    <div class="row">
      <div class="col-sm-4 col-sm-offset-1 text-left">
        <h3>Decent Lamp Store</h3> 
      </div>      
      <div class="col-sm-6 text-right">
        <h3>INVOICE</h3>
      </div>
    </div>
    <br><br>
    <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_a197547, tbl_staffs_a197547_pt2,
        tbl_customers_a197547_pt2, tbl_orders_details_a197547 WHERE
        tbl_orders_a197547.fld_staff_num = tbl_staffs_a197547_pt2.fld_staff_num AND
        tbl_orders_a197547.fld_customer_num = tbl_customers_a197547_pt2.fld_customer_num AND
        tbl_orders_a197547.fld_order_num = tbl_orders_details_a197547.fld_order_num AND
        tbl_orders_a197547.fld_order_num = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
    <div class="row">
      <div class="col-sm-4">
        <div><label>Bill To</label></div>
        
      </div>
      <div class="col-sm-7 col-md-7 text-right">
        <div>
          <label class="col-md-6">Order ID:
          </label>
        <?php echo $readrow['fld_order_num'] ?>
        </div>  
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <?php echo $readrow['fld_customer_fname']." ".$readrow['fld_customer_lname'] ?>
        </div>
      <div>
        <div class="col-sm-7 col-md-7 text-right">
          <label class="col-md-6 col-lg-6">Order Date:</label><?php echo $readrow['fld_order_date'] ?>
        </div>
      </div>
    </div>
<!--table body-->  
<br><br>
    <table class="table table-bordered table-striped table-responsive">
      <thead class="thead">
        <tr><b>
        <td>No</td>
        <td>Product</td>
        <td>Quantity</td>
        <td>Price(RM)/Unit</td>
        <td>Total(RM)</td>
      </tr></b>
      </thead>
      
      <?php
      $grandtotal = 0;
      $counter = 1;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a197547,
            tbl_products_a197547_pt2 where 
            tbl_orders_details_a197547.fld_product_num = tbl_products_a197547_pt2.fld_product_num AND
            fld_order_num = :oid");
        $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
          $oid = $_GET['oid'];
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $detailrow) {
      ?>
      <tr>
        <td><?php echo $counter; ?></td>
        <td><?php echo $detailrow['fld_product_name']; ?></td>
        <td><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
        <td><?php echo $detailrow['fld_product_price']; ?></td>
        <td><?php echo $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity']; ?></td>
      </tr>
      <?php
        $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity'];
        $counter++;
      } // while
      $conn = null;
      ?>
      <tr>
        <td colspan="4" align="right"><h4>Grand Total</h4></td>
        <td><?php echo $grandtotal ?></td>
      </tr>
    </table>
    <hr>
    <div class="row">
      <div>
        <label>Staff:</label>
        <?php echo $readrow['fld_staff_fname']." ".$readrow['fld_staff_lname'] ?>
      </div>
      <div>
        Selangor,Bangi,43650
      </div>
      <div>
        Computer-generated invoice. No signature is required.
      </div>
      
    </div>
    <hr>
  </div>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>
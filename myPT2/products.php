<?php  
  include_once 'products_crud.php';
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Bike Ordering System : Products</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="products.php" method="post">
      Product ID
      <input name="pid" type="text" value="<?php if(isset($_GET['edit'])) echo $editRow['fld_product_num']; ?>"> <br>      Name
      <input name="name" type="text" value="<?php if(isset($_GET['edit'])) echo $editRow['fld_product_name']; ?>"> <br>      Brand
      <select name="brand">
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
      </select> <br>
            Price
      <input name="price" type="text" value="<?php if(isset($_GET['edit'])) echo $editRow['fld_product_price']; ?>"> <br>
      room_position
      <select id="room">
        <option value="lobby">lobby</option>
        <option value="livingRoom">living room</option>
        <option value="bedroom">bedroom</option>
        <option value="study">study</option>
        <option value="bathroom">bathroom</option>
        <option value="Balcony">balcony</option>
        <option value="outside">outside</option>
      </select><u onclick="addPosition()">add</u><input name="position" id="position" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_product_position"] ?>"><br>
            material
      <input name="material"  type="text"value="<?php if(isset($_GET['edit'])) echo $editRow['fld_product_material']; ?>"> <br>
      specialty
      <textarea name="specialty"><?php if(isset($_GET['edit'])) echo $editRow['fld_product_specialty']; ?></textarea><br>
      Quantity
      <input name="quantity" type="number" value="<?php if(isset($_GET['edit'])) echo $editRow['fld_product_quantity']; ?>"> <br>
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editRow['fld_product_num']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?> 
      <button type="submit" name="create">Create</button>
      <button type="reset">Clear</button>
      <?php } ?>
    </form>
    <hr>
    <table border="1">
      <thead>
        <td>Product ID</td>
        <td>Name</td>
        <td>Brand</td>
        <td>Price</td>
        <td>room_position</td>
        <td>material</td>
        <td>specialty</td>
        <td>quantity</td>
        <td></td>
      </thead>
      
        <?php  
          try {
            $stmt=$conn->prepare("SELECT*FROM tbl_products_a197547_pt2 order by fld_product_num desc");
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
        <td><?php echo $readRow['fld_product_brand']; ?></td>
        <td><?php echo $readRow['fld_product_price']; ?></td>
        <td><?php foreach (explode(';',$readRow['fld_product_position'],-1) as $value) {
          echo $value.'<br>';
        }; ?></td>
        <td><?php echo $readRow['fld_product_material']; ?></td>
        <td><?php echo explode(';',$readRow['fld_product_specialty'],-1)[0]; ?></td>
        <td><?php echo $readRow['fld_product_quantity']; ?></td>

        <td>
          <a href="products_details.php?pid=<?php echo $readRow['fld_product_num']; ?>">Details</a>
          <a href="products.php?edit=<?php echo $readRow['fld_product_num']; ?>">Edit</a>
          <a href="products.php?delete=<?php echo $readRow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
        }
        $conn = null;
      ?>
    </table>
  </center>
</body>
<script type="text/javascript">
  function addPosition() {
    var a = document.getElementById("room");
  var text = a.options[a.selectedIndex].value;
  document.getElementById("position").value+=text+";"
  //window.alert(text)

  }
</script>
</html>
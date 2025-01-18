<?php 
  include_once("staffs_crud.php");
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>My Bike Ordering System : Staffs</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="staffs.php" method="post">
      Staff ID
      <input name="sid" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_num"]; ?>"> <br>
      First Name
      <input name="fname" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_fname"]; ?>"> <br>
      Last Name
      <input name="lname" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_lname"]; ?>"> <br>
      Gender
      <input name="gender" type="radio" value="Male" <?php  
      if(isset($_GET['edit']))
        if (strcmp($editRow["fld_staff_gender"], "Male")==0) { echo "checked"; }?> > Male
      <input name="gender" type="radio" value="Female"<?php  
      if(isset($_GET['edit']))
        if (strcmp($editRow["fld_staff_gender"], "Female")==0) {
                  echo "checked";
                }?> > Female <br>

      Marital Status
      <input type="radio" name="marital" value="Divorced" <?php  if(isset($_GET['edit'])) if (strcmp($editRow["fld_staff_marital"], "Divorced")==0) { echo "checked"; }?>>Divorced
      <input type="radio" name="marital" value="Married" <?php  if(isset($_GET['edit'])) if (strcmp($editRow["fld_staff_marital"], "Married")==0) { echo "checked"; }?>>Married
      <input type="radio" name="marital" value="Windowed" <?php  if(isset($_GET['edit'])) if (strcmp($editRow["fld_staff_marital"], "Windowed")==0) { echo "checked"; }?>>Windowed
      <input type="radio" name="marital" value="Single" <?php  if(isset($_GET['edit'])) if (strcmp($editRow["fld_staff_marital"], "Single")==0) { echo "checked"; }?>>Single
      <br>
      Phone Number
      <input name="phone" type="text"value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_phone"]; ?>" > <br>
      Email Address
      <input name="email" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_email"]; ?>"> <br>
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldsid" value="<?php echo $editRow['fld_staff_num']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Staff ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Gender</td>
        <td>Phone Number</td>
        <td>Email Address</td>
        <td></td>
      </tr>
      <?php  
        try {
          $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
          $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          $stmt=$conn->prepare("select * from tbl_staffs_a197547_pt2");
          $stmt->execute();
          $result=$stmt->fetchAll();
        }
        catch(PDOException $e){
          echo $e;
        }
        foreach ($result as $staff) {
          // code...
        
      ?>
      <tr>
        <td><?php echo $staff["fld_staff_num"]; ?></td>
        <td><?php echo $staff["fld_staff_fname"]; ?></td>
        <td><?php echo $staff["fld_staff_lname"]; ?></td>
        <td><?php echo $staff["fld_staff_gender"]; ?></td>
        <td><?php echo $staff["fld_staff_phone"]; ?></td>
        <td><?php echo $staff["fld_staff_email"]; ?></td>
        <td>
          <a href="staffs.php?edit=<?php echo $staff["fld_staff_num"]; ?>">Edit</a>
          <a href="staffs.php?delete=<?php echo $staff["fld_staff_num"]; ?>">Delete</a>
        </td>
      </tr>
      <?php 
        }
        $conn=null
       ?>
    </table>
  </center>
</body>
</html>	
<?php 
  session_start();
  
  include_once("staffs_crud.php");
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Bike Ordering System : Staffs</title>
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
        <li class="dropdown active">
          <a class="dropdown-toggle" data-toggle="dropdown">HR
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="customers.php">Customer</a></li>
            <li class="active"><a href="staffs.php">Staff</a></li>
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
          <h3>Insert New Staff</h3> 
        </div>       
      </div>
      <form action="staffs.php" method="post" class="form-horizontal form-group"><br> 
        <div class="row">
          <div class="col-sm-4">
            <label for="staffId">Staff ID</label>
          </div>
          <div class="col-sm-8">
            <input class="form-control" id="staffId" name="sid" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_num"]; ?>" required> 
          </div>    
        </div><br>
          <div class="row">
            <div class="col-sm-4">
              <label for="staffFname">First Name</label>
            </div>
            <div class="col-sm-8">
              <input class="form-control" id="staff" name="fname" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_fname"]; ?>" required> 
            </div>    
          </div><br>   

          <div class="row">
            <div class="col-sm-4">
              <label for="staffLname">Last Name</label>
            </div>
            <div class="col-sm-8">
              <input class="form-control" id="staffLname" name="lname" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_lname"]; ?>" required> 
            </div>    
          </div><br>

          <div class="row">
            <div class="col-sm-4">
              <label for="staffGender">Gender</label>
            </div>
            <div class="col-sm-8">
              <input class="" id="staffGender" name="gender" type="radio" value="Male" <?php  
              if(isset($_GET['edit']))
                if (strcmp($editRow["fld_staff_gender"], "Male")==0) { echo "checked"; }?> required>Male    <input id="staffGender" name="gender" type="radio" value="Female"<?php  
              if(isset($_GET['edit']))
                if (strcmp($editRow["fld_staff_gender"], "Female")==0) {
                          echo "checked";
                  }?> > Female
            </div>    
          </div><br>

          <div class="row">
            <div class="col-sm-4">
              <label for="staff">Marital Status</label>
            </div>
            <div class="col-sm-8">
              <input class="" id="staff" type="radio" name="marital" value="Divorced" <?php  if(isset($_GET['edit'])) if (strcmp($editRow["fld_staff_marital"], "Divorced")==0) { echo "checked"; }?>>Divorced
              <input type="radio" name="marital" value="Married" <?php  if(isset($_GET['edit'])) if (strcmp($editRow["fld_staff_marital"], "Married")==0) { echo "checked"; }?>>Married
              <input type="radio" name="marital" value="Windowed" <?php  if(isset($_GET['edit'])) if (strcmp($editRow["fld_staff_marital"], "Windowed")==0) { echo "checked"; }?>>Windowed
              <input type="radio" name="marital" value="Single" <?php  if(isset($_GET['edit'])) if (strcmp($editRow["fld_staff_marital"], "Single")==0) { echo "checked"; }?>>Single
            </div>    
          </div><br>
        <div class="row">
          <div class="col-sm-4">
            <label for="staffPhone">Phone Number</label>
          </div>
          <div class="col-sm-8">
            <input class="form-control" id="staffPhone" name="phone" type="text"value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_phone"]; ?>" required> 
          </div>    
        </div><br>   

        <div class="row">
          <div class="col-sm-4">
            <label for="staffEmail">Email Address</label>
          </div>
          <div class="col-sm-8">
            <input class="form-control" id="staffEmail" name="email" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_email"]; ?>" required> 
          </div>    
<!--password-->
        </div><br>   
        <div class="row">
          <div class="col-sm-4">
            <label for="staffPass">Password</label>
          </div>
          <div class="col-sm-8">
            <input class="form-control" id="staffPass" name="password" type="password" value="<?php if (isset($_GET['edit'])) echo $editRow["fld_staff_password"]; ?>" required> 
          </div>    
        </div><br>
<!--level-->
        <div class="row">
          <div class="col-sm-4">
            <label for="staffLevel">Level</label>
          </div>
          <div class="col-sm-8">
            <input class="" id="staffLevel" name="level" type="radio" value="normal" <?php  
            if(isset($_GET['edit']))
              if (strcmp($editRow["fld_staff_level"], "normal")==0) { echo "checked"; }?> >normal    <input id="staffLevel" name="level" type="radio" value="admin"<?php  
            if(isset($_GET['edit']))
              if (strcmp($editRow["fld_staff_level"], "admin")==0) {
                        echo "checked";
                }?> > admin
          </div>    
        </div><br>

        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-4">
            <?php if (isset($_GET['edit'])) { ?>
            <input  type="hidden" name="oldsid" value="<?php echo $editRow['fld_staff_num']; ?>">
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
          <td>Staff ID</td>
          <td>First Name</td>
          <td>Last Name</td>
          <td>Gender</td>
          <td>Marital Status</td>
          <td>Phone Number</td>
          <td>Email Address</td>
          <td>Level</td>
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
            $startRow=($page-1)*4;
            $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt=$conn->prepare("select * from tbl_staffs_a197547_pt2");
            $stmt->execute();
            $result=$stmt->fetchAll();
            //get max page
            $maxPage=ceil(count($result)/4);
            $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt=$conn->prepare("select * from tbl_staffs_a197547_pt2 order by fld_staff_num asc limit $startRow,4");
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
          <td><?php echo $staff["fld_staff_marital"]; ?></td>
          <td><?php echo $staff["fld_staff_phone"]; ?></td>
          <td><?php echo $staff["fld_staff_email"]; ?></td>
          <td><?php echo $staff["fld_staff_level"]; ?></td>
          <td>
            <div class="btn-group btn-group-xs ">
              <a type="button" class="btn btn-default btn-sm" href="staffs.php?edit=<?php echo $staff["fld_staff_num"]; ?>">Edit</a>
              <a type="button" class="btn btn-warning btn-sm" href="staffs.php?delete=<?php echo $staff["fld_staff_num"]; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
            </div>  
          </td>
        </tr>
        <?php 
          }
          $conn=null
         ?>
       </tbody> 
       <tfoot>
         
       </tfoot>
    </table>
    <div class="justify-content-center btn-group">
      <a role="button" class="btn btn-default <?php if($page==1) echo "disabled"; ?>" href="staffs.php?page=<?php echo $page-1; ?>">«</a>
      <?php
      for ($i=1; $i <=$maxPage; $i++) { 
       ?>
       <a role="button" class="btn btn-default" href="staffs.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
     <?php } ?>
      <a role="button" class="btn btn-default <?php if($page==$maxPage) echo "disabled"; ?>" href="staffs.php?page=<?php echo $page+1; ?>">»</a>
    </div>
  </div>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>	
<?php
include_once("customers_crud.php");
if(isset($_GET['error'])){
    echo "<span style=\"color: red; \"> Operation Failed: Insufficient Permission</span><br>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Bike Ordering System : Customers</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default">
    <ul class="nav nav-tabs">
        <li >
            <a href="index.php">Home</a>
        </li>
        <li class="dropdown ">
            <a class="dropdown-toggle " data-toggle="dropdown">Products
                <span class="caret" ></span></a>
            <ul class="dropdown-menu">
                <li><a href="products.php" >Add Product</a></li>
                <li><a href="products_details.php">Database</a></li>
            </ul>
        </li>
        <li class="dropdown active">
            <a class="dropdown-toggle" data-toggle="dropdown">HR
                <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li class="active"><a href="customers.php">Customer</a></li>
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
                <h3>Insert New Customer</h3>
            </div>
        </div>
        <form action="customers.php" method="post" class="form-horizontal form-group"><br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="customerId">Customer ID</label>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" id="customerId" name="cid" type="text" value="<?php if (isset($_GET['edit'])) echo $editRow['fld_customer_num'] ?>" required>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="customerFname">First Name</label>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" id="customerFname" name="fname" type="text" value='<?php if (isset($_GET['edit'])) echo $editRow['fld_customer_fname'] ?>' required>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="customerLname">Last Name</label>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" id="customerLname" name="lname" type="text" value='<?php if (isset($_GET['edit'])) echo $editRow['fld_customer_lname'] ?>' required>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="customerGender">Gender</label>
                </div>
                <div class="col-sm-8 form-check">
                    <input id="Male" class="form-check-input" name="gender" type="radio" value="Male" <?php if(isset($_GET['edit'])) if(strcmp($editRow['fld_customer_gender'], "Male")==0) echo "checked"; ?>>
                    <label class="form-check-label" for="Male">
                        Male
                    </label>
                    <input name="gender" class="form-check-input" type="radio" value="Female" <?php if(isset($_GET['edit'])) if(strcmp($editRow['fld_customer_gender'], "Female")==0) echo "checked"; ?>>
                    <label class="form-check-label" for="Female">
                        Female
                    </label>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="customerBirthday">Birthday</label>
                </div>
                <div class="col-sm-8">
                    <input id="customerBirthday" class="form-control" type="date" name="birthday" value="<?php if (isset($_GET['edit'])) echo $editRow['fld_customer_birthday'] ?>">
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="customerPhone">Phone Number</label>
                </div>
                <div class="col-sm-8">
                    <input id="customerPhone" class="form-control" name="phone" type="text" value='<?php if (isset($_GET['edit'])) echo $editRow['fld_customer_phone'] ?>'>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <?php if (isset($_GET['edit'])) { ?>
                        <input type="hidden" name="oldcid" value="<?php echo $editRow['fld_customer_num']; ?>">
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
    <!--table database-->
    <br>
    <div class="col-sm-8 col-sm-offset-4">
        <h3>Customer Database</h3>
    </div>
    <hr>
    <br>
    <table class="table table-bordered table-hover table-responsive">
        <thead>
        <tr>
            <td>Customer ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Gender</td>
            <td>Birthday</td>
            <td>Phone Number</td>
            <td></td>
        </tr>
        </thead>

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
            $stmt=$conn->prepare("select * from tbl_customers_a197547_pt2");
            $stmt->execute();
            $result=$stmt->fetchAll();
            $maxPage=ceil(count($result)/4);
            $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt=$conn->prepare("select * from tbl_customers_a197547_pt2 order by fld_customer_num asc limit $startRow,4");
            $stmt->execute();
            $result=$stmt->fetchAll();

        }
        catch(PDOException $e){
            echo $e;
        }
        foreach ($result as $cus) {
        // code...

        ?>
        <tbody>
        <tr>
            <td><?php echo $cus['fld_customer_num'] ?></td>
            <td><?php echo $cus['fld_customer_fname'] ?></td>
            <td><?php echo $cus['fld_customer_lname'] ?></td>
            <td><?php echo $cus['fld_customer_gender'] ?></td>
            <td><?php echo $cus['fld_customer_birthday']; ?></td>
            <td><?php echo $cus['fld_customer_phone'] ?></td>
            <td>
                <div class="btn-group btn-group-xs ">
                    <a type="button" class="btn btn-default btn-sm" href="customers.php?edit=<?php echo $cus['fld_customer_num'] ?>">Edit</a>
                    <a type="button" class="btn btn-warning btn-sm" href="customers.php?delete=<?php echo $cus['fld_customer_num'] ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
                </div>
            </td>
        </tr>
        <?php
        }
        $conn=null;
        ?>
        </tr>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
    <div class="justify-content-center btn-group">
        <a role="button" class="btn btn-default <?php if($page==1) echo "disabled"; ?>" href="customers.php?page=<?php echo $page-1; ?>">«</a>
        <?php
        for ($i=1; $i <=$maxPage; $i++) {
            ?>
            <a role="button" class="btn btn-default" href="customers.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php } ?>
        <a role="button" class="btn btn-default <?php if($page==$maxPage) echo "disabled"; ?>" href="customers.php?page=<?php echo $page+1; ?>">»</a>
    </div>
</div>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>


<?php
include_once "products_details_crud.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Bike Ordering System : Products Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        img{
            max-width: 200px;
            max-height: 200px;
        }
        tbody td{
            height: 150px;
        }
        td#action{
            width:150px;
        }
        tfoot td {
            text-align: center;
            font-family: "DejaVu Sans Mono", monospace;
        }
        a#selected{
            background-color: lightslategrey;
        }
        h3{
            text-align: center;
        }
    </style>
</head>
<body>
<!--navigation bar-->
<nav class="navbar navbar-default">
    <ul class="nav nav-tabs">
        <li>
            <a href="index.php">Home</a>
        </li>
        <li class="dropdown active">
            <a class="dropdown-toggle" data-toggle="dropdown">Products
                <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="products.php">Add Product</a></li>
                <li class="active"><a href="products_details.php">Database</a></li>
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
<!--single product detail, if pid are delivered in get method-->
<div class="container">
    <span><h3><?php if(isset($_GET['pid'])){echo $_GET["pid"];} ?></h3></span>
    <table class="table table-bordered table-hover table-responsive">
        <?php
        if (isset($_GET['pid'])) {
        try {
            $stmt=$conn->prepare("SELECT*From tbl_products_a197547_pt2  where fld_product_num = :pid");
            $stmt->bindParam(':pid',$pid,PDO::PARAM_STR);
            $pid=$_GET['pid'];
            $stmt->execute();
            $readRow = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            echo "<p>".$e."</p>";
        }

        ?>
        <thead>
        <tr>
            <td>Product ID:</td>
            <td><?php echo $readRow['fld_product_num']; ?> </td>
        </tr>
        </thead><br>
        <tr>
            <td> Name: </td>
            <td><?php echo $readRow['fld_product_name']; ?> <br></td>
        </tr>
        <tr>
            <td>Brand:</td>
            <td> <?php echo $readRow['fld_product_brand']; ?> <br></td>
        </tr>
        <tr>
            <td>Price:(RM) </td>
            <td> <?php echo $readRow['fld_product_price']; ?> <br></td>
        </tr>
        <tr>
            <td> Room Position:</td>
            <td><?php foreach (explode(';',$readRow['fld_product_position'],-1) as $value) {
                    echo $value.', ';
                }; ?> <br></td>
        </tr>
        <tr>
            <td>Material:</td>
            <td><?php echo $readRow['fld_product_material']; ?> <br></td>
        </tr>
        <tr>
            <td> Specialty:</td>
            <td><?php echo '<p>';foreach (explode(';',$readRow['fld_product_specialty'],-1) as $value) {
                    echo $value." ";
                }; echo ".</p>";?></td>
        </tr>
        <tr>
            <td>Quantity:</td>
            <td><?php
                echo $readRow["fld_product_quantity"]."<br>";
                ?><br></td>
        </tr>
        <tr>
            <td id="image">Image</td>
            <td><img src ="products/<?php if (strcmp($readRow["fld_product_image"], "")!=0) {
                    echo $readRow['fld_product_image'].'.png';
                } else {
                    echo "../../img/noPhoto.png";
                }
                ?>"  alt="product image"></td>
        </tr>
        <tr>
            <td>Edit Image</td>
            <td>
                <form action="products_details.php?pid=<?php echo $_GET['pid'];  ?>" method="post"  enctype="multipart/form-data">
                    <div>
                        <input class="btn btn-default" type='file' name='fileToUpload' id='fileToUpload' required>
                        <input type="hidden" name="pid" value="<?php echo $_GET['pid']; ?>">
                    </div><br>
                    <div>
                        <input class="btn btn-warning btn-sm" title="upload image" type="submit" name="editImage" value="<?php if($readRow['fld_product_image']!==""){echo "Modify";}else{echo("Add"); } ?>">
                        <button class="btn btn-danger btn-sm" title="Delete uploaded image" id="delete" onclick="deleteImage()">Delete</button>
                    </div>
                </form>
            </td>
        </tr>
        <tfoot>
        <tr>
            <td colspan="2"><a href="products_details.php">Return to Database</a></td>
        </tr>
        </tfoot>
    </table>
</div>
<!--lamp database overview, if pid are not delivered-->
<?php
} else{ ?>
    <div class="container">
        <div class="col-sm-8 col-sm-offset-4">
            <h3>Lamp Database</h3>
        </div>
    </div>
    <table class="table table-bordered table-hover table-responsive">
        <thead class="thead">
        <tr>
            <td>Product ID</td>
            <td>Name</td>
            <td>Price(RM)</td>
            <td>Place Position</td>
            <td>Image</td>
            <td>Action</td>
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
            $startRow=($page-1)*3;
            $stmt=$conn->prepare("SELECT*FROM tbl_products_a197547_pt2");
            $stmt->execute();
            $result=$stmt->fetchAll();
            $maxPage=ceil(count($result)/3);
            $stmt=$conn->prepare("SELECT*FROM tbl_products_a197547_pt2 order by fld_product_num asc limit $startRow,3");
            $stmt->execute();
            $result=$stmt->fetchAll();
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }foreach ($result as $readRow) {
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
                <?php
                if($readRow['fld_product_image']!==""){
                    echo '<img src="products/'.$readRow['fld_product_image'].'.png" alt="Product Image">';
                }else{
                    echo '<span class="glyphicon glyphicon-picture"><del>Img</del></span></del>';
                }
                ?><br>
                <a type="button" class="btn btn-link btn-sm" href="products_details.php?pid=<?php echo $readRow['fld_product_num']; ?>#image"><?php if($readRow['fld_product_image']!==""){echo "Modify";}else{echo("Add"); } ?></a>
            </td>
            <td id="action">
                <div class="btn-group btn-group-xs ">
                    <a type="button" class="btn btn-info btn-sm" href="products_details.php?pid=<?php echo $readRow['fld_product_num']; ?>">Details</a>
                    <a type="button" class="btn btn-default btn-sm" href="products.php?edit=<?php echo $readRow['fld_product_num']; ?>">Edit</a>
                    <a type="button" class="btn btn-danger btn-sm" href="products.php?delete=<?php echo $readRow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
                </div>
            </td>

            <?php
            }
            $conn = null;
            ?>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="7">Decent Lamp Store</td>
        </tr>
        </tfoot>
    </table>
    <div class="justify-content-center btn-group">
        <a role="button" class="btn btn-default <?php if($page==1) echo "disabled"; ?>" href="products_details.php?page=<?php echo $page-1; ?>">«</a>
        <?php
        for ($i=1; $i <=$maxPage; $i++) {
            ?>
            <a role="button" class="btn btn-default" href="products_details.php?page=<?php echo $i; ?>" <?php if($page==$i){ echo 'id="selected"';}?>><?php echo $i; ?></a>
        <?php } ?>
        <a role="button" class="btn btn-default <?php if($page==$maxPage) echo "disabled"; ?>" href="products_details.php?page=<?php echo $page+1; ?>">»</a>
    </div>
<?php } ?>

</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script>
    function deleteImage(){
        if(confirm('Are you sure to delete?')===true){
            console.log("products_details.php?pid=<?php echo $_GET['pid']; ?>&delete=true");
            window.location.href="products_details.php?pid=<?php echo $_GET['pid']; ?>&delete=true";
        }
    }
</script>
</html>
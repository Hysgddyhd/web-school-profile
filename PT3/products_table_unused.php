<?php
include_once 'products_crud.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Bike Ordering System : Products</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include_once "nav_bar.php"; ?>
<div class="container">
    <h2 class="page-header">Lamp Database</h2>
    <hr>
    <table class="table table-bordered table-hover table-responsive">
        <thead class="thead">
        <tr>
            <td>Product ID</td>
            <td>Name</td>
            <td>Price(RM)</td>
            <td>Place Position</td>
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
            $stmt=$conn->prepare("SELECT*FROM tbl_products_a197547_pt2");
            $stmt->execute();
            $result=$stmt->fetchAll();
            $maxPage=ceil(count($result)/5);
            $stmt=$conn->prepare("SELECT*FROM tbl_products_a197547_pt2 order by fld_product_num asc limit $startRow,5");
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
            <td><?php echo $readRow['fld_product_price']; ?></td>
            <td><?php foreach (explode(';',$readRow['fld_product_position'],-1) as $value) {
                    echo $value.'<br>';
                }; ?>

            </td>

            <td>
                <div class="btn-group btn-group-xs ">
                    <a type="button" class="btn btn-info btn-sm" href="products_details.php?pid=<?php echo $readRow['fld_product_num']; ?>">Details</a>
                    <a type="button" class="btn btn-default btn-sm" href="products.php?edit=<?php echo $readRow['fld_product_num']; ?>">Edit</a>
                    <a type="button" class="btn btn-warning btn-sm" href="products.php?delete=<?php echo $readRow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
                </div>
            </td>

            <?php
            }
            $conn = null;
            ?>
        </tr>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
    <div class="justify-content-center btn-group">
        <a role="button" class="btn btn-default <?php if($page==1) echo "disabled"; ?>" href="products_table_unused.php?page=<?php echo $page-1; ?>">«</a>
        <?php
        for ($i=1; $i <=$maxPage; $i++) {
            ?>
            <a role="button" class="btn btn-default" href="products_table_unused.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php } ?>
        <a role="button" class="btn btn-default <?php if($page==$maxPage) echo "disabled"; ?>" href="products_table_unused.php?page=<?php echo $page+1; ?>">»</a>
    </div>
</div>
</body>
<script type="text/javascript">
    function addPosition() {
        const a = document.getElementById("room");
        const text = a.options[a.selectedIndex].value;
        document.getElementById("position").value+=text+";"
        //window.alert(text)

    }
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>
<?php
session_start();
if(time()-$_SESSION["login_time_stamp"] >300)
{
    session_unset();
    session_destroy();
    header("Location:account.php");
}
if($_SESSION['level']==""){
    $newURL="index.php?level=none";
    header('Location: '.$newURL);
}
include_once 'database.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


//show the specific product detail
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $target_dir = "products/";
    $target_file = $target_dir . $_GET['pid'].".png";
    //delete image if delete flag is set

    $uploadOk = true;
    $errorMsg="";
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = true;
        } else {
            $errorMsg .= "File is not an image.";
            $uploadOk = false;
        }
    }

    // Check if file already exists
//    if (file_exists($target_file)) {
//        $errorMsg.= "Sorry, file already exists."."<br>";
//        $uploadOk = false;
//    }

    // Check file size
    //1 mb
    if ($_FILES["fileToUpload"]["size"] > 1048576 ) {
        $errorMsg .= "Sorry, your file is too large.";
        $uploadOk = false;
    }

// Allow certain file formats
    if($imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpg") {
        $errorMsg.= "Sorry, only PNG & GIF & JPG files are allowed.";
        $uploadOk = false;
    }

// Check if $uploadOk is set to 0 by an error
    if (!$uploadOk) {
        $errorMsg.= "Sorry, your file was not uploaded.";
        echo '<script type="text/javascript">
            window.onload = function () { 
                alert("'.$errorMsg.'"); 
                document.getElementById("image").scrollIntoView({behavior: "smooth"});}
            </script>';
    }else{
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //update picture path
                $stmt = $conn->prepare("UPDATE tbl_products_a197547_pt2 SET fld_product_image =:picture WHERE fld_product_num=:id");

                // Bind the parameters
                // $stmt->bindParam(':user', $name, PDO::PARAM_STR);

                $stmt->bindParam(':id',$_POST['pid'],PDO::PARAM_STR);
                $stmt->bindParam(':picture',$_POST['pid'],PDO::PARAM_STR);

                $stmt->execute();
                echo '<script type="text/javascript">
            window.onload = function () { 
                alert("successfully change picture"); 
                document.getElementById("image").scrollIntoView({behavior: "smooth"});}
            </script>';
            }
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


}
//delete added image
if (isset($_GET['pid'])&&isset($_GET['delete'])){
//    $target_dir = "products/";
//    $target_file = $target_dir . $_GET['pid'].".png";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt=$conn->prepare("update  tbl_products_a197547_pt2 set fld_product_image='' where fld_product_num=:id ");
        $stmt->bindParam(':id',$_GET['pid'],PDO::PARAM_STR);
        $stmt->execute();
//        echo '<script type="text/javascript">
//            window.onload = function () {
//                alert("Deleted picture");
//                document.getElementById("image").scrollIntoView({behavior: "smooth"});}
//            </script>';
        echo '<script type="text/javascript">
            window.onload = function () { 
                alert("deleted picture"); 
                document.getElementById("image").scrollIntoView({behavior: "smooth"});}
            </script>';
    }catch (Exception $e){
        echo "Error: ".$e->getMessage();
    }
//    $url="products_details?pid=".$_GET['pid'];
//    header('Location: ',$url);
}

?>
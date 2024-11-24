<?php  
    if (isset($_POST['validate_biodata'])){
        $servername = "lrgs.ftsm.ukm.my";
        $username = "a197547";
        $password = "littleyellowcat";
        $dbname = "a197547";
        $isSuccess = false;
        $img= "img/right.jpg";

        try{
           $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO biodata(name,age,sex,address,email,dob,height,phone,color,fbtwig,univ) values (:name,:age,:sex,:address,:email,:dob,:height,:phone,:color,:fbtwig,:univ)");
            $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
            $stmt -> bindParam(':age', $age, PDO::PARAM_INT);
            $stmt -> bindParam(':sex', $sex, PDO::PARAM_STR);
            $stmt -> bindParam(':address', $address, PDO::PARAM_STR);
            $stmt -> bindParam(':email', $email, PDO::PARAM_STR);
            $stmt -> bindParam(':dob', $dob, PDO::PARAM_STR);
            $stmt -> bindParam(':height', $height, PDO::PARAM_INT);
            $stmt -> bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt -> bindParam(':color', $color, PDO::PARAM_STR);
            $stmt -> bindParam(':fbtwig', $fbtwig, PDO::PARAM_STR);
            $stmt -> bindParam(':univ', $univ, PDO::PARAM_STR);

            $name = $_POST['name'];
            $age = $_POST['age'];
            $sex = $_POST['sex'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $dob = $_POST['dob'];
            $height = $_POST['height'];
            $phone = $_POST['phone'];
            $color = $_POST['color'];
            $fbtwig = $_POST['fbtwig'];
            $univ = $_POST['univ'];

            $stmt -> execute();
            echo "New records created succesfully";
            $isSuccess = true;
        }
        catch(PDOException $e){
            echo "Error: " . $e -> getMessage();
        }
        $conn = null;
    }else{
        echo "wrong form";
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>week5 save_bioform</title>
</head>
<body>
    <img src="
<?php  
    if($isSuccess)
        echo $img;
?>
    " alt="false">
</body>
</html>
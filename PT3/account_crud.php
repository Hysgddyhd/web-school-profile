<?php

session_start();
include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//login
if (isset($_POST['login'])) {

    try {

        $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a197547_pt2 WHERE fld_staff_email=:email");

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location:account.php?isInvalidEmail=true");
        }

        $password=trim($_POST['password']);

        $stmt->execute();
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($editRow==null) {

            echo "<span style=\"color: red; \">Wrong Email<br></span>";

        }else if ($editRow["fld_staff_password"]!==$password){
            $editRow=null;
            echo "<span style=\"color: red; \">Wrong Password<br></span>";
        }else{
            echo "success login";
        }
        $_SESSION["login_time_stamp"] = time();


    }

    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}

//Edit
if (isset($_GET['edit'])) {

    try {

        $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a197547_pt2 where fld_staff_num = :sid");

        $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

        $sid = $_GET['edit'];

        $stmt->execute();

        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;


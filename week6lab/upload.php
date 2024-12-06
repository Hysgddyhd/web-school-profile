<?php
	echo '<-   <a href="list.php"> Return</a>'.'<br>';
	echo '<hr>';
	include "db.php";

	session_start();
	if ($_SERVER['REQUEST_METHOD']=="POST"){
		echo "right source"."<br>";
		$target_dir = "picture/";
	  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	  $uploadOk = 1;
	  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	 
	  // Check if image file is a actual image or fake image
	  if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	      $uploadOk = 1;
	    } else {
	      echo "File is not an image.";
	      $uploadOk = 0;
	    }
	  }
	 
	  // Check if file already exists
	  if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	  }
	 
	  // Check file size
	  if ($_FILES["fileToUpload"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	  }
	 
	  // Allow certain file formats
	  if($imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpg") {
	    echo "Sorry, only PNG & GIF & JPG files are allowed.";
	    $uploadOk = 0;
	  }
	 
	  // Check if $uploadOk is set to 0 by an error
	  if ($uploadOk == 0) {
	    echo "<br>"."Sorry, your file was not uploaded.";
	  // if everything is ok, try to upload file
	    die();
	  } 

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

	    try{
    		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		//update picture path 
	        $stmt = $conn->prepare("UPDATE myguestbook SET picture=:picture WHERE id=:id");
     
		      // Bind the parameters
		   // $stmt->bindParam(':user', $name, PDO::PARAM_STR);

		    $stmt->bindParam(':id',$_POST['id'],PDO::PARAM_INT);
		    $stmt->bindParam(':picture',$_FILES["fileToUpload"]["name"],PDO::PARAM_STR);
	      	
		    $stmt->execute();
		 	echo "succes change picture";
	 
	      }
	      catch(PDOException $e)
	      {
	          echo "Error: " . $e->getMessage();
	      }

	  } else {
	      echo "Sorry, there was an error uploading your file.";
	  }

  } else {
  	echo "wrong source";
  }

?>
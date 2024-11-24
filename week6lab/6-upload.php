<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>upload img</title>
</head>
<body>
	<form action="6-upload.php" method="post" enctype="multipart/form-data" safe_mode="off"> <!-- essential -->
		<input type="file" name="img" >
		<br>
		<br>
		<input type="submit" name="submit">
	</form>
</body>
</html>
<?php  
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (is_uploaded_file($_FILES['img']['tmp_name'])) {
   			echo "File ". $_FILES['img']['name'] ." uploaded successfully.\n";
		} else {
   			echo "Possible file upload attack: ";
   			echo "filename '". $_FILES['img']['tmp_name'] . "'.";
		}
	$errors= array();
  $img_name = $_FILES['img']['name'];
  $img_size = $_FILES['img']['size'];
  $img_tmp = $_FILES['img']['tmp_name'];
  $img_type = $_FILES['img']['type'];
  $img_ext = strtolower(end(explode('.',$_FILES['img']['name'])));
  //echo "<br>".$img_ext;
  $target_dir = "/home/typer/Pictures/uploads/";
  $target_img = $target_dir . basename($_FILES["img"]["name"]);
  //echo $img_tmp." -> ".$target_img;
  
  $extensions= array("jpeg","jpg","png");
	
	if(in_array($img_ext,$extensions)=== false){
     $errors[] = "Extension not allowed, please choose either a ".implode(', ', $extensions)." file.";
  }

  if($img_size > 2097152) {
     $errors[] = 'Image size must be excately 2 MB';
  }

  if (file_exists($target_img)) {
    $errors[] = 'Sorry, image already exists.';
  }
  echo "<br>";
  if(empty($errors)==true) {
    if (move_uploaded_file($img_tmp, $target_img)){
    	 echo "<br>The image ". $img_name . " has been uploaded.";
    }else{
    	echo "Image move failed";
    }
    

  } else {
    echo "<ol>";
    foreach($errors as $error) {
      echo "<li>".$error."</li>";
    }
    echo "</ol>";
  }
	} 
?>
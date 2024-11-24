<?php  
	function divide($a){
		if($a == 0 ){
			throw new Exception("divider can not be 0");
			
		}
		return 1/$a;
	}

	//echo "test";
	if (isset($_GET['number']) ){
		if (!is_numeric($_GET['number'])){
			echo "Please enter a vaild number.";
			echo "<br>"."<hr>";
	
		} else {
			$num = $_GET['number'];
		}
		
	//	echo $num;	
	}
	

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>divide</title>
</head>
<body>
	<form action="4-exception_throw.php" method="get">
	enter a real number :<br>
	<input type="text" name="number">
	<br>
	<?php  

	if (isset($num)){
		try {
			echo "answer: ". divide($num);
		}
		catch(Exception $e) {
			echo "Message: ".$e->getMessage();
		}
		

	} 
		echo "<br>".'<input type="submit" name="submit">';
	
	?>
	</form>
	

</body>
</html>
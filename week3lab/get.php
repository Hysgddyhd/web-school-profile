<?php  
	echo "Form result:<br>";
	$color = $_GET["color"];
	//echo $color;
	$date = $_GET["date"];
	$number = $_GET["number"]
	//echo $_GET["color"];
	//echo '<br>'.$_GET["date"];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Result</title>
</head>
<body>
	<table border="1" cellpadding="5" width="40%">
		<tr>
			<td>
				color:
			</td>
				<td bgcolor="<?php echo $color ?>">	</td>
		</tr>
		<tr>
			<td>
				I will go to Negra at: 
			</td>
			<td>
				<p ><?php echo $date  ?></p>
			</td>
		</tr>
		<tr>
			<td>
				My Favorite number: 
			</td>
			<td>
				<p ><?php echo $number  ?></p>
			</td>
		</tr>
	</table>
</body>
</html>
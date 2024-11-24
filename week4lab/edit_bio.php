<?php  
$univ = array(
	array("name" => "Universiti Putra Malaysia","abb"=>"UPM"),
	array("name" => "Universiti Kebangsaan Malaysia","abb"=>"UKM"),
	array("name" => "Universiti Malaysia","abb"=>"UM"),
	array("name" => "Universiti Sains Malaysia","abb"=>"USM"),
	array("name" => "Universiti Teknologi Malaysia","abb"=>"UTM"),
	);
$record = array
	(
		'name' => 'Yuntian Wu',
		'age' => 21,
		'sex' => 'male',
		"address" => 'Selangor Bangi Gateway',
		'email' => 'a197547@siswa.ukm.edu.my',
		'dob' => '2002-12-08',
		'height' => 183,
		'phone' => "+6010-7900812",
		'color' => '#4444cd',
		'fbtwig' => 'https://google.com',
		'univ' => 'UKM',
		'matricnum' => 'a197547'
	);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>week4 edit form</title>
</head>
<body>
	<p style="text-align:left;"><--
		<br><a href="index.html" target="_parent">return</a></p>
		<hr>
	<h2>Biodata Form</h2>
	<form action="validate_biodata.php" method="post">
		<table bgcolor="LightGray" border="1" cellpadding="10" >
			<!-- This a simple input form  -->
			<tr>
				<td>
					Name: 
				</td>
				<td>
					<input   type="text" name="name" maxlength="10" value="<?php echo $record['name'] ?>"  >
				</td>
			</tr>
			<tr>
				<td>
					age: 
				</td>
				<td>
					<input type="number.html" name="age" value="<?php echo $record['age'] ?>" >
				</td>
			</tr>
			<tr>
				<td>
					gender: 
				</td>
				<td>
					<input type="radio"
					name="sex" value="male" checked>Male
				</td>
			</tr>
			<tr>
				<td>
					address: 
				</td>
				<td>
					<?php echo $record['address'] ?>
				</td>
			</tr>
			<tr>
				<td>
					Email:  
				</td>
				<td>
					<?php echo $record['email'] ?>
				</td>
			</tr>
			<tr>
				<td>
					Birth Date:  
				</td>
				<td>
					<?php echo date("d-m-Y", strtotime($record['date']));?>
				</td>
			</tr>
			<tr>
				<td>
					Height:   
				</td>
				<td>
					<?php echo $record['height']."cm"  ?>
				</td>
			</tr>
			<tr>
				<td>
					Phone Number:   
				</td>
				<td>
					<?php echo $record['phone']  ?>
				</td>
			</tr>
			<tr>
				<td>
					Favorite Color:    
				</td>
				<td bgcolor="<?php echo $record['color'] ?>">

				</td>
			</tr>
			<tr>
				<td>
					FB: 
				</td>
				<td>
					<?php echo $record['fbtwig'] ?>
				</td>
			</tr>
			<tr>
				<td>
					My University: 
				</td>
				<td>
					<select name="univ"  >
						<?php
						   	echo '<option selected>'.$record['univ'].'</option>'
						?>
					</select>
				</td>
			</tr>
		</table>
		<hr>
		<br>
		</form>
</body>
</html>
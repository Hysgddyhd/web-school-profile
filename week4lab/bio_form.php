<?php  
$univ = array(
	array("name" => "Universiti Putra Malaysia","abb"=>"UPM"),
	array("name" => "Universiti Kebangsaan Malaysia","abb"=>"UKM"),
	array("name" => "Universiti Malaysia","abb"=>"UM"),
	array("name" => "Universiti Sains Malaysia","abb"=>"USM"),
	array("name" => "Universiti Teknologi Malaysia","abb"=>"UTM"),
	);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>week4 Bio from</title>
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
					<input   type="text" name="name" maxlength="10" placeholder="type your name"  >
				</td>
			</tr>
			<tr>
				<td>
					age: 
				</td>
				<td>
					<input type="number.html" name="age" min="1" max="60"  >
				</td>
			</tr>
			<tr>
				<td>
					gender: 
				</td>
				<td>
					<input type="radio"
					name="sex" value="male" checked>Male<input type="radio" name="sex" value="female"  >Female
				</td>
			</tr>
			<tr>
				<td>
					address: 
				</td>
				<td>
					<textarea name="address" cols="40" rows="3" maxlength="100" placeholder="type your address"  ></textarea>
				</td>
			</tr>
			<tr>
				<td>
					Email:  
				</td>
				<td>
					<input type="text" name="email" maxlength="30" placeholder="type your email"  >
				</td>
			</tr>
			<tr>
				<td>
					Birth Date:  
				</td>
				<td>
					<input type="date" name="dob"  
					>
				</td>
			</tr>
			<tr>
				<td>
					Height:   
				</td>
				<td>
					<input type="range" name="height" id="heightId" min = "100" max = "200" value = "160" oninput="outputId.value = heightId.value"><output id="outputId">160</output>cm
				</td>
			</tr>
			<tr>
				<td>
					Phone Number:   
				</td>
				<td>
					<input type="tel" name="phone" pattern="[0-9]{2}-[0-9]{7}" placeholder="12-3456789" 
					  >
				</td>
			</tr>
			<tr>
				<td>
					Favorite Color:    
				</td>
				<td>
					<input type="color" name="color"  >
				</td>
			</tr>
			<tr>
				<td>
					FB: 
				</td>
				<td>
					<input type="url" name="fbtwig"  >
				</td>
			</tr>
			<tr>
				<td>
					My University: 
				</td>
				<td>
					<select name="univ"  >
						<option value="" selected>Select</option>
						<?php
						foreach ($univ as $u => $value) {
							echo "<option>".$value["abb"]."</option>";
							// code...
						}
						?>
					</select>
				</td>
			</tr>
		</table>
		<hr>
		<input type="hidden" name="matricnum" value="a197547">
		<input type="submit" name="bio_form" value="Submit My Biodata">
		<input type="reset" value="Reset all">
		<br>
		<button ><a href="menu.html" target="_parent">menu</a></button>
	</form>
</body>
</html>
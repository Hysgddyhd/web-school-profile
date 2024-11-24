<?php  
if(isset($_POST['bio_form'])) {
	$name = "";
	$age = "";
	$sex="";
	$address = "";
	$email = "";
	$dob = "";
	$height = "";
	$phone = "";
	$color = "";
	$fbtwig = "";
	$univ = "";
	$matricnum = "a197547";
	$count_error = 0;
	$msg = "";

//validate form variable
	 if (isset($_POST['name']) && ($_POST['name'] != ""))
    $name = $_POST['name'];
  else
  {
    $msg .= "Error: Please insert a name.<br>";
    $count_error++;
  }
  if (isset($_POST['age']) && ($_POST['age'] != ""))
    $age = $_POST['age'];
  else
  {
    $msg .= "Error: Please insert an age.<br>";
    $count_error++;
  }
  if (isset($_POST['sex']) && ($_POST['sex'] != ""))
    $sex = $_POST['sex'];
  else
  {
    $msg .= "Error: Please insert your gender.<br>";
    $count_error++;
  }
  if (isset($_POST['address']) && ($_POST['address'] != ""))
    $address = $_POST['address'];
  else
  {
    $msg .= "Error: Please insert a address.<br>";
    $count_error++;
  }
  if (isset($_POST['email']) && ($_POST['email'] != ""))
    $email = $_POST['email'];
  else
  {
    $msg .= "Error: Please insert a email.<br>";
    $count_error++;
  }
  if (isset($_POST['dob']) && ($_POST['dob'] != ""))
    $dob = $_POST['dob'];
  else
  {
    $msg .= "Error: Please insert a dob.<br>";
    $count_error++;
  }
  if (isset($_POST['height']) && ($_POST['height'] != ""))
    $height = $_POST['height'];
  else
  {
    $msg .= "Error: Please insert a height.<br>";
    $count_error++;
  }
  if (isset($_POST['phone']) && ($_POST['phone'] != ""))
    $phone = $_POST['phone'];
  else
  {
    $msg .= "Error: Please insert a phone.<br>";
    $count_error++;
  }
  if (isset($_POST['color']) && ($_POST['color'] != ""))
    $color = $_POST['color'];
  else
  {
    $msg .= "Error: Please insert a color.<br>";
    $count_error++;
  }
  if (isset($_POST['fbtwig']) && ($_POST['fbtwig'] != ""))
    $fbtwig = $_POST['fbtwig'];
  else
  {
    $msg .= "Error: Please insert a fbtwig.<br>";
    $count_error++;
  }
  if (isset($_POST['univ']) && ($_POST['univ'] != ""))
    $univ = $_POST['univ'];
  else
  {
    $msg .= "Error: Please insert a univ.<br>";
    $count_error++;
  }
  if (isset($_POST['age']) && ($_POST['age'] != ""))
    $age = $_POST['age'];
  else
  {
    $msg .= "Error: Please insert an age.<br>";
    $count_error++;
  }
	$vars = array("name","age","sex","address","email","dob","height","phone","color","fbtwig","univ","matricnum");
	foreach ($vars as $key => $value) {
		// code...
		if(!isset($_POST[$value]) || $_POST[$value]==""){
			echo "Please insert $value"."<br>";
			$count_error += 1;
		}			
	}
	if($count_error>0){
		echo $msg."<br>";
		echo "$count_error error(s) detected"."<br>";
		die();
	}
}
	else{	
  	echo "Error: You have execute a wrong PHP. Please contact the web administrator.";
 	 die();
 	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Validate Biodata</title>
</head>
<body>
  <h2>Validate Form</h2>
  <hr>
<form action="save_biodata.php" method="post">
  <table width="100%" border="1" cellpadding="10">
  <tr bgcolor="LightGray">
	 <td>name</td>
	 <td>age</td>
	 <td>sex</td>
	 <td>address</td>
	 <td>email</td>
	 <td>dob</td>
	 <td>height</td>
	 <td>phone</td>
	 <td>color</td>
	 <td>social media</td>
	 <td>university</td>
	 <td>matrix number</td>
  </tr>	
  <tr>
  <td><input type="hidden" name="name" value="<?php echo $name; ?>"><?php echo ucfirst($name) ?></td>
  <td><input type="hidden" name="age" value="<?php echo $age; ?>"><?php echo $age ?></td>
  <td><input type="hidden" name="sex" value="<?php echo $sex; ?>"><?php echo $sex ?></td>
  <td><input type="hidden" name="address" value="<?php echo $address; ?>"><?php echo $address ?></td>
  <td><input type="hidden" name="email" value="<?php echo $email; ?>"><?php echo $email ?></td>
  <td><input type="hidden" name="dob" value="<?php echo $dob; ?>"><?php echo date("d-m-Y", strtotime($dob));?></td>
  <td><input type="hidden" name="height" value="<?php echo $height; ?>"><?php echo $height ?>cm</td>
  <td><input type="hidden" name="phone" value="<?php echo $phone; ?>"><?php echo $phone ?></td>
  <td bgcolor="<?php echo $color ?> "><input type="hidden" name="color" value="<?php echo $color; ?>"></td>
  <td><input type="hidden" name="fbtwig" value="<?php echo $fbtwig; ?>"><?php echo $fbtwig ?></td>
  <td><input type="hidden" name="univ" value="<?php echo $univ; ?>"><?php echo $univ ?></td>
  <td><input type="hidden" name="matricnum" value="<?php echo $matricnum; ?>"><?php echo $matricnum ?></td>
</tr>
</table>
<input type="submit" name="validate_biodata" value="Done" >
</form>
</body>
</html>
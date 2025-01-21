<?php
	session_start();
	var_dump($_SESSION);
	include_once "account_crud.php"; 
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Staff login</title>
	    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onload="checkUser()" >

	<?php
	if (isset($editRow)&&is_countable($editRow)){
		print_r($editRow);
		$_SESSION['sid']=$editRow["fld_staff_num"];
		$_SESSION['level']=$editRow["fld_staff_level"];
		$_SESSION['name']=$editRow["fld_staff_fname"]." ".$editRow["fld_staff_lname"];
		var_dump($_SESSION);
		echo "Session variables are set.";

	}else{
		echo "invaild user";
	}
		

	 ?>
	<div class="container" >
		<div class="row">
		  <div class="justify-content-center">
		    <div class="col-sm-10">
		      <h3>Login</h3>
		    </div>
		  </div>
		</div>
		<br>
		<div class="form-group">
			<form action="account.php" method="post">
				<div class="row">
					<div>
						<label for="staffEmail">Email</label>
				</div>
					<div>
						<input class="form-control" id="staffEmail" type="text"  name="email" placeholder="Enter email">
					</div>
				</div><br>
				
				<div class="row">
					<div>
						<label for="staffPass">Password</label>
					</div>
					<div>
						<input class="form-control" type="password" name="password" id="staffPass" placeholder="Enter passowrd">
					</div>

				</div><br>
				<div class="row">
					<div class="col-sm-9 col-md-8 col-sm-offset-3 col-md-offset-4">
						<input class="btn btn-success" type="submit" name="login" value="Login">
						<input class="btn btn-warning" type="reset" name="Reset">
					</div>
					
				</div>
				
			</form>
			<button onclick="checkUser();">test</button>

		</div>
	</div>

</body>
<script type="text/javascript">
	const level="<?php echo $_SESSION["level"]; ?>";
	const name="<?php echo $_SESSION["name"]; ?>"
	function checkUser() {
		
	//	window.alert(level);
		if (level=="admin") {
			window.alert("welcome Admin "+name);
			// Simulate a mouse click:
			document.write("");
			window.location.href = "index.php";

		}else if (level=="normal") {
			window.alert("welcome normal staff "+name);
			document.write("");
			window.location.href = "index.php";
		}else {
			if (level!=""&name!="")
			window.alert(name+ " "+level);
		}
	}
</script>
</html>
<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
foreach ($_SESSION as $key => $value){
	if (isset($_SESSION[$key]))
		echo $key." unset"."<br>";
}
session_unset(); 

// destroy the session 
session_destroy(); 
?>

Sessions are deleted.

</body>
</html>
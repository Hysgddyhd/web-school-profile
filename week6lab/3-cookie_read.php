<?php
	date_default_timezone_set("CET");
	if (count($_COOKIE) > 1) {
		//var_dump($_COOKIE);
		//echo "<br>";
		echo "Welcome ".$_COOKIE['username']." at ".date('d/m H:i',$time);
		echo "<br>";
		echo "Send to me ";
		echo "<a href=".$_COOKIE['email'].">";
		echo "Email";
		echo "</a>";
		echo "<br>";
		echo "Security level: ".$_COOKIE['security'];
	} else {
		echo "Cookie has not been set yet";
		die();
	}
?>
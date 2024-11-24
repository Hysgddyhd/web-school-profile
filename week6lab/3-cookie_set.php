<?php  
	if (count($_COOKIE)<=1 ){
		echo "No cookie in local or cookie is disabled"."<br>";
	} elseif (!isset($_COOKIE['username'])) {
		setcookie("username","typer",time()+(10*60));//10 minutes
		echo "set username in cookie"."<br>";
	} else {
		echo "no change made to cookie";
		die();
	}
	setcookie("username","typer",time()+(10*60));//10 minutes
	setcookie("email","a197547@siswa.ukm.edu.my",time()+(24*60*60));//1 day
	setcookie("serurity","admin",time()+(24*60*60));//1 day
	echo "cookie has been set";
?>
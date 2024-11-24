<?php  
	if(count($_COOKIE) == 1){
		echo "No cookie is set";
		die();
	}
	foreach ($_COOKIE as $key => $value) {
		setcookie($key,"",time()-1);
	}
	echo "All Cookie have been deleted";
?>
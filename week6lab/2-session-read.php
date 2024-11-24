<?php  
	session_start();

	echo 'Welcome: '.$_SESSION['name'].'<br>';
	echo 'Session start time: '.$_SESSION['starttime'].'<br>';
	echo "Security level: ".$_SESSION['security'];
?>
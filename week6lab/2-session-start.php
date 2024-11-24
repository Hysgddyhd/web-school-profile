<?php
	session_start();
	date_default_timezone_set("Asia/Macau");
	echo "Start Session";
	$_SESSION['name'] = "typer";
	$_SESSION['starttime'] = date('D/M-H:i',$time);
	$_SESSION['security'] = "normal";
?>
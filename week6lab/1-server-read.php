<?php  
	date_default_timezone_set("Asia/macau");
	$time= $_SERVER['REQUEST_TIME'];//Onix Time Format
	print date('d/m/y H:i', $time); // 2010-09-26 04:25:49
?>
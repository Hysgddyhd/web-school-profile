<?php  
	$array = array("a","b",'c');
	print 'count: '.count($array);
	echo '<br>','var_dump(array): ';
	var_dump($array);
	echo '<br>','var_dump(array[2]): ';
	var_dump($array[2]);
	echo '<br>','items in array: <br>';
	foreach ($array as $i => $value) {
		// code
		echo $array[$i],'<br>';
	}
	$history = array();
	foreach(file("history.txt") as $line) {
    // do stuff here
		array_push($history,$line);
		//echo $line;
}
	$size = sizeof($history);
	foreach($history as $i =>$value){
		echo $history[$size - $i -1].'<br>';
	}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>
<body>
  <form action="5-filter.php" method="get">
    <p>Enter IP address or Email or URL:</p>
    <input type="text" name="input">
    <br>
    <input type="submit" name="submit"> 
  </form>
</body>
</html>
<?php
  if(isset($_GET['input'])){
    $input = $_GET['input'];
  } else {
    die();
  }
if (!filter_var($input, FILTER_VALIDATE_IP) === false) {
  echo("$input is a valid IP address");
} elseif (!filter_var($input, FILTER_VALIDATE_EMAIL) === false){
  echo("$input is a valid Email address");
} elseif (!filter_var($input, FILTER_VALIDATE_URL) === false) {
  echo("$input is a valid URL address");
} else {
  echo $input." is nether a vaild IP address nor a vaild Email address nor a vaild URL address.";
}


?>
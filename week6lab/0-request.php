<!DOCTYPE html>
<html>
<head>
    <title>$_request</title>
</head>
<body>

<form method="post" action="0-request.php?id=a123456">
    <label for="n">Name : </label>
    <input type="text" name="fname" id="n">
    <input type="submit" name="ok" value="Submit">
</form><br>

<?php
if (isset($_POST['ok'])) {
    $name = $_REQUEST['fname'];
    $id = $_REQUEST['id'];
    
    echo "Name :" . $name . "<br>";
    echo "ID :" . $id . "<br>";
}
?>
</body>
</html>
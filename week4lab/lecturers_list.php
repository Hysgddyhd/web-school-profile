<?php
 
$lecturers = array
  (
  array('id' => "K004901", 'name' => "Prof. Dr. Abdullah Mohd Zin"),
  array('id' => "K012964", 'name' => "Prof. Dr. Azuraliza Abu Bakar"),
  array('id' => "K009683", 'name' => "Assoc. Prof. Dr. Haslina Arshad"),
  array('id' => "K007915", 'name' => "Assoc. Prof. Dr. Mohd Juzaiddin Ab Aziz"),
  );
 
?>
<!DOCTYPE html>
<html>
<head>
  <title>week4 lecturers list</title>
</head>
<body>
  <p style="text-align:left;"><--
    <br><a href="index.html" target="_parent">return</a></p>
    <hr>
<h1>List of Lecturers</h1>
<table border="1" cellpadding="10">
<?php
$keys = array_keys($lecturers);
while(!empty($keys)){
  $key = array_pop($keys);
  ?>
  <tr>
    <td><?php echo $lecturers[$key]['name']; ?></td>
    <td><a href="lecturer_details.php?id=<?php echo $lecturers[$key]['id']; ?>">Details</a></td>
  </tr>
<?php } ?>
</table>
</body>
</html>
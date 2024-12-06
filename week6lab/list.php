<?php
 
include "db.php";
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    $stmt = $conn->prepare("SELECT * FROM myguestbook ORDER BY id DESC");
    $stmt->execute();
 
    $result = $stmt->fetchAll();
 
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
 
$conn = null;
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Guestbook</title>
</head>
<body>
    
 <p style="font-size:24dp;">
    <-   <a href="index.php"> Main Menu</a>
  </p>
  <hr>
<ol>
<?php
foreach($result as $row) {
  echo "<li>";
  echo "Name : ".$row["user"]."<br>";
  echo "Email : ".$row["email"]."<br>";
  echo "Date : ".$row["postdate"]."<br>";
  echo "Time : ".$row["posttime"]."<br>";
  echo "Comments : ".$row["comment"]."<br>";
  //image upload
  if ($row["picture"] == "") {
  echo '<form action="upload.php" method="post" enctype="multipart/form-data">';
  echo "<input type='file' name='fileToUpload' id='fileToUpload' required>";
  echo "<input type='submit' value='Upload Image' name='submit'>";
  echo '<input type="hidden" name="id" value="'.$row['id'].'">';
  echo "</form>";
  }
  if ($row["picture"] != "") {
    echo "<table>";
    echo "<tr>";
    echo "<td>".'<img src="picture\\'.$row["picture"].'" width="150"><br>'."</td>";
    echo "<td>".'<button><a href="delete_img.php?id='.$row['id'].'">remove</a></button>'."</td>";
    echo "</tr></table>";
  }

  echo '<input type="hidden" name="id" value='.$row["id"].'>';
  echo "Action : <a href=edit.php?id=".$row["id"].">Edit</a> / <a href=delete.php?id=".$row["id"].">Delete</a>";
  echo "</li>";
  echo "<hr>";
}
?>
</ol>
</body>
</html>
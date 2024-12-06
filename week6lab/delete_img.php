
<?php
 
if (isset($_GET['id'])) {
  //echo "right";
 
  include "db.php";
 
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
      $stmt = $conn->prepare("UPDATE myguestbook SET picture=:picture WHERE id = :record_id");
      
      $stmt->bindParam(':record_id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':picture',$a, PDO::PARAM_STR);
      $id = $_GET['id'];
      $a = "";
      $stmt->execute();
 
      header("Location:list.php");
      }
 
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
 
  }
else {
  echo "Error: You have execute a wrong PHP. Please contact the web administrator.";
  die();
}
 
?>
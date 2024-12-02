<?php 
session_start();
  echo '<p style="font-size:24dp;">    <-   <a href="index.php"> Main Menu</a></p>';
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
   // echo "from post<br>";
  
  if (!isset($_POST['add_form'])) {
      echo "Error: You have execute a wrong PHP. Please contact the web administrator.";
      die();
  }

 
  include "db.php";
  //set session to cache input data
 
  $_SESSION['name'] = $_POST['name'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['comment'] = $_POST['comment'];
  // Give value to the variables
     // $name = $_POST['name'];
      $postdate = date("Y-m-d",time());
      $posttime = date("H:i:s",time());
      $comment = $_POST['comment'];

      //apply filter to name , email , comment
      $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
      if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) === false){
        echo "Invaild email address<br><br>";
        echo '<a href="new_form.php" target="_self">retry</a>';
        die();

      } else {
        $email = $_POST['email'];
      }
      
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
      // Prepare the SQL statement
      $stmt = $conn->prepare("INSERT INTO myguestbook(user, email, postdate, posttime,
        comment) VALUES (:user, :email, :pdate, :ptime, :comment)");
     
      // Bind the parameters
      $stmt->bindParam(':user', $name, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':pdate', $postdate, PDO::PARAM_STR);
      $stmt->bindParam(':ptime', $posttime, PDO::PARAM_STR);
      $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
       
     
      $stmt->execute();
 
      echo "New records created successfully";
      echo "<br><br>";
      echo '<a href="new_form.php" target="_self">Comment again</a>';
      //delete session 
      session_unset();
      die();
      }
 
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
 
    $conn = null;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Guestbook</title>
</head>
 
<body>
 
<form style="text-align:left ;" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  Nama :
  <input type="text" name="name" size="40" value = "<?php 
  if (isset($_SESSION['name'])){
   echo $_SESSION['name']; 
 } 
  ?>" required>
  <br>
  Email :
  <input type="text" name="email" size="25" value="<?php 
    if (isset($_SESSION['email'])){
      echo $_SESSION['email']; 
    }
  ?>" required>
  <br>
  Comments :<br>
  <textarea name="comment" cols="30" rows="8" required><?php  
      if (isset($_SESSION['comment'])){
        echo $_SESSION['comment']; 
      }
    ?></textarea>
  <br>
  <input type="submit" name="add_form" value="Add a New Comment">
  <input type="reset">
  <br>
</form>
 
</body>
</html>
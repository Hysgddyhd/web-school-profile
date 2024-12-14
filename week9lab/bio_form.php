<?php
 
$univ = array
  (
  array("name"=>"Universiti Putra Malaysia","abb"=>"UPM"),
  array("name"=>"Universiti Kebangsaan Malaysia","abb"=>"UKM"),
  array("name"=>"Universiti Malaya","abb"=>"UM"),
  array("name"=>"Universiti Sains Malaysia","abb"=>"USM"),
  array("name"=>"Universiti Teknologi Malaysia","abb"=>"UTM")
  );
 
 ?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Biodata</title>
 <style type="text/css">
 
    input {
        width: 100%;
        padding: 6px 10px;
        margin: 10px 0px 24px 0px;
        box-sizing: border-box;
        font: 100% Lucida Sans, Verdana;
        text-align: center;
    }
    body {
        font: 100% Lucida Sans, Verdana;
    }
    label {
      font-weight: bold;
    }
    h1, h2, h3 {
    color: #137cf7;
}
      #btn1,#btn2 {
      background-color: #137cf7;
      border: 0px;
      color: #ffffff;
      padding: 16px,32px;
      margin: 4px,2px;
      cursor: pointer;
      width: 20%;
      height: 40px;
        padding: 6px 10px;
        margin: 30px 10% 0px 15%;
    }
</style>
</head>
<body>
<h1>Biodata Form</h1>
<hr>
<form action="validate_biodata.php" method="post">
     
<label for="idname">Name:</label>
<input type="text" name="name" id="idname" placeholder="Insert your name" autofocus><br>
     
<label for="idage">Age:</label>
<input type="number" name="age" id="idage" min="0" max="100" step="1"><br>
     
<label for="idsex">Sex:</label><br>
<input type="radio" name="sex" id="idsex" value="male" style="width: 80px;">Male<br>
<input type="radio" name="sex" id="idsex" value="female" style="width: 80px;">Female<br>
       
<label for="idaddress">Address:</label>
<textarea name="address" id="idaddress" cols="50" rows="5" placeholder="Insert your address" style="width: 100%;"></textarea><br>
     
<label for="idemail">Email:</label>
<input type="email" id="idemail" name="email" placeholder="Insert your email"><br>
     
<label for="iddob">Date of Birth:</label>
<input type="date" id="iddob" name="dob"><br>
     
<label for="idheight">Height:</label><br>
<input type="range" name="height" id="heightId" min = "100" max = "200" style="width: 300px;" oninput="outputId.value = heightId.value">
<output id="outputId">150</output>cm<br>
     
<label for="idtel">Tel:</label>
<input type="tel" name="phone" id="idtel" pattern="\+60\d{2}-\d{7}" placeholder="+60##-#######"><br>
     
<label for="idcolor">My Favorite Color:</label><br>
<input type="color" name="color" id="idcolor" style="width: 50px;padding: 4px;"><br>
     
<label for="idfbtwig">Fb/TW/IG:</label>
<input type="url" name="fbtwig" id="idfbtwig" placeholder="Insert the URL"><br>
     
<label for="iduniv"></label>My University:
<select name="university" id="iduniv" style="width: 100%;">
  <option value="" selected>Select</option>
  <?php
  foreach ($univ as $u) {
    echo "<option value=".$u['abb'].">".$u['name']."</option>";
  }
  ?>
</select><br>
 
<input type="hidden" name="matricnum" value="a123456">
<input type="submit" name="biodata_form" value="Submit My Biodata" id="btn1">
<input type="reset" id="btn2">
</form>
 
</body>
</html>
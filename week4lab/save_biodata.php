<?php  
if(isset($_POST['validate_biodata'])){
	//set variable
	 $name = $_POST['name'];
  $age = $_POST['age'];
  $sex = $_POST['sex'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $height = $_POST['height'];
  $phone = $_POST['phone'];
  $color = $_POST['color'];
  $fbtwig = $_POST['fbtwig'];
  $univ = $_POST['univ'];
  $matricnum = $_POST['matricnum'];
  //insert data into sql
 // echo "done copy data";
  $sql = "insert into biodata
  (name,age,sex,address,email,dob,height,phone,color,fbtwig,univ,matricnum) values
  ('$name',$age,'$sex','$address','$email','$dob','$height','$color','$fbtwig','$univ','$matricnum')
 ";	
 	echo $sql;

}else{
    echo "wrong source";
}
?>
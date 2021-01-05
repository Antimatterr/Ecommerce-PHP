<?php 
require('./connection.inc.php');
require('./functions.inc.php');

$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$check_sql = "SELECT * FROM users WHERE email='$email'";
$check_res = mysqli_query($con,$check_sql);
$check_user = mysqli_num_rows($check_res);
if($check_user>0){
  echo "email already exists";
}
else{
  $added_on = date('y-m-d h:i:s');
  mysqli_query($con, "INSERT INTO users(name, email, password, mobile, added_on) VALUES('$name', '$email', '$password', '$mobile', '$added_on')");
}

?>  
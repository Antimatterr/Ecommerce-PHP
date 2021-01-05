<?php 
require('./connection.inc.php');
require('./functions.inc.php');
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$check_sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$check_res = mysqli_query($con, $check_sql);
$check_user = mysqli_num_rows($check_res);
if($check_user>0){
  $row = mysqli_fetch_assoc($check_res);
  $_SESSION['USER_LOGIN'] = 'yes';
  $_SESSION['USER_ID'] = $row['id'];
  $_SESSION['USER_NAME'] = $row['name'];
  echo "successfully logged in!";
 
}
else{
  echo "Either the email or password is incorrect";
}

?>  
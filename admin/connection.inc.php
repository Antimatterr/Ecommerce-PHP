<?php
session_start();
$con = mysqli_connect(
  $host = "localhost", 
  $user = "root", 
  $password = "", 
  $database = "ecom",
  $port =3306 );

  if(!$con){
    echo "erroor ";
  }
  else{
    echo "connected";
  }

?>
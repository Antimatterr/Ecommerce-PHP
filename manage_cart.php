<?php 
require('./connection.inc.php');
if(isset($_SESSION['USER_ID'])){
  if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($con,$_GET['id']);
    $product_id = mysqli_real_escape_string($con, $_GET['product_id']);
    $delete_cart = "DELETE FROM cart WHERE id = $id";
    mysqli_query($con,$delete_cart);
    header('location:cart.php');
  }
}
?>
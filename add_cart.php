<?php
require('./connection.inc.php');
require('./functions.inc.php');

$product_id = mysqli_real_escape_string($con, $_GET['id']);
$user_id = mysqli_real_escape_string($con, $_SESSION['USER_ID']); 
$qty = mysqli_real_escape_string($con, $_POST['qty']);
$cart_sql = "INSERT INTO cart(product_id, user_id, qty) VALUES('$product_id', '$user_id', '$qty')";
$total_sql = "INSERT INTO total(user_id) VALUES('$user_id')";

$product_update = "UPDATE product SET qty=qty-(SELECT qty FROM cart WHERE product_id='$product_id') WHERE id = '$product_id'";
$product_price = "UPDATE cart SET total_price = qty*(SELECT price FROM product where id = '$product_id') WHERE product_id = '$product_id'";
mysqli_query($con, $cart_sql);
mysqli_query($con, $total_sql);
mysqli_query($con,$product_update);
mysqli_query($con, $product_price);
header('location:index.php');

?>
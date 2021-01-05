<?php 
require('./connection.inc.php');
require('./functions.inc.php');

if(isset($_POST['add_order'])){
  $address = mysqli_real_escape_string($con,$_POST['address']);
  $city = mysqli_real_escape_string($con, $_POST['city']);
  $pin = mysqli_real_escape_string($con, $_POST['pin']);
  $user_id = $_SESSION['USER_ID'];
  $total_price_sql = "SELECT  total_price from cart WHERE user_id = '$user_id'";
  
  $price_res = mysqli_query($con, $total_price_sql);
  $total_price = 0;
  while($row=mysqli_fetch_assoc($price_res)){
    $total_price = $total_price+$row['total_price'];
  }
  $order_status = "0";
  $payment_status = "0";
  $added_on = date('y-m-d h:i:s');

//TODO adding product details

  $orders_sql = "INSERT INTO orders(user_id, address, city, pincode, total_price, order_status, payment_status, added_on) VALUES('$user_id','$address', '$city', '$pin', '$total_price', '$order_status', '$payment_status', '$added_on')";
  mysqli_query($con, $orders_sql);

  $order_id = mysqli_insert_id($con);

  $cart_data_sql = "SELECT * FROM cart WHERE user_id='$user_id'";
  $cart_res = mysqli_query($con, $cart_data_sql);

  //ADDING DETAILS OF PRODUCT IN ORDER

  while($row=mysqli_fetch_assoc($cart_res)){
    $product_id = $row['product_id'];
    $qty= $row['qty'];
    $price= $row['total_price'];
    $order_date = date('y-m-d h:i:s');
     mysqli_query($con, "INSERT INTO order_detail(order_id, product_id, qty, price, added_on) VALUES('$order_id', '$product_id', '$qty', '$price', '$order_date')");
  }
  header('location:thankyou.php');


}
?>
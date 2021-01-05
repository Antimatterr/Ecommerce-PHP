<?php
require('./connection.inc.php');
require('./top.php');

if(isset($_SESSION['USER_LOGIN'])){
?>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">

	
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
              
              <td class="total">Order ID</td>
              <td class="total">Order Date</td>
              <td class="total">Address</td>
              <td class="total">Total Amount</td>
              <td class="total">Order status</td>
              <td class="total">Payment status</td>
              <td class="total">Cancel Order</td>
							<td></td>
						</tr>
					</thead>
				
					<tbody>
            <?php 
            $uid = $_SESSION['USER_ID'];
            $order_sql = "SELECT * FROM orders  WHERE user_id = '$uid'";
            $res = mysqli_query($con, $order_sql);
            while($row = mysqli_fetch_assoc($res)){

					?>
						<tr>
							<td class="cart_description">
                <a style="font-size: 20px; padding:10px; " href="my_order_details.php?id=<?php echo $row['id'] ?>">click here to view</a>
            </td>
							<td class="cart_description">
								<h4><?php echo $row['added_on'] ?></h4>
							</td>
							<td class="cart_description">
								<p><?php echo $row['address'] ?></p>
							</td>
							<td class="cart_description">
							  <p><?php echo $row['total_price'] ?></p>
							</td>
							<td class="cart_description">
								<p class="cart_total_price"><?php echo $row['order_status'] ?></p>
							</td>
							<td class="cart_descrption">
								<p><?php echo $row['payment_status'] ?></p>
              </td>
              <td class="cart_delete">
								<a class="cart_quantity_delete" href="delete_order.php?action=delete&id=<?php echo $row['id'] ?>"> 
								<i class="fa fa-times"></i></a>
							</td>
            </tr>
            <?php }?>

					</tbody>
					
				</table>
			
			</div>
		</div>
	</section> <!--/#cart_items-->
<?php } else {  ?>
  <h3>Register and LOgin to Continue shoping.</h3>

  <?php } ?>

<?php require('./footer.php') ?>
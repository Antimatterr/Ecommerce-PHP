<?php
require('./connection.inc.php');
require('./top.php');
if(isset($_SESSION['USER_ID'])){
$user_id_n = $_SESSION['USER_ID'];
$cart_items = "SELECT p.name, p.image, p.price,c.id, c.qty, c.total_price FROM product AS p, cart AS c WHERE p.id=c.product_id AND c.user_id='$user_id_n'";
$cart_res = mysqli_query($con, $cart_items);

$cart_total = 0;

}

 
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
							<td class="image">Item</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td class="total">Delete</td>
							<td></td>
						</tr>
					</thead>
							<?php
					if(isset($_SESSION['USER_ID'])){
					while($row=mysqli_fetch_assoc($cart_res)){
						$cart_total = $cart_total+$row['total_price'];

					?>
					<tbody>
					
						<tr>
							<td class="cart_product">
								<a href=""><img style="height:110px; width:110px;" src="./media/product/<?php echo $row['image'] ?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo  $row['name'] ?></a></h4>
							</td>
							<td class="cart_price">
								<p>₹<?php echo $row['price'] ?></p>
							</td>
							<td class="cart_quantity">
							  <p><?php echo $row['qty'] ?></p>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">₹<?php echo $row['total_price'] ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="manage_cart.php?action=delete&id=<?php echo $row['id'] ?>"> 
								<i class="fa fa-times"></i></a>
							</td>
						</tr>

					</tbody>
					<?php } } else {
					?>

					<h3 style="color: orange;">Please Register and Login to Continue shopping.</h3>

					<?php } ?>
				</table>
			
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
			</div>
			<div class="row">
		<?php 
		if(isset($_SESSION['USER_LOGIN'])){ 
		if($cart_total>0) { ?>
			 <div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>₹<?php echo $cart_total ?></span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>₹<?php echo $cart_total ?></span></li>
						</ul>
							<a class="btn btn-default check_out" href="checkout.php">Check Out</a>
					</div>
				</div>
				<?php } else { ?>
				<h3 style="color: orange;">Your Cart is Empty!</h3>
				<?php } } ?>
			</div>
		</div> 
	</section>

  <?php
  require('./footer.php')
  
  ?>
<?php
require('./connection.inc.php');
require('./top.php');
require('./functions.inc.php');
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
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						
					</div>
					<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">

			

				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
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
								<a href="index.php"><img style="height:110px; width:110px;" src="./media/product/<?php echo $row['image'] ?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><?php echo  $row['name']; echo $row['id'] ?></h4>
								<p>Web ID: 1089772</p>
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
								<a class="cart_quantity_delete" href="manage_cart.php?action=delete&id=<?php echo $row['id'] ?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>

			
						
					
					</tbody>
					<?php } } 
					?>
				</table>

				
			</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Postal Address</p>
							<div class="form-one">
							
								<form action="add_order.php ?>" method="post">
									<input type="text" name="address" placeholder="Address  *" required>
									<input type="text" name="city" placeholder="city *" required>
									<input type="text" name="pin" placeholder="Zip / Postal Code *" required>
									<input type="submit" name="add_order" style="background-color: orange; color:white" placeholder="Submit">
								</form>
							</div>
								
						</div>
					</div>
								
				</div>
			</div>
		
			
		</div>
	</section> <!--/#cart_items-->

  <?php
  require('./footer.php')
  
  ?>
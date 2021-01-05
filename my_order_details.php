<?php
require('./connection.inc.php');
require('./top.php');
$order_id = mysqli_real_escape_string($con, $_GET['id']);

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
              
              <td class="image">Item</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td class="total">Date Added</td>
						</tr>
					</thead>
				
					<tbody>
            <?php 
            $uid = $_SESSION['USER_ID'];
            $order_detail_sql = "SELECT order_detail.*, product.name, product.image FROM order_detail, product, `orders` WHERE order_detail.order_id = '$order_id' AND `orders`.user_id = '$uid' AND product.id = order_detail.product_id";
            $res = mysqli_query($con, $order_detail_sql);
            while($row = mysqli_fetch_assoc($res)){

					?>
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
								<p class="cart_total_price">₹<?php echo $row['price'] ?></p>
              </td>
              <td class="cart_total">
								<p class="cart_total_price"><?php echo $row['added_on'] ?></p>
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
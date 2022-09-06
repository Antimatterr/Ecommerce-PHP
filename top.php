<?php
if(isset($_SESSION['USER_LOGIN'])){
$user_id = $_SESSION['USER_ID'];
$sql = "SELECT product_count FROM cart_detail WHERE user_id = '$user_id'";
$sql_res = mysqli_query($con, $sql);
$r = mysqli_fetch_assoc($sql_res);
$d = $r['product_count'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
		<script>
			function send_message(){
				var name= jQuery('#name').val();
				var email= jQuery('#email').val();
				var mobile= jQuery('#mobile').val();
				var message= jQuery('#message').val();
				var is_error = "";
				if(name == ""){
					alert("Please Enter your name")
				}
				else if(email == ""){
					alert("Please enter your email");
				}
				else if(mobile == ""){
					alert("please enter your mobile");
				}
				else if(message == ""){
					alert("message field is empty");
				}
				else{
					jQuery.ajax({
						url: 'send_message.php',
						type: 'post',
						data: 'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
						success: function(result) {
							alert(result);
							reload();
						}
					});
				}
			}

			function user_register(){
				var name= jQuery('#name').val();
				var email= jQuery('#email').val();
				var mobile= jQuery('#mobile').val();
				var password= jQuery('#password').val();
				var is_error = "";
				if(name == ""){
					alert("Please Enter your name")
				}
				else if(email == ""){
					alert("Email field is empty");
				}
				else if(mobile == ""){
					alert("Mobile field is empty");
				}
				else if(password == ""){
					alert("Password field is empty");
				}
				else{
					jQuery.ajax({
						url: 'register_submit.php',
						type: 'post',
						data: 'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
						success: function(result) {
							alert("You have been registered");
							reload();
						}
					});
				}
			}

			function user_login(){
				var email= jQuery('#login_email').val();
				var password= jQuery('#login_password').val();
				var is_error = "";
				if(email == ""){
					alert("Please Enter your email")
				}
				else if(password == ""){
					alert("Password field is empty");
				}
				else{
					jQuery.ajax({
						url: 'login_submit.php',
						type: 'post',
						data: 'email='+email+'&password='+password,
						success: function(result) {
						 alert(result);
						}
					});
				}
			}

		


		</script>
</head><!--/head-->

<body>
  <header id="header"><!--header-->
  
	
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
            </div>
            
							
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<!-- <li><a href="account.php"><i class="fa fa-user"></i> Account</a></li> -->
								<!-- <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li> -->
								<?php if(isset($_SESSION['USER_LOGIN'])){ ?>
								<li><a href="my_order.php"><i class="fa fa-crosshairs"></i>My orders</a></li>
								
									<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart <span class="qua" style="background-color: orange; padding:6px; color:white; border-radius:1000px;"><?php echo $d ?></span></a></li>
								
								
								 <li><a href='logout.php'><i class='fa fa-lock'></i>Logout</a></li>
								 <?php 
								}
								else{
									echo "<li><a href='login.php'><i class='fa fa-lock'></i> Login/Register</a></li>";
								} 
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php" class="active">Home</a></li>
								<li><a href="contact.php">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class=" pull-right">

						<form action="search.php" method="get">
              <input  style="border: none; background-color:white; padding:6px;" type="text" name="query" placeholder="Search"/>
							<button type="submit" class="btn"><i class="fa fa-search"></i></button>
            </form>

							
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
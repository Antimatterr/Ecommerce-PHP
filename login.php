<?php
require('./connection.inc.php');
require('./functions.inc.php');
require('./top.php');
?>

<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form method="post">
							<input type="email" name="login_email" id="login_email" placeholder="Email Address">
							<input type="password" name="login_password" id="login_password" placeholder="Password">
					
							<button type="submit" onclick="user_login()" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="#" method="post">
							<input type="text" name="name" id="name" placeholder="Name"/>
							<input type="email" name="email" id="email" placeholder="Email Address"/>
							<input type="password" name="password" id="password" placeholder="Password"/>
							<input type="text" name="mobile" id="mobile" placeholder="Mobile"/>
							<button type="submit" onclick="user_register()" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	

<?php require('./footer.php') ?>
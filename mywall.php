<?php
session_start();
?>
<!DOCTYPE html>
<html lan="en">
	<head>
		<meta charset="utf-8">
		<title>The Wall</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<style>
			.red{
				color:red;
			}
		</style>
	</head>
		<!-- Registration errors -->
		<div class="red">
			<?php
			if(isset($_SESSION['errors']))
			{
				foreach ($_SESSION['errors'] as $error)
				{
					echo $error . "<br />";
				}
				unset($_SESSION['errors']);
			}
			?>
		</div>
		<div class="red">
			<?php 
			if(isset($_SESSION['success']))
			{
				echo $_SESSION['success'] . "<br/>";
				unset($_SESSION['success']);
			}
			?>
		</div>
	<body>
		<div class="container">
			<div class="jumbotron">
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-8">
						<!-- registration -->
						<h1>Registration</h1>
						<form role="form" action="mywall_process.php" method="post">
							<div class="form-group">
								<label for="first_name">First name: </label>
								<input name="first_name" type="text" class="form-control">
							</div>
							<div class="form-group">
								<label for="last_name">Last name: </label>
								<input name="last_name" type="text" class="form-control">
							</div>
							<div class="form-group">
								<label for="email">Email: </label>
								<input name="email" type="email" class="form-control">
							</div>
							<div class="form-group">
								<label for="password">Password: </label>
								<input name="password" type="password" class="form-control">
							</div>
							<div class="form-group">
								<label for="passconf">Password confirmation: </label>
								<input name="passconf" type="password" class="form-control">
							</div>
							<input type="hidden" name="action" value="register">
							<button type="submit" class="btn btn-primary">Register</button>
						</form>
					</div>
					<div class="col-xs-2">
					</div>
				</div>
				<div class="row">
					<!-- Login errors -->
					<div class="red">
						<?php
						if(isset($_SESSION['errors']))
						{
							foreach ($_SESSION['errors'] as $error2)
							{
								echo $error2 . "<br />";
							}
							unset($_SESSION['errors']);
						}
						?>
					</div>
					<!-- end login errors -->
				</div>
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-8">
						<!-- login -->
						<h1>Login</h1>
						<form role="form" action="mywall_process.php" method="post">
							<div class="form-group">
								<label for="email">Email: </label>
								<input name="email" type="email" class="form-control">
							</div>
							<div class="form-group">
								<label for="password">Password: </label>
								<input name="password" type="password" class="form-control">
							</div>
							<input type="hidden" name="action" value="login">
							<button type="submit" class="btn btn-primary">Login</button>
						</form>
					</div>
					<div class="col-xs-2">
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
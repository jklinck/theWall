<?php
session_start();
?>
<!DOCTYPE html>
<html lan="en">
	<head>
		<title>The Wall</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
		integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" 
		crossorigin="anonymous"></script>
		<meta charset="utf-8">
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
		<div class="container-fluid">
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
<?php
session_start();
?>
<!DOCTYPE html>
<html lan="en">
	<head>
		<meta charset="utf-8">
		<title>The Wall</title>
		<link rel="stylesheet" type="text/css" href="mywall.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h1 class="text-center wall">The Wall</h1>
			</div>
			<div class="jumbotron">
				<div class="row">
					<div class="col-xs-2">
					</div>
					<!-- Registration -->
					<div class="col-xs-8">
						<!-- Successful registration  -->
						<div class="red">
							<?php 
							if(isset($_SESSION['success']))
							{
								echo $_SESSION['success'] . "<br/>";
								unset($_SESSION['success']);
							}
							?>
						</div>
						<h1>Registration</h1>
						<form role="form" action="mywall_process.php" method="post">
							<div class="form-group">
								<label for="first_name">First name: </label>
								<input name="first_name" type="text" class="form-control">
								<div class="red">
								<?php
								if(isset($_SESSION['regErrors']))
								{
									foreach ($_SESSION['regErrors'] as $regError)
									{
									if($regError == "First name cannot be blank" || $regError == "First name cannot contain any numbers")
										{
										echo $regError . "<br />";
										}
									}
								}
								?>
								</div>
							</div>
							<div class="form-group">
								<label for="last_name">Last name: </label>
								<input name="last_name" type="text" class="form-control">
								<div class="red">
								<?php
								if(isset($_SESSION['regErrors']))
								{
									foreach ($_SESSION['regErrors'] as $regError)
									{
									if($regError == "Last name cannot be blank" || $regError == "Last name cannot contain any numbers")
										{
										echo $regError . "<br />";
										}
									}
								}
								?>
								</div>
							</div>
							<div class="form-group">
								<label for="email">Email: </label>
								<input name="email" type="email" class="form-control">
								<div class="red">
								<?php
								if(isset($_SESSION['regErrors']))
								{
									foreach ($_SESSION['regErrors'] as $regError)
									{
									if($regError == "Email cannot be blank" )
										{
										echo $regError . "<br />";
										}
									}
								}
								?>
								</div>
							</div>
							<div class="form-group">
								<label for="password">Password: </label>
								<input name="password" type="password" class="form-control">
								<div class="red">
								<?php
								if(isset($_SESSION['regErrors']))
								{
									foreach ($_SESSION['regErrors'] as $regError)
									{
									if($regError == "Password cannot be blank" || $regError == "Your password must contain at least 6 characters")
										{
										echo $regError . "<br />";
										}
									}
								}
								?>
								</div>
							</div>
							<div class="form-group">
								<label for="passconf">Password confirmation: </label>
								<input name="passconf" type="password" class="form-control">
								<div class="red">
								<?php
								if(isset($_SESSION['regErrors']))
								{
									foreach ($_SESSION['regErrors'] as $regError)
									{
										if($regError == "Password confirmation cannot be blank" || $regError == "Password and password confirmation do not match" || $regError == "Database write failed")
										{
											echo $regError . "<br />";
										}
									}
									
									unset($_SESSION['regErrors']);
								}
								?>
								</div>
							</div>
							<input type="hidden" name="action" value="register">
							<button type="submit" class="btn btn-primary">Register</button>
						</form>
					</div>
					<div class="col-xs-2">
					</div>
				</div>
				<!-- End registration -->

				<!-- Login -->
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-8">
						<!-- login -->
						<h1>Login</h1>
						<?php
							if(isset($_SESSION['logErrors']))
							{
								foreach ($_SESSION['logErrors'] as $logError)
								{
								if($logError == "Invalid login credentials")
									{
									echo $logError . "<br />";
									}
								}
							}
						?>
						<form role="form" action="mywall_process.php" method="post">
							<div class="form-group">
								<label for="email">Email: </label>
								<input name="email" type="email" class="form-control">
								<div class="red">
								<?php
								if(isset($_SESSION['logErrors']))
								{
									foreach ($_SESSION['logErrors'] as $logError)
									{
									if($logError == "Email cannot be blank" )
										{
										echo $logError . "<br />";
										}
									}
								}
								?>
								</div>
							</div>
							<div class="form-group">
								<label for="password">Password: </label>
								<input name="password" type="password" class="form-control">
								<div class="red">
								<?php
								if(isset($_SESSION['logErrors']))
								{
									foreach ($_SESSION['logErrors'] as $logError)
									{
									if($logError == "Password cannot be blank" )
										{
										echo $logError . "<br />";
										}
									}
									unset($_SESSION['logErrors']);
								}
								?>
								</div>
							</div>
							<input type="hidden" name="action" value="login">
							<button type="submit" class="btn btn-primary">Login</button>
						</form>
					</div>
					<!-- End login -->
					<div class="col-xs-2">
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

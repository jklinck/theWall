<?php
session_start();
?>
<!DOCTYPE html>
<html lan="en">
	<head>
		<title>The Wall</title>
		<meta charset="utf-8">
		<style>
			.red{
				color:red;
			}
			body{
				padding-left: 20px;
				padding-top: 20px;
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
		<!-- registration -->
		<h1>Registration</h1>
		<form action="mywall_process.php" method="post">
			<label for="first_name">First name: </label>
			<input name="first_name" type="text"><br>

			<label for="last_name">Last name: </label>
			<input name="last_name" type="text"><br>

			<label for="email">Email: </label>
			<input name="email" type="email"><br>

			<label for="password">Password: </label>
			<input name="password" type="password"><br>

			<label for="passconf">Password confirmation: </label>
			<input name="passconf" type="password"><br>

			<input type="hidden" name="action" value="register">
			<input type="submit" value="Register">
		</form>


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
		<!-- login -->
		<h1>Login</h1>
		<form action="mywall_process.php" method="post">
			<label for="email">Email: </label>
			<input name="email" type="email"><br>

			<label for="password">Password: </label>
			<input name="password" type="password"><br>

			<input type="hidden" name="action" value="login">
			<input type="submit" value="Login">
		</form>
	</body>
</html>
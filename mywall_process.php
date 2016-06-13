<?php
session_start();
require_once('mywall_connection.php');
$errors=array();
$success= array();

// registration validation
if(isset($_POST['action']) && $_POST['action']=='register')
{
	if(empty($_POST['first_name']))
	{
		$errors[]="First name cannot be blank";
	}
	if(!ctype_alpha($_POST['first_name']) && !empty($_POST['first_name']))
	{
		$errors[]="First name cannot contain any numbers";
	}
	if(empty($_POST['last_name']))
	{
		$errors[]="Last name cannot be blank";
	}
	if(!ctype_alpha($_POST['last_name']) && !empty($_POST['last_name']))
	{
		$errors[]="Last name cannot contain any numbers";
	}
	if(empty($_POST['email']))
	{
		$errors[]="Email cannot be blank";
	}
	if(empty($_POST['password']))
	{
		$errors[]="Password cannot be blank";
	}
	if(strlen($_POST['password'])<6 && !empty($_POST['password']))
	{
		$errors[]="Your password must contain at least 6 characters";
	}
	if(empty($_POST['passconf']))
	{
		$errors[]="Password confirmation cannot be blank";
	}
	if($_POST['passconf']!=$_POST['password'] && !empty($_POST['password']) && !empty($_POST['passconf']))
	{
		$errors[]="Password and password confirmation do not match";
	}
	if(count($errors)>0)
	{
		$_SESSION['errors']= $errors;
		header("Location: mywall.php");
	}
	else
	{
		$query = "INSERT INTO users(first_name, last_name, email, password, created_at) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}', 
		'{$_POST['email']}', '{$_POST['password']}', NOW())";
		if(run_mysql_query($query))
		{
		$_SESSION['success']= "You have successfully registered!";
		}
		else
		{
			$_SESSION['errors'] = array("Database write failed.");
		}
	}
}
// login validation
if(isset($_POST['action']) && $_POST['action'] =='login')
{
	$entered_pass= $_POST['password'];
	$entered_email= $_POST['email'];
	if(empty($_POST['email']))
	{
		$errors[]="Email cannot be blank";
	}
	if(empty($_POST['password']))
	{
		$errors[]="Password cannot be blank";
	}
	if(count($errors)>0)
	{
		$_SESSION['errors'] = $errors;
	}
	else
	{
		$query= "SELECT * FROM users WHERE email = '$entered_email'";
		$user = fetch($query);
		if(!empty($user))
		{
			$password = $user[0]['password'];
			if($entered_pass!=$password)
			{
				$_SESSION['errors'] = array("Invalid login credentials.");
			}
			else
			{
				$_SESSION['user'] = $user[0]['first_name'];
				$_SESSION['userid']= $user[0]['id'];
				header("Location: mywall_success.php");
				exit();
			}
		}
		else
		{
			$_SESSION['errors'] = array("Invalid login credentials.");
		}
	}
}
// logout routine
if(isset($_POST['action']) && $_POST['action'] =='logout')
{
	$_SESSION['success'] = "You have successfully logged out!";
	header("Location: mywall.php");
	session_destroy();
}

header("Location: mywall.php");
?>


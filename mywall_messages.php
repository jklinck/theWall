<?php
session_start();
require_once('mywall_connection.php');
$errors= array();
$messageErrors= array();
$commentErrors= array();
// message validation
if(isset($_POST['action']) && $_POST['action'] == "message")
{
	if(empty ($_POST['message']))
	{
		$messageErrors[]="Please enter a message";
	}
	if(count($messageErrors)>0)
	{
		$_SESSION['messageErrors']= $messageErrors;
	}
	else
	{
		$query= "INSERT INTO messages(message, user_id, created_at) VALUES ('{$_POST['message']}', '{$_SESSION['userid']}', NOW())";
		if(!run_mysql_query($query))
		{
			$_SESSION['errors']= array('Message did not connect with database');
		}
	}
}
// comment validation
if(isset($_POST['action']) && $_POST['action']== "comment")
{
	if(empty ($_POST['comment']))
	{
		$commentErrors[]="Please enter a comment";
	}
	if(count($commentErrors)>0)
	{
		$_SESSION['commentErrors']= $commentErrors;
	}
	else
	{
		$query= "INSERT INTO comments(comment, message_id, user_id, created_at) VALUES 
		('{$_POST['comment']}', '{$_POST['message_id']}', '{$_SESSION['userid']}', NOW())";
		if(!run_mysql_query($query))
		{
			$_SESSION['errors']= array('Comment did not connect with database');
		}
	}
}
header ("Location: mywall_success.php");
?>
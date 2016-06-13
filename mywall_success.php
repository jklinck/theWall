<?php
session_start();
require_once('mywall_connection.php');

$message_query="SELECT messages.id, messages.message, messages.created_at, 
		users.first_name,users.last_name FROM messages LEFT JOIN users ON 
		messages.user_id=users.id ORDER BY messages.created_at DESC";
		// I had an issue with this query because I didn't change the foreign
		// keys in the database to being singular, for example in the messages
		// table I had users.id(this is how the ERD will make it), but it needed
		// to be user.id
$messages= fetch($message_query);

$comment_query="SELECT comments.comment, comments.message_id, comments.created_at,
				users.first_name, users.last_name FROM comments LEFT JOIN users
				ON comments.user_id=users.id";
$comments= fetch($comment_query);

?>
<!DOCTYPE html>
<html lan="en">
	<head>
		<meta charset="utf-8">
		<title>The Wall</title>
		<style>
			body{
				padding-left: 20px;
				padding-top: 20px;
			}
			#logout{
				background-color:red; 
				color:white; 
				border-radius: 5px;
			}
			#message{
				background-color: blue;
				color: white;
				border-radius: 5px;
			}
			#comment{
				background-color: green;
				color: white;
				border-radius: 5px;
			}
		</style>
	</head>
	<body>
		<h1>Welcome to THE WALL <?php echo $_SESSION['user'] ?>, you have 
			successfully logged in!</h1>

		<!-- errors -->
		<?php
			if(isset($_SESSION['errors']))
			{
				foreach($_SESSION['errors'] as $error)
				{
					echo $error. "<br />";
				}
				unset($_SESSION['errors']);
			}
		?>
		<!-- log out routine -->
		<form action="mywall_process.php" method="post">
			<input type="hidden" name="action" value="logout">
			<input id="logout" type="submit" value="Logout">
		</form>
		<!-- post a message -->
		<form action="mywall_messages.php" method="post">
			<h3>Post a message</h3>
			<textarea style="width: 500px; height: 50px" name="message"></textarea><br>
			<input type="hidden" name="action" value="message">
			<input id="message" type="submit" value="Post a message!"><br></br>
		</form>
		<?php
				foreach($messages as $message)
				{
					echo '<strong>'.$message['first_name'].' '.$message['last_name']
					.' '.$message['created_at'].'</strong>'.'<br>'.
					$message['message'].'<br></br>';
					foreach($comments as $comment)
					{
						if($comment['message_id'] == $message['id'])
						{
							echo '<strong>'.$comment['first_name'].' '
							.$comment['last_name'].' '
							.$comment['created_at'].'</strong>'.'<br>'.' '.
							$comment['comment'].'<br></br>';
						}
					}
					?><!-- post a comment -->
				<form action="mywall_messages.php" method="post">
					<h3>Post a comment: </h3>
					<textarea style="width: 500px; height: 50px" name="comment"></textarea><br>
					<input type="hidden" name="action" value="comment">
					<input type="hidden" name="message_id" value="<?php echo $message['id']?>">
					<input id="comment" type="submit" value="Post a comment!">
				</form>
				<hr>
				<?php
				}
					?>
	</body>
</html>
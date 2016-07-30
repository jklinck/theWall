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
		<link rel="stylesheet" type="text/css" href="mywall.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<style>
			.red{
				color:red;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<h1>Welcome <?php echo $_SESSION['user'] ?>, you have 
					successfully logged in!</h1>
					<!-- log out routine -->
				<form action="mywall_process.php" method="post">
					<input type="hidden" name="action" value="logout">
					<button id="logOut" type="submit" class="btn btn-danger">Log out</button>
				</form>
			<div class="jumbotron">
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
				<div class="row">
				<!-- post a message -->
				<form action="mywall_messages.php" method="post">
					<h3>Post a message</h3>
					<div class="form-group">
						<textarea class="form-control" name="message"></textarea>
					</div>
						<input type="hidden" name="action" value="message">
						<button id="message" type="submit" class="btn btn-primary">Post a message!</button><br></br>
						<div class="red">
						<?php
							if(isset($_SESSION['messageErrors']))
							{
								foreach($_SESSION['messageErrors'] as $messageError)
								{
									echo $messageError. "<br />";
								}
								unset($_SESSION['messageErrors']);
							}
						?>
						</div>
				</form>
				<?php
						foreach($messages as $message)
						{
							echo '<strong>'.$message['first_name'].' '.$message['last_name']
							.' - '.date('F j Y',strtotime($message['created_at'])).'</strong>'.'<br>'.
							$message['message'].'<br></br>';
							?>
							
									<?php
									foreach($comments as $comment)
									{
										if($comment['message_id'] == $message['id'])
										{
											echo '<strong>'.$comment['first_name'].' '
											.$comment['last_name'].' - '
											.date('F j Y',strtotime($message['created_at'])).
											'</strong>'.'<br>'.' '.
											$comment['comment'].'<br></br>';
										}
									}
									?>
						<!-- post a comment -->
						<form action="mywall_messages.php" method="post">
							<h3>Post a comment: </h3>
							<div class="form-group">
								<textarea class="form-control" name="comment"></textarea>
							</div>
							<input type="hidden" name="action" value="comment">
							<input type="hidden" name="message_id" value="<?php echo $message['id']?>">
							<button id="comment" type="submit" class="btn btn-success">Post a comment!</button>
							<?php
								if(isset($_SESSION['commentErrors']))
								{
									foreach($_SESSION['commentErrors'] as $commentError)
									{
										echo $commentError. "<br />";
									}
									unset($_SESSION['commentErrors']);
								}
							?>
						</form>
						<hr class="line">
						<?php
						}
						?>
					</div>  <!--  closes row -->
			</div>  <!--  closes jumbotron -->
		</div>  <!--  closes container fluid -->
	</body>
</html>
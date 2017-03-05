<?php
session_start();
$username = $_SESSION['username'];

$topicup = $_POST['topic'];
$title = $_POST['title'];
$comment = $_POST['comment'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

$stmt = $mysqli->prepare("insert into comments (title, story_title, comment, submitter) values (?, ?, ?, ?)");//insert the comment to the table
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('ssss', $title, $topicup, $comment, $username);
 
$stmt->execute();
 
$stmt->close();

echo 'Comment successed';
echo '<p><a href="usersnews.php"> Back </a></p><br>';

?>
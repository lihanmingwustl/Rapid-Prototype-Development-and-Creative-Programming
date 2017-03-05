<?php
session_start();
$username = $_SESSION['username'];

$topicup = $_POST['topicup'];
$storyup = $_POST['storyup'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

$stmt = $mysqli->prepare("insert into storys (story_topic, user, story) values (?, ?, ?)");//upload the story to the table
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('sss', $topicup, $username, $storyup);
 
$stmt->execute();
 
$stmt->close();

echo 'Upload successed';
echo '<p><a href="usersnews.php"> Back </a></p><br>';
?>
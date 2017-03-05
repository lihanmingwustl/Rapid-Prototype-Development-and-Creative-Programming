<?php
session_start();
$topic = $_POST['topic'];
$topicup = $_POST['topicup'];
$storyup = $_POST['story'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

$stmt0 = $mysqli->prepare("SET FOREIGN_KEY_CHECKS=0");
if(!$stmt0){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt0->execute();
 
$stmt0->close();
//update the stories by its topic
$stmt = $mysqli->prepare("UPDATE storys SET story_topic= ?, story= ? WHERE story_topic= ?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('sss', $topicup, $storyup, $topic);
 
$stmt->execute();
 
$stmt->close();

$stmt3 = $mysqli->prepare("SET FOREIGN_KEY_CHECKS=0");
if(!$stmt3){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt3->execute();
 
$stmt3->close();

echo 'Edit successed';
echo '<p><a href="usersnews.php"> Back </a></p><br>';
?>
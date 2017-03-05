<?php
session_start();
$title = $_POST['title'];
$newtitle = $_POST['newtitle'];
$comment = $_POST['comment'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

$stmt = $mysqli->prepare("UPDATE comments SET title= ?, comment= ? WHERE title= ?");//update teh comment by its title
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('sss', $newtitle, $comment, $title);
 
$stmt->execute();
 
$stmt->close();

echo 'Edit successed';
echo '<p><a href="usersnews.php"> Back </a></p><br>';
?>
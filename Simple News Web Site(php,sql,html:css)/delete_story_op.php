<?php
session_start();
$topic = $_POST['topic'];
$function = $_POST['function'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

switch ($function){

case "1":
	
		$stmt0 = $mysqli->prepare("SET FOREIGN_KEY_CHECKS=0");
		if(!$stmt0){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$stmt0->execute();
 
		$stmt0->close();
		
		$stmt = $mysqli->prepare("DELETE FROM storys WHERE story_topic= ?");//delete the choosen story
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$stmt->bind_param('s', $topic);
 
		$stmt->execute();
 
		$stmt->close();

		$stmt3 = $mysqli->prepare("SET FOREIGN_KEY_CHECKS=0");
		if(!$stmt3){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$stmt3->execute();
 
		$stmt3->close();
		
		echo 'Delete successed';
		echo '<p><a href="usersnews.php"> Back </a></p><br>';
		break;
case "0":
        header("LOCATION: usersnews.php");
        break;
}
?>
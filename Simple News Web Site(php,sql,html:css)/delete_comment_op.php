<?php
session_start();
$function = $_POST['function'];
$title = $_POST['title'];

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
		$stmt = $mysqli->prepare("DELETE FROM comments WHERE title= ?");//delete the chosen comment
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		
		$stmt->bind_param('s', $title);
 
		$stmt->execute();
 
		$stmt->close();

		echo 'Delete successed';
		echo '<p><a href="usersnews.php"> Back </a></p><br>';
		break;
case "0":
        header("LOCATION: usersnews.php");
        break;

}

?>
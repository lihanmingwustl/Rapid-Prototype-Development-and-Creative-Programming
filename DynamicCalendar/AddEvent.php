<?php
header("Content-Type: application/json"); 
ini_set("session.cookie_httponly", 1);
session_start();
$username = $_SESSION['username'];
$topic = $_POST['topic'];
$event = $_POST['event'];
$date = $_POST['date'];
$time = $_POST['time'];

$mysqli = new mysqli('localhost', 'lihanmingwustl', 'Lhm2016', 'module5');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

$stmt = $mysqli->prepare("insert into event (topic, event, user, date, time) values (?, ?, ?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('sssss', $topic, $event, $username, $date, $time);//hash the password
 
$stmt->execute();
 
$stmt->close();

echo json_encode(array(
		"success" => true
    ));

?>
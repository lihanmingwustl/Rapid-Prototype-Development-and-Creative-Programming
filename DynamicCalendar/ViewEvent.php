<?php
header("Content-Type: application/json"); 
ini_set("session.cookie_httponly", 1);
session_start();
$mysqli = new mysqli('localhost', 'lihanmingwustl', 'Lhm2016', 'module5');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
	// perform query
	$stmt = $mysqli->prepare("SELECT topic, event, date, time FROM event WHERE user=? AND date=?");
 
	// Bind the parameter
	$username = $_SESSION['username'];
	$date = $_POST['date'];
	$stmt->bind_param('ss', $username, $date);
	$stmt->execute();
	$result = $stmt -> get_result();
	$output_array = array();
	while ($row = $result -> fetch_assoc()) {
		array_push($output_array, array(
			"topic" => htmlspecialchars($row['topic']),
			"event" => htmlspecialchars($row['event']),
			"date" => htmlspecialchars($row['date']),
			"time" => htmlspecialchars($row['time'])
		));
	}
	echo json_encode($output_array);

	exit;
}
?>
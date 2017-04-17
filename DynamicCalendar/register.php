<?php
header("Content-Type: application/json"); 
ini_set("session.cookie_httponly", 1);
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['username'] = $username;

$mysqli = new mysqli('localhost', 'lihanmingwustl', 'Lhm2016', 'module5');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

$stmt = $mysqli->prepare("insert into user (username, password) values (?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('ss', $username, password_hash($password,PASSWORD_DEFAULT));//hash the password
 
$stmt->execute();
 
$stmt->close();

echo json_encode(array(
		"success" => true,
        "isLoggedIn" => true,
        "user" => $_SESSION['username']
    ));

?>
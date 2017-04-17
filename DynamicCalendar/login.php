<?php
header("Content-Type: application/json"); 
ini_set("session.cookie_httponly", 1);
if(isset($_POST['username'])){
session_start();
$mysqli = new mysqli('localhost', 'lihanmingwustl', 'Lhm2016', 'module5');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
 
// Use a prepared statement
$stmt = $mysqli->prepare("SELECT password FROM user WHERE username=?");
 
// Bind the parameter
$user = $_POST['username'];
$stmt->bind_param('s', $user);
$stmt->execute();
 
// Bind the results
$stmt->bind_result($pwd_hash);
$stmt->fetch();
 
$pwd_guess = $_POST['password'];
// Compare the submitted password to the actual password hash
 
if(password_verify($_POST['password'], $pwd_hash)==$pwd_hash){
	// Login succeeded!
	$_SESSION['username'] = $user;
    echo json_encode(array(
		"success" => true,
        "isLoggedIn" => true,
        "user" => $_SESSION['username']
    ));
} else{
	echo json_encode(array(
		"success" => false,
        "isLoggedIn" => false,
        "user" => $_SESSION['username']
    ));
}
}
?>
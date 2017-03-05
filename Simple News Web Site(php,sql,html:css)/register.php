<?php
$username = $_POST['usernamer'];
$password = $_POST['passwordr'];

$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('ss', $username, password_hash($password,PASSWORD_DEFAULT));//hash the password
 
$stmt->execute();
 
$stmt->close();

echo 'Successfully registed.';
echo '<p><a href="login.php"> Back </a></p><br>';
?>
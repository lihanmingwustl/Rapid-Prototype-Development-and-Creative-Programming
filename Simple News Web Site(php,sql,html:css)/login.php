<!DOCTYPE HTML>
    
<html>
<head><title>Login</title>

</head>
<body>

<form name="input" action="login.php" method="POST">
User Name:<input type="text" name="username"><br>
Password:<input type="text" name="password"><br>
<input type="submit" value="login" class="button"><br>
</form>

<?php
if(isset($_POST['username'])){
session_start();
$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
 
// Use a prepared statement
$stmt = $mysqli->prepare("SELECT password FROM users WHERE username=?");
 
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
    header("LOCATION: usersnews.php");
} else{
	echo "<p>Wrong password</p><br>";
}
}
?>

<form name="input" action="register.php" method="POST">
User Name:<input type="text" name="usernamer"><br>
Password:<input type="text" name="passwordr"><br>
<input type="submit" value="register" class="button"><br>
</form>

<p><a href="visternews.php"> VisterLogin</a></p><br>

</body>
</html>
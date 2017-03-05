<!DOCTYPE HTML>
    
<html>
<head><title>Story list</title>

</head>
<body>

<p><a href="pop.php"> The most popular stories! </a></p><br>

<?php
session_start();
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));

$username = $_SESSION['username'];
$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
 
$stmt = $mysqli->prepare("select story_topic, user, story from storys");//read the stories from the table
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->execute();
 
$stmt->bind_result($topic, $user, $story);
 
echo "<ul>\n";
while($stmt->fetch()){
		echo '<p>Title: '.htmlspecialchars($topic).'</p><br>';
		echo '<p>Submiter: '.htmlspecialchars($user).'</p><br>';
		$story_path = sprintf("story.php?topic=%s", $topic);
		echo '<p><a href="'.$story_path.'"> Check whole story </a></p><br>';
}//view the stories
echo "</ul>";
 
$stmt->close();
?>

<form name="input" action="upload.php" method="POST">
Story's topic:<input type="text" name="topicup"><br>
Story:<textarea name="storyup" cols="100" rows="35"></textarea><br>
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
<input type="submit" value="upload" class="button"><br>
</form>

<p><a href="logout.php"> LogOut </a></p><br>

</body>
</html>
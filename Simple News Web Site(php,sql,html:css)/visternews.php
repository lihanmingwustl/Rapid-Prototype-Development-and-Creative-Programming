<!DOCTYPE HTML>
    
<html>
<head><title>Story list</title>

</head>
<body>
<p><a href="pop.php"> The most popular stories! </a></p><br>
<?php
session_start();
$_SESSION['username'] = 'vister';
$username = $_SESSION['username'];
$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
//read the stories 
$stmt = $mysqli->prepare("select story_topic, user, story, story_link from storys join story_links on (storys.story_topic=story_links.topic) order by storys.story_topic");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->execute();
 
$stmt->bind_result($topic, $user, $story, $storylink);
//view the stories 
echo "<ul>\n";
while($stmt->fetch()){
		echo '<p>Title: '.htmlspecialchars($topic).'</p><br>';
		echo '<p>Submiter: '.htmlspecialchars($user).'</p><br>';
		$story_path = sprintf("story.php?topic=%s", $topic);
		echo '<p><a href="'.$story_path.'"> Check whole story </a></p><br>';
}
echo "</ul>";
 
$stmt->close();
?>

</body>
</html>
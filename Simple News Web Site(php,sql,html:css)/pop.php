<?php
session_start();

$username = $_SESSION['username'];
$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

//read the stories with the largest number of hits 
$stmt = $mysqli->prepare("select story_topic, user from storys where hit = (select max(hit) from storys)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->execute();
 
$stmt->bind_result($topic, $user);
 
//view the most popular stories 
echo "<ul>\n";
while($stmt->fetch()){	
		echo '<p>Title: '.htmlspecialchars($topic).'</p><br>';
		echo '<p>Submiter: '.htmlspecialchars($user).'</p><br>';
		$story_path = sprintf("story.php?topic=%s", $topic);
		echo '<p><a href="'.$story_path.'"> Check whole story </a></p><br>';
}
echo '<p><a href="usersnews.php"> Back </a></p><br>';
echo "</ul>";
 
$stmt->close();
?>
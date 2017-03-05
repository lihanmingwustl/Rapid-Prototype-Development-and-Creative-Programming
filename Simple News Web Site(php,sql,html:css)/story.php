<?php
session_start();

$topic = $_GET['topic'];
$username = $_SESSION['username'];
$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
//read the wohle story by its topic 
$stmt = $mysqli->prepare("select story, user, hit from storys where story_topic = ?");
if(!$stmt){
	printf("1st Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('s', $topic);
 
$stmt->execute();
 
$stmt->bind_result($story, $user, $hit);
//view the stories
echo "<ul>\n";
while($stmt->fetch()){
		echo '<p>Title: '.htmlspecialchars($topic).'</p><br>';
		echo '<p>Hits: '.htmlspecialchars($hit).'</p><br>';
		echo '<p>Submiter: '.htmlspecialchars($user).'</p><br>';
		echo '<p>Context: '.htmlspecialchars($story).'</p><br>';
		$comment_path = sprintf("comments.php?topic=%s", $topic);
		echo '<p><a href="'.$comment_path.'"> Comments </a></p><br>';
		if($user == $_SESSION['username']){
			$edit_path = sprintf("edit_story.php?topic=%s", $topic);
			echo '<p><a href="'.$edit_path.'"> Edit Story </a></p><br>';
			$delete_path = sprintf("delete_story.php?topic=%s", $topic);
			echo '<p><a href="'.$delete_path.'"> Delete Story </a></p><br>';
		} else {
			echo '<p></p><br>';
		}
}
echo "</ul>";

$stmt->close();

$hit2 = (INT)$hit + 1;

$stmt2 = $mysqli->prepare("UPDATE storys SET hit = ? WHERE story_topic= ?");
if(!$stmt2){
	printf("2st Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt2->bind_param('ss', $hit2, $topic);
 
$stmt2->execute();
 
$stmt2->close();
 

echo '<p><a href="usersnews.php"> Back </a></p><br>'; 
?>
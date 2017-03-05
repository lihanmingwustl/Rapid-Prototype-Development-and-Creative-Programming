<!DOCTYPE HTML>
    
<html>
<head><title>Comments list</title>

</head>
<body>

<?php
session_start();

$username = $_SESSION['username'];
$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'wustl');
$topic = $_GET['topic'];
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
 
$stmt = $mysqli->prepare("select title, comment, submitter from comments where story_title = ?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('s', $topic); 
$stmt->execute();
 
$stmt->bind_result($title, $comment, $submitter);
 
echo "<ul>\n";
while($stmt->fetch()){
		echo '<p>Title: '.htmlspecialchars($title).'</p><br>';
		echo '<p>Submiter: '.htmlspecialchars($submitter).'</p><br>';
		echo '<p>Context: '.htmlspecialchars($comment).'</p><br>';
		if($submitter == $_SESSION['username']){
			$edit_path = sprintf("edit_comment.php?title=%s", $title);
			echo '<p><a href="'.$edit_path.'"> Edit comment </a></p><br>';
			$delete_path = sprintf("delete_comment.php?title=%s", $title);
			echo '<p><a href="'.$delete_path.'"> Delete comment </a></p><br>';
		} 
}
echo "</ul>";
 
$stmt->close();

if ($_SESSION['username'] != "vister"){
	echo '<form action = "commentupload.php" method = "POST">';
	echo '<input type = "hidden" name = "topic" value = "'.$topic.'">';
	echo '<input type="hidden" name="username" value="'.$_SESSION['username'].'">';
	echo 'Title: <input type = "text" name = "title"><br>';
	echo 'Comment:<textarea name="comment" cols="70" rows="20"></textarea><br>';
	echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
	echo '<input type ="submit" value ="Submit">';
	echo '</form>';
	echo '<br>';
} else {
	echo 'Please log in to comment';
}

?>


</body>
</html>
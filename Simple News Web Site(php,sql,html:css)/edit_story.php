<?php
session_start();
$username = $_SESSION['username'];
$topic = $_GET['topic'];
echo $topic;
echo '<form name="input" action="edit_story_op.php" method="POST">';
echo '<input type="hidden" name="topic" value="'.$topic.'">';
echo '<input type="hidden" name="username" value="'.$_SESSION['username'].'">';
echo 'Story topic:<input type="text" name="topicup"><br>';
echo 'Story:<textarea name="story" cols="100" rows="35"></textarea><br>';
echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
echo '<input type="submit" value="edit" class="button"><br>';
echo '</form>';



?>
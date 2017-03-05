<?php

session_start();
$username = $_SESSION['username'];

$topic = $_GET['topic'];
echo $topic;
echo '<form name="input" action="delete_story_op.php" method="POST">';
echo '<input type="hidden" name="topic" value="'.$topic.'">';
echo '<input type="hidden" name="username" value="'.$_SESSION['username'].'">';
echo 'Your sure you want to delete this story?<br>';
echo 'Yes<input type="radio" name="function" value="1"><br>';
echo 'No<input type="radio" name="function" value="0"><br>';
echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
echo '<input type="submit" value="submit" class="button"><br>';
echo '</form>';




?>
<?php
session_start();
$username = $_SESSION['username'];
$topicup = $_GET['title'];
echo $topicup;
echo '<form name="input" action="delete_comment_op.php" method="POST">';
echo '<input type = "hidden" name = "title" value = "'.$topicup.'">';
echo '<input type = "hidden" name = "username" value = "'.$username.'">';
echo 'Your sure you want to delete this comment?<br>';
echo 'Yes<input type="radio" name="function" value="1"><br>';
echo 'No<input type="radio" name="function" value="0"><br>';
echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
echo '<input type="submit" value="submit" class="button"><br>';
echo '</form>';

?>
<?php
session_start();
$username = $_SESSION['username'];
$title = $_GET['title'];
echo $title;
echo '<form name="input" action="edit_comment_op.php" method="POST">';
echo '<input type="hidden" name="title" value="'.$title.'">';
echo '<input type="hidden" name="username" value="'.$_SESSION['username'].'">';
echo 'Title:<input type="text" name="newtitle"><br>';
echo 'Comment:<textarea name="comment" cols="70" rows="20"></textarea><br>';
echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
echo '<input type="submit" value="edit" class="button"><br>';
echo '</form>';

?>
<?php
    session_start();
    $filename = $_POST['filename'];
    $_SESSION['filename'] = $filename;
    header("LOCATION: openfile.php");
?>
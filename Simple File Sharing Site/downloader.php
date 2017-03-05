<?php

session_start();
$filename = isset($_POST['filename'])?$_POST['filename']:NULL;
$fullpath = "/home/lihanmingwustl/public_html/".$_SESSION['username']."/".$filename;

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($fullpath));
    ob_clean();
    flush();
    readfile($fullpath);


?>